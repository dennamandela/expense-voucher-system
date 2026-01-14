<?php

namespace App\Services\Report;

use LaravelEasyRepository\Service;
use App\Repositories\Report\ReportRepository;

class ReportServiceImplement extends Service implements ReportService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;
    protected array $months = [
      1 => 'Januari',
      2 => 'Februari',
      3 => 'Maret',
      4 => 'April',
      5 => 'Mei',
      6 => 'Juni',
      7 => 'Juli',
      8 => 'Agustus',
      9 => 'September',
      10 => 'Oktober',
      11 => 'November',
      12 => 'Desember',
    ];

    public function __construct(ReportRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function cashBook(int $year, array $openingBalances)
    {
        $expenses = $this->mainRepository->cashBook($year);
        $rows = [];

        foreach ($this->months as $num => $name) {
            $saldoAwal   = (float) ($openingBalances[$num] ?? 0);
            $pengeluaran = (float) ($expenses[$num] ?? 0);

            $saldoAkhir = $saldoAwal - $pengeluaran;

            $rows[] = [
                'bulan' => $name,
                'penerimaan' => 0,
                'pengeluaran' => $pengeluaran,
                'saldo' => $saldoAkhir,
                'keterangan' => '',
            ];
        }

        return $rows;
    }


    // Define your custom methods :)
}
