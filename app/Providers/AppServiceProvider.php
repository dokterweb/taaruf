<?php

namespace App\Providers;
use Midtrans\Config as MidtransConfig;
use Illuminate\Support\Facades\Log;
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
        \Midtrans\Config::$serverKey    = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized  = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds        = config('midtrans.is_3ds');
       
        $ca = storage_path('certs/cacert.pem');

        \Midtrans\Config::$curlOptions = array_replace(\Midtrans\Config::$curlOptions ?? [], [
            CURLOPT_HTTPHEADER     => [],      // penting!
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_CAINFO         => $ca,     // <-- sekarang file-nya ada
            // DEV Windows (opsional jika masih kena revocation):
            // CURLOPT_SSL_OPTIONS => defined('CURLSSLOPT_NO_REVOKE') ? CURLSSLOPT_NO_REVOKE : 0,
        ]);
        
    }
}
