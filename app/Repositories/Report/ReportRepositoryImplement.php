<?php

namespace App\Repositories\Report;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Report;
use Illuminate\Support\Facades\DB;

class ReportRepositoryImplement extends Eloquent implements ReportRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Report $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)

    public function cashBook(int $year, ?string $paymentMethod = null)
    {
        $monthlyExpenses = DB::table('expense_vouchers')
            ->selectRaw('MONTH(date) as month, SUM(total) as total')
            ->whereYear('date', $year)
            ->when($paymentMethod, fn($q) => 
                $q->where('payment_method', $paymentMethod)
            )
            ->groupByRaw('MONTH(date)')
            ->pluck('total', 'month');
        
        $openingBalance = DB::table('initial_balances')
            ->where('year', $year)
            ->when($paymentMethod, fn($q) => 
                $q->where('payment_method', $paymentMethod)
            )
            ->value('amount') ?? 0;
        
        if (isset($monthlyExpenses[1])) {
            $monthlyExpenses[1] += $openingBalance;
        } else {
            $monthlyExpenses[1] = $openingBalance;
        }

        return $monthlyExpenses;
    }
}