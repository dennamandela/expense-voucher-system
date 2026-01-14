<?php

namespace App\Services\Report;

use LaravelEasyRepository\BaseService;

interface ReportService extends BaseService{

    // Write something awesome :)
    public function cashBook(int $year, array $openingBalances);
}
