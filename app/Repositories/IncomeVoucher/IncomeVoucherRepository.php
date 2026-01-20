<?php

namespace App\Repositories\IncomeVoucher;

use LaravelEasyRepository\Repository;

interface IncomeVoucherRepository extends Repository{

    // Write something awesome :)

    public function all();
    public function create($data);
    public function find($id);
    public function update($id, $data);
    public function delete($id);
    public function search($search, $perPage = 5);

    public function getDaily($year, $month);
    public function getMonthly($year);


}
