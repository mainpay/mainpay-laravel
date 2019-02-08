<?php

namespace MainPay\Laravel\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Route;

class MainPay extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mainpay';
    }

    /**
     * Register the MainPay routes for an application.
     *
     * @param array $options
     * @return void
     */
    public static function routes(array $options = [])
    {
        Route::prefix('mainpay')->name('mainpay.')->group(function () use ($options) {
            if ($options['notification'] ?? true) {
                Route::post('/notification', 'MainPayController@notification')->name('notification');
            }

            if ($options['finished'] ?? true) {
                Route::get('/finished', 'MainPayController@finished')->name('finished');
            }

            if ($options['unfinished'] ?? true) {
                Route::get('/unfinished', 'MainPayController@unfinished')->name('unfinished');
            }

            if ($options['error'] ?? true) {
                Route::get('/error', 'MainPayController@error')->name('error');
            }
        });
    }
}
