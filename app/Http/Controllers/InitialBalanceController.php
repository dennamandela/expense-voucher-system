<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\InitialBalance\InitialBalanceService;

class InitialBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $openingBalanceService;

    public function __construct(InitialBalanceService $openingBalanceService)
    {
        $this->openingBalanceService = $openingBalanceService;
    }

    public function index()
    {
        $openingBalances = $this->openingBalanceService->getAll();

        return view('opening-balance.index', compact('openingBalances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer',
            'payment_method' => 'required|in:KAS,BANK',
            'amount' => 'required|numeric|min:0',
        ]);

        $this->openingBalanceService->createOpeningBalance($validated);

        return redirect()
            ->back()
            ->with('success', 'Saldo awal berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'year' => 'required|integer',
            'payment_method' => 'required|in:KAS,BANK',
            'amount' => 'required|numeric|min:0',
        ]);

        $this->openingBalanceService->updateOpeningBalance($id, $validated);

        return redirect()
            ->back()
            ->with('success', 'Saldo awal berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->openingBalanceService->deleteOpeningBalance($id);

        return redirect()
            ->back()
            ->with('success', 'Saldo awal berhasil dihapus');
    }
}
