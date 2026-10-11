<?php

declare(strict_types=1);

namespace App\Domain\Reports\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

final class ArrayReportExport implements FromArray, WithHeadings
{
    /**
     * @param list<array<string, mixed>> $rows
     */
    public function __construct(
        private readonly array $rows,
    ) {
    }

    public function array(): array
    {
        return array_map(
            static fn (array $row): array => array_values($row),
            $this->rows,
        );
    }

    public function headings(): array
    {
        return $this->rows === []
            ? []
            : array_keys($this->rows[0]);
    }
}