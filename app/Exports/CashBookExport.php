<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CashBookExport implements FromView, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected array $rows;
    protected int $year;
    protected float $saldoAwalTahun;

    public function __construct(array $rows, int $year, float $saldoAwalTahun)
    {
        $this->rows = $rows;
        $this->year = $year;
        $this->saldoAwalTahun = $saldoAwalTahun;
    } 

    public function view(): View
    {
        return view('exports.cash-book', [
            'rows' => $this->rows,
            'year' => $this->year,
            'saldoAwalTahun' => $this->saldoAwalTahun,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            6 => ['font' => ['bold' => true]], // header table
        ];
    }

    public function collection()
    {
        //
    }
}
