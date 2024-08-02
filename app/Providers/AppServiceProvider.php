<?php

namespace App\Providers;

use App\Exceptions\Handler;
use App\Services\AccountService;
use App\Services\AccountServicesInterface;
use App\Services\CheckService;
use App\Services\CheckServicesInterface;
use App\Services\IncomeService;
use App\Services\IncomeServicesInterface;
use App\Services\TransactionService;
use App\Services\TransactionServicesInterface;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');

        Relation::enforceMorphMap([
            'user' => 'App\Models\User',
            'income' => 'App\Models\Income',
            'expense' => 'App\Models\Expense',
        ]);

        $this->app->bind(CheckServicesInterface::class, CheckService::class);
        $this->app->bind(IncomeServicesInterface::class, IncomeService::class);
        $this->app->bind(TransactionServicesInterface::class, TransactionService::class);
        $this->app->bind(AccountServicesInterface::class, AccountService::class);

        $this->app->singleton(
            ExceptionHandler::class,
            Handler::class
        );

        $this->configureRateLimiting();

    }


    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            if ($user = $request->user()) {
                return Limit::perMinute(100)->by($user->id);
            }

            return Limit::perMinute(20)->by($request->ip());
        });


    }
}
