<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Report\ReportService;
use App\Services\InitialBalance\InitialBalanceService;

class ReportController extends Controller
{

    public function __construct(ReportService $reportService, InitialBalanceService $initialBalanceService)
    {
        $this->reportService = $reportService;
        $this->initialBalanceService = $initialBalanceService;
    }

    public function cashBook(Request $request)
    {
        $year = (int) $request->get('year', now()->year);
        $paymentMethod = $request->get('payment_method');

        // sementara hardcode, nanti bisa dari tabel setting
        $openingBalance = $this->initialBalanceService->getByYearAndMethod($year, $paymentMethod);

        $saldoAwal = $openingBalance?->amount ?? 0;

        $rows = $this->reportService->cashBook(
            $year,
            $saldoAwal,
            $paymentMethod
        );

        return view('reports.cash-book', [
            'rows' => $rows,
            'year' => $year,
            'saldoAwal' => $saldoAwal,
            'paymentMethod' => $paymentMethod,
        ]);
    }

    /**
     * Export laporan ke Excel
     */
    public function exportCashBook(Request $request)
    {
        $year = (int) $request->get('year', now()->year);
        $paymentMethod = $request->get('payment_method');
        $saldoAwal = 7_890_222;

        $rows = $this->reportService->cashBook(
            $year,
            $saldoAwal,
            $paymentMethod
        );

        return Excel::download(
            new RekapKasExport($rows, $year, $saldoAwal),
            "rekap-buku-kas-{$year}.xlsx"
        );
    }
}
