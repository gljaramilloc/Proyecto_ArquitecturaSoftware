<?php

namespace App\Providers;

use App\Interfaces\PaymentProcessor;
use App\Models\Payment;
use App\Services\Payment\BalancePaymentProcessor;
use App\Services\Payment\ChequePdfPaymentProcessor;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // The concrete PaymentProcessor is chosen from the "method" parameter:
        // app()->makeWith(PaymentProcessor::class, ['method' => 'balance'])
        $this->app->bind(PaymentProcessor::class, function (Application $app, array $parameters): PaymentProcessor {
            $method = $parameters['method'] ?? Payment::METHOD_CHEQUE;

            if ($method === Payment::METHOD_BALANCE) {
                return $app->make(BalancePaymentProcessor::class);
            }

            return $app->make(ChequePdfPaymentProcessor::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // The views are built with Bootstrap 5, so the pagination links must use its markup
        Paginator::useBootstrapFive();
    }
}
