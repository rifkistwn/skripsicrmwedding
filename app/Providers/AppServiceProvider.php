<?php

namespace App\Providers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
     *@return void
     */
    public function boot()
    {
        //start::client auth role checking
        Blade::if('client', function () {
            if(!auth()->user()) return false;

            return auth()->user()->hasRole('client') === true;
        });
        //end::client auth role checking

        $transaction = Transaction::whereDate('created_at', Carbon::today())->count();
        view()->share('transaction', $transaction);
    }
}
