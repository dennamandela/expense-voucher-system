<?php

namespace App\Repositories\IncomeDetail;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\IncomeVoucherDetail;

class IncomeDetailRepositoryImplement extends Eloquent implements IncomeDetailRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(IncomeVoucherDetail $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
