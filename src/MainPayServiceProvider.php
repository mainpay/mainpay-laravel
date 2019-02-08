<?php

namespace MainPay\Laravel;

use Illuminate\Support\ServiceProvider;
use MainPay\Laravel\Console\ScaffoldCommand;
use MainPay\MainPay;

class MainPayServiceProvider extends ServiceProvider
{
    /**
     * Package config path.
     *
     * @var string
     */
    protected $config_path = __DIR__.'/config/mainpay.php';

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            $this->config_path => config_path('mainpay.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([ScaffoldCommand::class]);
        }
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->config_path, 'mainpay');

        $this->app->singleton(MainPay::class, function () {
            return new MainPay([
                'server_key' => config('mainpay.server_key'),
                'production' => config('mainpay.production'),
            ]);
        });

        $this->app->alias(MainPay::class, 'mainpay');
    }
}
