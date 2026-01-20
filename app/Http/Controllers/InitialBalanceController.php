<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\InitialBalance\InitialBalanceService;
use App\Http\Requests\RequestInitialBalance;

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
    public function store(RequestInitialBalance $request)
    {
        $this->openingBalanceService->createOpeningBalance($request->validated());

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
    public function update(RequestInitialBalance $request, string $id)
    {
        $this->openingBalanceService->updateOpeningBalance($id, $request->validated());

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
