<?php

namespace App\Providers;

use App\Services\Auth\AuthService;
use App\Services\Auth\AuthServiceImplement;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\AuthRepositoryImplement;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryImplement;
use App\Repositories\ExpenseVoucher\ExpenseVoucherRepository;
use App\Repositories\ExpenseVoucher\ExpenseVoucherRepositoryImplement;
use App\Repositories\ExpenseDetail\ExpenseDetailRepository;
use App\Repositories\ExpenseDetail\ExpenseDetailRepositoryImplement;
use App\Repositories\Report\ReportRepository;
use App\Repositories\Report\ReportRepositoryImplement;
use App\Repositories\InitialBalance\InitialBalanceRepository;
use App\Repositories\InitialBalance\InitialBalanceRepositoryImplement;
use App\Services\ExpenseVoucher\ExpenseVoucherService;
use App\Services\ExpenseVoucher\ExpenseVoucherServiceImplement;
use App\Services\Report\ReportService;
use App\Services\Report\ReportServiceImplement;
use App\Services\InitialBalance\InitialBalanceService;
use App\Services\InitialBalance\InitialBalanceServiceImplement;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //User Repository
        $this->app->bind(
            UserRepository::class,
            UserRepositoryImplement::class
        );

        $this->app->bind(
            ExpenseVoucherRepository::class,
            ExpenseVoucherRepositoryImplement::class
        );

        $this->app->bind(
            ExpenseDetailRepository::class,
            ExpenseDetailRepositoryImplement::class
        );

        $this->app->bind(
            ReportRepository::class,
            ReportRepositoryImplement::class
        );

        $this->app->bind(
            InitialBalanceRepository::class,
            InitialBalanceRepositoryImplement::class
        );

        //Services
        $this->app->bind(
            AuthService::class,
            AuthServiceImplement::class
        );

        $this->app->bind(
            ExpenseVoucherService::class,
            ExpenseVoucherServiceImplement::class
        );
        
        $this->app->bind(
            ReportService::class,
            ReportServiceImplement::class
        );

        $this->app->bind(
            InitialBalanceService::class,
            InitialBalanceServiceImplement::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
