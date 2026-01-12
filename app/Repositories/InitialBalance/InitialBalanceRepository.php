<?php

namespace App\Repositories\InitialBalance;

use LaravelEasyRepository\Repository;

interface InitialBalanceRepository extends Repository{

    // Write something awesome :)

    public function all();
    public function create($data);
    public function find($id);
    public function update($id, $data);
    public function delete($id);

    public function findByYearAndMethod($year, $paymentMethod);
    // public function search($search, $perPage = 10);
}
