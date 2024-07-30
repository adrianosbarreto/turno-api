<?php

namespace App\Providers;

use App\Models\Expense;
use App\Models\Income;
use App\Services\CheckService;
use App\Services\CheckServicesInterface;
use App\Services\IncomeService;
use App\Services\IncomeServicesInterface;
use App\Services\TransactionService;
use App\Services\TransactionServicesInterface;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            'income' => 'App\Models\Income',
            'expense' => 'App\Models\Expense',
        ]);

        $this->app->bind(CheckServicesInterface::class, CheckService::class);
        $this->app->bind(IncomeServicesInterface::class, IncomeService::class);
        $this->app->bind(TransactionServicesInterface::class, TransactionService::class);
    }
}
