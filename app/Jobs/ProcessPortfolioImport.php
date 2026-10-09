<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Domain\Customers\Models\Client;
use App\Domain\Customers\Models\ClientPhone;
use App\Domain\Customers\Services\ClientCodeGenerator;
use App\Domain\Loans\Models\DebtCase;
use App\Domain\Loans\Models\PortfolioImport;
use App\Domain\Loans\Services\PortfolioTotalsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

final class ProcessPortfolioImport implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 3;
    public int $timeout = 300;

    public function __construct(public readonly int $portfolioImportId) {}

    public function handle(ClientCodeGenerator $codeGenerator, PortfolioTotalsService $totalsService): void
    {
        $import = PortfolioImport::query()->with('portfolio')->findOrFail($this->portfolioImportId);
        $path = Storage::disk('local')->path($import->stored_path);
        if (! is_file($path) || ! is_readable($path)) {
            $this->markFailed($import, ['File not found or not readable.']);
            return;
        }

        $handle = fopen($path, 'rb');
        if ($handle === false) {
            $this->markFailed($import, ['Unable to open the uploaded CSV file.']);
            return;
        }

        $success = 0;
        $failed = 0;
        $total = 0;
        $errors = [];

        try {
            $headers = fgetcsv($handle);
            if (! is_array($headers) || $headers === []) {
                $this->markFailed($import, ['The CSV file is empty or has no header row.']);
                return;
            }
            $headers = array_map(static function ($header): string {
                $header = preg_replace('/^\xEF\xBB\xBF/', '', (string) $header) ?? (string) $header;
                return strtolower(trim($header));
            }, $headers);
            foreach (['national_id', 'name', 'loan_number', 'total_debt'] as $required) {
                if (! in_array($required, $headers, true)) {
                    $this->markFailed($import, ["Missing required CSV column: {$required}"]);
                    return;
                }
            }

            $portfolio = $import->portfolio;
            $line = 1;
            while (($values = fgetcsv($handle)) !== false) {
                $line++;
                if ($values === [null] || $values === []) {
                    continue;
                }
                $total++;
                $row = [];
                foreach ($headers as $index => $header) {
                    $row[$header] = isset($values[$index]) ? trim((string) $values[$index]) : '';
                }

                try {
                    DB::transaction(function () use ($row, $portfolio, $codeGenerator): void {
                        $nationalId = $row['national_id'] ?? '';
                        $name = $row['name'] ?? '';
                        $loanNumber = $row['loan_number'] ?? '';
                        $totalDebt = $row['total_debt'] ?? '';
                        if (! preg_match('/^\d{14}$/', $nationalId)) {
                            throw new \InvalidArgumentException('national_id must contain exactly 14 digits.');
                        }
                        if ($name === '' || mb_strlen($name) > 255) {
                            throw new \InvalidArgumentException('name is required and must not exceed 255 characters.');
                        }
                        if ($loanNumber === '' || mb_strlen($loanNumber) > 100) {
                            throw new \InvalidArgumentException('loan_number is required and must not exceed 100 characters.');
                        }
                        if (! is_numeric($totalDebt) || (float) $totalDebt <= 0 || ! preg_match('/^\d+(?:\.\d{1,2})?$/', $totalDebt)) {
                            throw new \InvalidArgumentException('total_debt must be a positive amount with at most two decimal places.');
                        }

                        $client = Client::withTrashed()->where('national_id', $nationalId)->first();
                        if ($client?->trashed()) {
                            throw new \InvalidArgumentException('The national ID belongs to a soft-deleted client; restore it before importing.');
                        }
                        if ($client === null) {
                            $client = Client::query()->create([
                                'code' => $codeGenerator->generate(),
                                'national_id' => $nationalId,
                                'name' => $name,
                                'email' => ($row['email'] ?? '') !== '' ? $row['email'] : null,
                                'address' => ($row['address'] ?? '') !== '' ? $row['address'] : null,
                                'employer_name' => ($row['employer_name'] ?? '') !== '' ? $row['employer_name'] : null,
                                'job_title' => ($row['job_title'] ?? '') !== '' ? $row['job_title'] : null,
                                'work_address' => ($row['work_address'] ?? '') !== '' ? $row['work_address'] : null,
                            ]);
                        }

                        $attributes = [
                            'bank_id' => $portfolio->bank_id,
                            'loan_type_id' => null,
                            'assigned_user_id' => null,
                            'status' => in_array(($row['status'] ?? 'active'), ['active', 'inactive', 'paid', 'legal'], true) ? ($row['status'] ?? 'active') : 'active',
                            'total_debt' => number_format((float) $totalDebt, 2, '.', ''),
                            'overdue_amount' => $this->decimalOrZero($row['overdue_amount'] ?? '0'),
                            'installment_value' => $this->nullableDecimal($row['installment_value'] ?? ''),
                            'min_installment_diff' => $this->nullableDecimal($row['min_installment_diff'] ?? ''),
                            'late_fee' => $this->decimalOrZero($row['late_fee'] ?? '0'),
                            'bucket' => ($row['bucket'] ?? '') !== '' ? substr($row['bucket'], 0, 30) : null,
                            'dpd' => max(0, (int) ($row['dpd'] ?? 0)),
                            'next_due_date' => $this->nullableDate($row['next_due_date'] ?? ''),
                            'loan_start_date' => $this->nullableDate($row['loan_start_date'] ?? ''),
                            'loan_end_date' => $this->nullableDate($row['loan_end_date'] ?? ''),
                        ];

                        DebtCase::query()->updateOrCreate([
                            'portfolio_id' => $portfolio->getKey(),
                            'client_id' => $client->getKey(),
                            'loan_number' => $loanNumber,
                        ], $attributes);

                        if (($row['phone'] ?? '') !== '') {
                            $phone = preg_replace('/[^0-9+]/', '', $row['phone']) ?? '';
                            if (strlen(preg_replace('/\D/', '', $phone) ?? '') >= 8 && strlen($phone) <= 20) {
                                ClientPhone::query()->firstOrCreate(['client_id' => $client->getKey(), 'phone' => $phone], ['label' => 'primary', 'is_valid' => true]);
                            }
                        }
                    });
                    $success++;
                } catch (Throwable $exception) {
                    $failed++;
                    if (count($errors) < 500) {
                        $errors[] = ['row' => $line, 'message' => $exception->getMessage()];
                    }
                }
            }

            $import->refresh()->update([
                'total_rows' => $total,
                'success_rows' => $success,
                'failed_rows' => $failed,
                'errors' => $errors === [] ? null : $errors,
                'status' => $success > 0 || $total === 0 ? 'completed' : 'failed',
                'finished_at' => now(),
            ]);
            $totalsService->recalculate($portfolio);
        } catch (Throwable $exception) {
            Log::error('Portfolio CSV import failed.', ['portfolio_import_id' => $import->getKey(), 'exception' => $exception]);
            $this->markFailed($import->fresh(), [$exception->getMessage()]);
            throw $exception;
        } finally {
            fclose($handle);
        }
    }

    public function failed(Throwable $exception): void
    {
        $import = PortfolioImport::query()->find($this->portfolioImportId);
        if ($import !== null && in_array($import->status, ['pending', 'processing'], true)) {
            $this->markFailed($import, [$exception->getMessage()]);
        }
    }

    private function markFailed(PortfolioImport $import, array $errors): void
    {
        $import->update(['status' => 'failed', 'errors' => $errors, 'finished_at' => now()]);
    }

    private function decimalOrZero(string $value): string
    {
        if ($value === '' || ! is_numeric($value) || ! preg_match('/^\d+(?:\.\d{1,2})?$/', $value)) {
            return '0.00';
        }
        return number_format((float) $value, 2, '.', '');
    }

    private function nullableDecimal(string $value): ?string
    {
        if ($value === '') { return null; }
        if (! is_numeric($value) || ! preg_match('/^\d+(?:\.\d{1,2})?$/', $value)) {
            throw new \InvalidArgumentException('Optional monetary columns must be non-negative decimals with at most two decimal places.');
        }
        return number_format((float) $value, 2, '.', '');
    }

    private function nullableDate(string $value): ?string
    {
        if ($value === '') { return null; }
        $date = \DateTimeImmutable::createFromFormat('!Y-m-d', $value);
        if ($date === false || $date->format('Y-m-d') !== $value) {
            throw new \InvalidArgumentException('Dates must use YYYY-MM-DD format.');
        }
        return $value;
    }
}
