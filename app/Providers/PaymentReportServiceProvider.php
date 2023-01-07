<?php

namespace App\Providers;

use App\Interfaces\report\PaymentReportInterface;
use App\Repositories\report\PaymentReportRepository;
use Illuminate\Support\ServiceProvider;

class PaymentReportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PaymentReportInterface::class,PaymentReportRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
