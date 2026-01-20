<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestIncomeVoucher;
use App\Services\IncomeVoucher\IncomeVoucherService;

class IncomeVoucherController extends Controller
{
    private $incomeVoucherService;

    public function __construct(IncomeVoucherService $incomeVoucherService)
    {
        $this->incomeVoucherService = $incomeVoucherService;
    }

    public function index(Request $request)
    {
        try {
            $incomeVoucher = $this->incomeVoucherService->getSearch(
                $request->all(),
                5
            );

            return view('income-voucher.index', compact('incomeVoucher'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('income-voucher.create');
    }

    public function show($id)
    {
        $incomeVoucher = $this->incomeVoucherService->getById($id);

        if (!$incomeVoucher) {
            return redirect()
                ->route('income-voucher')
                ->with('error', 'Data penerimaan tidak ditemukan');
        }

        return view('income-voucher.detail', compact('incomeVoucher'));
    }

    public function store(RequestIncomeVoucher $request)
    {
        $incomeVoucher = $this->incomeVoucherService->createIncome($request->validated());

        return redirect()->route('income-voucher')->with('success', 'Bon penerimaan berhasil disimpan');
    }

    public function print($id)
    {
        $result = $this->incomeVoucherService->printPdf($id);

        return response(
            $result['dompdf']->output(),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' =>
                    'inline; filename="'.$result['filename'].'"',
            ]
        );
    }

    public function edit($id)
    {
        $incomeVoucher = $this->incomeVoucherService->getById($id);

        return view('income-voucher.edit', compact('incomeVoucher'));
    }

    public function update(RequestIncomeVoucher $request, $id)
    {
        $this->incomeVoucherService->updateIncome($id, $request->validated());

        return redirect()
            ->route('income-voucher')
            ->with('success', 'Bon penerimaan berhasil diperbarui');
    }

    public function destroy($id)
    {
        try {
            $this->incomeVoucherService->deleteIncome($id);
            return redirect()->route('income-voucher')->with('success', 'Bon penerimaan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menghapus Bon. Error: ' . $e->getMessage());
        }
    }
}
