<?php

namespace App\Repositories\InitialBalance;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\InitialBalance;
use Illuminate\Support\Facades\DB;

class InitialBalanceRepositoryImplement extends Eloquent implements InitialBalanceRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(InitialBalance $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)

    public function all()
    {
        return $this->model->all();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function update($id, $data)
    {
        $openingBalance = $this->model->find($id);

        if(is_null($openingBalance)) {
            return null;
        }

        return $openingBalance->update($data);
    }

    public function delete($id)
    {
        $openingBalance = $this->find($id);
        return $openingBalance->delete();
    }

    public function getByYear($year)
    {
        return DB::table('initial_balances')
            ->where('year', $year)
            ->pluck('amount', 'month')
            ->toArray();
    }

    public function getByMonth($year, $month)
    {
        return DB::table('initial_balances')
            ->where('year', $year)
            ->where('month', $month)
            ->value('amount') ?? 0;
    }
}
