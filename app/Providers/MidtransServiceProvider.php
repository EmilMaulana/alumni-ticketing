<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Midtrans\Config;

class MidtransServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');  // Masukkan Server Key dari .env
        Config::$isProduction = false; // Set ke true saat di production
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
}
