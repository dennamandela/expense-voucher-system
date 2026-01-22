<?php

namespace App\Services\Report;

use LaravelEasyRepository\Service;
use App\Repositories\Report\ReportRepository;
use App\Repositories\IncomeVoucher\IncomeVoucherRepository;
use App\Repositories\ExpenseVoucher\ExpenseVoucherRepository;
use App\Repositories\InitialBalance\InitialBalanceRepository;
use Carbon\CarbonPeriod;

class ReportServiceImplement extends Service implements ReportService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;
    protected $incomeRepository;
    protected $expenseRepository;
    protected $initialBalanceRepository;

    public function __construct(ReportRepository $mainRepository, IncomeVoucherRepository $incomeRepository, InitialBalanceRepository $initialBalanceRepository, ExpenseVoucherRepository $expenseRepository)
    {
      $this->mainRepository = $mainRepository;
      $this->incomeRepository = $incomeRepository;
      $this->expenseRepository = $expenseRepository;
      $this->initialBalanceRepository = $initialBalanceRepository;
    }

    public function daily($year, $month)
    {
        $saldo = $this->initialBalanceRepository->getByMonth($year, $month);

        $expenses = $this->expenseRepository->getDaily($year, $month);
        $incomes  = $this->incomeRepository->getDaily($year, $month);

        $transactions = $expenses
            ->merge($incomes)
            ->sortBy('date')
            ->values();

        $rows = [];

        foreach ($transactions as $trx) {
            $saldoSebelum = $saldo;

            $saldo = $saldo + $trx->penerimaan - $trx->pengeluaran;

            $rows[] = [
                'tanggal'      => $trx->date,
                'keterangan'   => $trx->keterangan,
                'saldo_awal'   => $saldoSebelum,
                'penerimaan'   => $trx->penerimaan,
                'pengeluaran'  => $trx->pengeluaran,
                'saldo_akhir'  => $saldo,
            ];
        }

        return $rows;

    }

    public function monthly($year)
    {
        $openingBalances = $this->initialBalanceRepository->getByYear($year);
        $expenses = $this->expenseRepository->getMonthly($year);
        $incomes = $this->incomeRepository->getMonthly($year);

        $rows = [];

        foreach (range(1, 12) as $month) {
            $saldoAwal = ($openingBalances[$month] ?? 0);
            $penerimaan = ($incomes[$month] ?? 0);
            $pengeluaran = ($expenses[$month] ?? 0);

            $rows[] = [
                'bulan' => $month,
                'saldo_awal' => $saldoAwal,
                'penerimaan' => $penerimaan,
                'pengeluaran' => $pengeluaran,
                'saldo_akhir' => $saldoAwal + $penerimaan - $pengeluaran,
            ];
        }

        return $rows;
    }


    // Define your custom methods :)
}
