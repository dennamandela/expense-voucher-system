<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CashBookDailyExport implements FromView, WithStyles
{
    protected array $rows;
    protected int $year;
    protected int $month;

    public function __construct(array $rows, int $year, int $month)
    {
        $this->rows  = $rows;
        $this->year  = $year;
        $this->month = $month;
    }

    public function view(): View
    {
        return view('exports.cash-book-daily', [
            'rows'  => $this->rows,
            'year'  => $this->year,
            'month' => $this->month,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            7 => ['font' => ['bold' => true]], // header tabel
        ];
    }
}
