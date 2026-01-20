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
use App\Repositories\IncomeVoucher\IncomeVoucherRepository;
use App\Repositories\IncomeVoucher\IncomeVoucherRepositoryImplement;
use App\Repositories\IncomeDetail\IncomeDetailRepository;
use App\Repositories\IncomeDetail\IncomeDetailRepositoryImplement;
use App\Services\ExpenseVoucher\ExpenseVoucherService;
use App\Services\ExpenseVoucher\ExpenseVoucherServiceImplement;
use App\Services\Report\ReportService;
use App\Services\Report\ReportServiceImplement;
use App\Services\InitialBalance\InitialBalanceService;
use App\Services\InitialBalance\InitialBalanceServiceImplement;
use App\Services\IncomeVoucher\IncomeVoucherService;
use App\Services\IncomeVoucher\IncomeVoucherServiceImplement;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Repository
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

        $this->app->bind(
            IncomeVoucherRepository::class,
            IncomeVoucherRepositoryImplement::class
        );

        $this->app->bind(
            IncomeDetailRepository::class,
            IncomeDetailRepositoryImplement::class
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

        $this->app->bind(
            IncomeVoucherService::class,
            IncomeVoucherServiceImplement::class
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
