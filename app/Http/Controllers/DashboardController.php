<?php

namespace App\Http\Controllers;

use App\Models\ExpenseVoucher;
use App\Models\IncomeVoucher;
use App\Models\InitialBalance;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $month = now()->month;
        $year  = now()->year;

        /**
         * ================= SALDO AWAL =================
         */
        $saldoAwal = InitialBalance::where('year', $year)
            ->where('month', $month)
            ->value('amount') ?? 0;

        /**
         * ================= TOTAL PENERIMAAN =================
         */
        $totalIncome = IncomeVoucher::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->sum('total');

        /**
         * ================= TOTAL PENGELUARAN =================
         */
        $totalExpense = ExpenseVoucher::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->sum('total');

        /**
         * ================= SALDO AKHIR =================
         */
        $saldoAkhir = $saldoAwal + $totalIncome - $totalExpense;

        /**
         * ================= TRANSAKSI TERAKHIR =================
         * Gabungan bon penerimaan & pengeluaran
         */
        $latestIncome = IncomeVoucher::select(
                'date',
                'number',
                'total',
                'notes as subject'
            )
            ->addSelect(DB::raw("'INCOME' as type"))
            ->latest('date')
            ->limit(5);

        $latestExpense = ExpenseVoucher::select(
                'date',
                'number',
                'total',
                'notes as subject'
            )
            ->addSelect(DB::raw("'EXPENSE' as type"))
            ->latest('date')
            ->limit(5);

        $latestTransactions = $latestIncome
            ->unionAll($latestExpense)
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'saldoAwal',
            'totalIncome',
            'totalExpense',
            'saldoAkhir',
            'latestTransactions'
        ));
    }
}
