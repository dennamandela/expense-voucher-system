<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Report\ReportService;
use App\Services\InitialBalance\InitialBalanceService;
use App\Exports\CashBookDailyExport;
use App\Exports\CashBookMonthlyExport;
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
        $type = $request->get('type'); // daily | monthly
        $year = (int) $request->get('year', now()->year);

        if ($type === 'daily') {
            $month = (int) $request->get('month', now()->month);
            $rows  = $this->reportService->daily($year, $month);

            return Excel::download(
                new CashBookDailyExport($rows, $year, $month),
                "Buku_Kas_Harian_{$year}_{$month}.xlsx"
            );
        }

        $rows = $this->reportService->monthly($year);

        return Excel::download(
            new CashBookMonthlyExport($rows, $year),
            "Buku_Kas_Bulanan_{$year}.xlsx"
        );
    }
}
