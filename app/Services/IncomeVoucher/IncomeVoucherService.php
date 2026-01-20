<?php

namespace App\Services\IncomeVoucher;

use LaravelEasyRepository\BaseService;

interface IncomeVoucherService extends BaseService{

    // Write something awesome :)

    public function getAll($perPage = 5);
    public function getById($id);
    public function createIncome($data);
    public function printPdf($id);
    
    public function updateIncome($id, $data);
    public function deleteIncome($id);
    // public function getSearch($data, $perPage);
}
