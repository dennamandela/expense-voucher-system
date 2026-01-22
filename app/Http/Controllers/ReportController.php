<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Report\ReportService;
use App\Services\InitialBalance\InitialBalanceService;
use App\Exports\CashBookExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{

    public function __construct(ReportService $reportService, InitialBalanceService $initialBalanceService)
    {
        $this->reportService = $reportService;
        $this->initialBalanceService = $initialBalanceService;
    }

    public function cashBook(Request $request)
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);
        $type  = $request->get('type', 'monthly');

        if ($type === 'daily') {
            $rows = $this->reportService->daily($year, $month);
        } else {
            $rows = $this->reportService->monthly($year);
        }

        return view('reports.cash-book', [
            'rows'  => $rows,
            'year'  => $year,
            'month' => $month,
            'type'  => $type,
        ]);
    }

    /**
     * Export laporan ke Excel
     */
    public function exportCashBook(Request $request)
    {
        $year = (int) $request->get('year', now()->year);

        $openingBalances = $this->initialBalanceService->getByYear($year);
        $rows = $this->reportService->cashBook($year, $openingBalances);
        $saldoAwalTahun = (float) ($openingBalances[1] ?? 0);

        return Excel::download(
            new CashBookExport($rows, $year, $saldoAwalTahun),
            "Buku_Kas_Umum_{$year}.xlsx"
        );
    }
}
