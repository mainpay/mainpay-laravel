<?php

namespace MainPay\Laravel;

use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->config_path, 'mainpay');
    }
}
