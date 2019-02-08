<?php

namespace MainPay\Laravel\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use MainPay\Laravel\MainPayServiceProvider;
use MainPay\Laravel\Facades\MainPay;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [MainPayServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'MainPay' => MainPay::class,
        ];
    }
}
