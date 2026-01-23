<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CashBookMonthlyExport implements FromView, WithStyles
{
    protected array $rows;
    protected int $year;

    public function __construct(array $rows, int $year)
    {
        $this->rows = $rows;
        $this->year = $year;
    }

    public function view(): View
    {
        return view('exports.cash-book-monthly', [
            'rows' => $this->rows,
            'year' => $this->year,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            7 => ['font' => ['bold' => true]], // header tabel
        ];
    }
}
