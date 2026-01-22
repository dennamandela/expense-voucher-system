<?php

namespace App\Services\Report;

use LaravelEasyRepository\BaseService;

interface ReportService extends BaseService{

    // Write something awesome :)
    public function daily($year, $month);
    public function monthly($year);
}
