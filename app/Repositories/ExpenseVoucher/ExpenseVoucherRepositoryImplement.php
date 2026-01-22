<?php

namespace App\Repositories\ExpenseVoucher;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\ExpenseVoucher;
use Illuminate\Support\Facades\DB;

class ExpenseVoucherRepositoryImplement extends Eloquent implements ExpenseVoucherRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(ExpenseVoucher $model)
    {
        $this->model = $model;
    }

    public function all($perPage = 10)
    {
        return $this->model->with('details')->paginate($perPage);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->with('details')->findOrFail($id);
    }

    public function update($id, $data)
    {
        $voucher = $this->model->find($id);

        if(is_null($voucher)) {
            return null;
        }

        return $voucher->update($data);
    }

    public function delete($id)
    {
        $voucher = $this->find($id);
        return $voucher->delete();
    }

    public function search($search, $perPage = 10)
    {
        $query = $this->model->with('details');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('number', 'like', "%{$search}%")
                ->orWhere('paid_to', 'like', "%{$search}%")
                ->orWhereHas('details', function ($dq) use ($search) {
                    $dq->where('description', 'like', "%{$search}%");
                });
            });
        }

        return $query->latest()->paginate($perPage);
    }

    public function getDaily($year, $month)
    {
        return DB::table('expense_vouchers as ev')
            ->join('expense_details as ed', 'ed.expense_voucher_id', '=', 'ev.id')
            ->select(
                'ev.date',
                'ed.description as keterangan',
                'ed.amount as pengeluaran',
                DB::raw('0 as penerimaan')
            )
            ->whereYear('ev.date', $year)
            ->whereMonth('ev.date', $month)
            ->orderBy('ev.date')
            ->get();
    }

    public function getMonthly($year)
    {
        return DB::table('expense_vouchers')
            ->selectRaw('MONTH(date) as month, SUM(total) as total')
            ->whereYear('date', $year)
            ->groupBy(DB::raw('MONTH(date)'))
            ->pluck('total', 'month');
    }
}
