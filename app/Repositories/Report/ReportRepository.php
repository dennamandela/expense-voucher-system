<?php

namespace App\Repositories\Report;

use LaravelEasyRepository\Repository;

interface ReportRepository extends Repository{

    // Write something awesome :)

    public function cashBook(int $year, ?string $paymentMethod = null);
}
