<?php

declare(strict_types=1);

namespace App\Domain\Reports\Services;

use App\Domain\Reports\Models\ReportExport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

final class ReportExportStorage
{
    private const DISK = 'local';

    /**
     * Generate and store an export file.
     *
     * @return array{file_path: string, row_count: int}
     */
    public function generate(ReportExport $export): array
    {
        $rows = $this->resolveRows($export);
        $format = strtolower((string) $export->format);

        if (! in_array($format, ['csv', 'xlsx'], true)) {
            throw new RuntimeException(
                "The [{$format}] export format is not supported yet."
            );
        }

        $directory = 'report-exports';
        $filename = sprintf(
            'report-%s-%s.%s',
            $export->getKey(),
            Str::uuid(),
            $format,
        );

        $path = $directory . '/' . $filename;

        Storage::disk(self::DISK)->makeDirectory($directory);

        try {
            if ($format === 'csv') {
                $this->writeCsv($path, $rows);
            } else {
                $this->writeXlsx($path, $rows);
            }

            return [
                'file_path' => $path,
                'row_count' => count($rows),
            ];
        } catch (Throwable $exception) {
            Storage::disk(self::DISK)->delete($path);

            throw $exception;
        }
    }

    /**
     * Resolve report data.
     *
     * Replace these report-specific queries with your existing
     * Domain Queries once their names and schemas are confirmed.
     *
     * @return list<array<string, mixed>>
     */
    private function resolveRows(ReportExport $export): array
    {
        return match ($export->type) {
            'collection' => $this->collectionRows($export),
            'performance' => $this->performanceRows($export),
            'payment' => $this->paymentRows($export),
            'portfolio' => $this->portfolioRows($export),
            'dcr' => $this->dcrRows($export),
            default => throw new RuntimeException(
                "Unknown report type [{$export->type}]."
            ),
        };
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function collectionRows(ReportExport $export): array
    {
        throw new RuntimeException(
            'Collection report query has not been connected.'
        );
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function performanceRows(ReportExport $export): array
    {
        throw new RuntimeException(
            'Performance report query has not been connected.'
        );
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function paymentRows(ReportExport $export): array
    {
        throw new RuntimeException(
            'Payment report query has not been connected.'
        );
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function portfolioRows(ReportExport $export): array
    {
        throw new RuntimeException(
            'Portfolio report query has not been connected.'
        );
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function dcrRows(ReportExport $export): array
    {
        throw new RuntimeException(
            'DCR report query has not been connected.'
        );
    }

    /**
     * Write a CSV file.
     *
     * @param list<array<string, mixed>> $rows
     */
    private function writeCsv(string $path, array $rows): void
    {
        $stream = fopen('php://temp', 'w+');

        if ($stream === false) {
            throw new RuntimeException('Unable to open CSV stream.');
        }

        try {
            if ($rows !== []) {
                $headers = array_keys($rows[0]);

                // UTF-8 BOM helps Excel recognize Arabic text.
                fwrite($stream, "\xEF\xBB\xBF");

                fputcsv($stream, $headers);

                foreach ($rows as $row) {
                    $line = [];

                    foreach ($headers as $header) {
                        $value = $row[$header] ?? '';

                        $line[] = is_scalar($value) || $value === null
                            ? (string) ($value ?? '')
                            : json_encode(
                                $value,
                                JSON_UNESCAPED_UNICODE
                                | JSON_UNESCAPED_SLASHES
                                | JSON_THROW_ON_ERROR,
                            );
                    }

                    fputcsv($stream, $line);
                }
            }

            rewind($stream);

            $contents = stream_get_contents($stream);

            if ($contents === false) {
                throw new RuntimeException('Unable to read CSV stream.');
            }

            if (! Storage::disk(self::DISK)->put($path, $contents)) {
                throw new RuntimeException('Unable to save CSV export.');
            }
        } finally {
            fclose($stream);
        }
    }

    /**
     * Write an XLSX file using Laravel Excel.
     *
     * Requires maatwebsite/excel and a dedicated export class.
     *
     * @param list<array<string, mixed>> $rows
     */
    private function writeXlsx(string $path, array $rows): void
    {
        if (! class_exists(\Maatwebsite\Excel\Facades\Excel::class)) {
            throw new RuntimeException(
                'XLSX export requires maatwebsite/excel. '
                . 'Install it before generating XLSX files.'
            );
        }

        if (! class_exists(
            \App\Domain\Reports\Exports\ArrayReportExport::class
        )) {
            throw new RuntimeException(
                'Create the ArrayReportExport class before generating XLSX.'
            );
        }

        $export = new \App\Domain\Reports\Exports\ArrayReportExport($rows);

        $stored = \Maatwebsite\Excel\Facades\Excel::store(
            $export,
            $path,
            self::DISK,
        );

        if (! $stored) {
            throw new RuntimeException('Unable to save XLSX export.');
        }
    }

    /**
     * Build a streamed response for a stored export.
     */
    public function download(ReportExport $export): StreamedResponse
    {
        if ($export->status !== 'completed' || ! $export->file_path) {
            throw new RuntimeException(
                'This export is not available for download.'
            );
        }

        $disk = Storage::disk(self::DISK);

        if (! $disk->exists($export->file_path)) {
            throw new RuntimeException('The export file no longer exists.');
        }

        $filename = basename($export->file_path);

        return $disk->download($export->file_path, $filename);
    }

    /**
     * Delete the generated file, if one exists.
     */
    public function delete(ReportExport $export): bool
    {
        if (! $export->file_path) {
            return true;
        }

        $disk = Storage::disk(self::DISK);

        if (! $disk->exists($export->file_path)) {
            return true;
        }

        return $disk->delete($export->file_path);
    }
}
