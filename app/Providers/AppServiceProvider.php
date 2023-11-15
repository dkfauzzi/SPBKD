<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using view composer to set following variables globally
        view()->composer('*', function ($view) {
            if (isset(auth()->user()->username)) {
                $view->with('notifikasi', DB::table('notifikasi')->where('notifikasi_own', auth()->user()->username)->orderBy('notifikasi_time', 'DESC')->get());
                if (DB::table('notifikasi')->where('notifikasi_own', auth()->user()->username)->where('notifikasi_read', '0')->count() > 0) {
                    $view->with('beepState', true);
                } else {
                    $view->with('beepState', false);
                }
            }
        });
    }
}