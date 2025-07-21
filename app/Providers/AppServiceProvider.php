<?php

namespace App\Providers;

use Carbon\Carbon;
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
        // Set locale Carbon ke Bahasa Indonesia
        Carbon::setLocale('id');

        // Opsional: Set locale PHP untuk fungsi strftime() atau format lokal lain
        setlocale(LC_TIME, 'id_ID.utf8', 'id_ID', 'id');
    }
}
