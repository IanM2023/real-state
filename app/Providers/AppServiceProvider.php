<?php

namespace App\Providers;

use App\Models\SMTP;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config as FacadesConfig;

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
        Paginator::useBootstrap();

        $mailsetting = SMTP::find(1);

        if($mailsetting) {
            $data = [
                'driver'    => $mailsetting->mail_mailer,
                'host'      => $mailsetting->mail_host,
                'port'      => $mailsetting->mail_port,
                'encryption'=> $mailsetting->mail_encryption,
                'username'  => $mailsetting->mail_username,
                'password'  => $mailsetting->mail_password,
                'from' => [
                    'address' => $mailsetting->mail_from_address,
                    'name'    => $mailsetting->app_name,
                ]
            ];

            $appName = [
                'name' => $mailsetting->app_name
            ];

            FacadesConfig::set('app.name', $appName['name']);
            FacadesConfig::set('mail', $data);
        }
    }
}
