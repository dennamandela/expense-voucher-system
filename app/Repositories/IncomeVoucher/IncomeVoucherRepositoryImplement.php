<?php

namespace App\Repositories\IncomeVoucher;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\IncomeVoucher;
use Illuminate\Support\Facades\DB;

class IncomeVoucherRepositoryImplement extends Eloquent implements IncomeVoucherRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(IncomeVoucher $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)

    public function all($perPage = 5)
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
        $incomeVoucher = $this->model->find($id);

        if(is_null($incomeVoucher)) {
            return null;
        }

        return $incomeVoucher->update($data);
    }

    public function delete($id)
    {
        $incomeVoucher = $this->find($id);
        return $incomeVoucher->delete();
    }

    public function search($search, $perPage = 10)
    {
        $query = $this->model->with('details');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('number', 'like', "%{$search}%")
                ->orWhere('received_from', 'like', "%{$search}%")
                ->orWhereHas('details', function ($dq) use ($search) {
                    $dq->where('description', 'like', "%{$search}%");
                });
            });
        }

        return $query->latest()->paginate($perPage);
    }

    public function getDaily($year, $month)
    {
        return DB::table('income_vouchers as iv')
            ->join('income_details as id', 'id.income_voucher_id', '=', 'iv.id')
            ->select(
                'iv.date',
                'id.description as keterangan',
                'id.amount as penerimaan',
                DB::raw('0 as pengeluaran')
            )
            ->whereYear('iv.date', $year)
            ->whereMonth('iv.date', $month)
            ->orderBy('iv.date')
            ->get();
    }

    public function getMonthly($year)
    {
        return DB::table('income_vouchers')
            ->selectRaw('MONTH(date) as month, SUM(total) as total')
            ->whereYear('date', $year)
            ->groupBy(DB::raw('MONTH(date)'))
            ->pluck('total', 'month');
    }
}
