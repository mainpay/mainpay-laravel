<?php

namespace MainPay\Laravel\Tests;

use Illuminate\Support\Facades\Route;
use MainPay;

class RouteTest extends TestCase
{
    protected function assertRoutesContains($routes)
    {
        $all_routes = collect(Route::getRoutes())->map(function ($route) {
            return [
                'method' => implode('|', $route->methods()),
                'uri'    => $route->uri(),
                'name'   => $route->getName(),
                'action' => ltrim($route->getActionName(), '\\'),
            ];
        })->all();

        foreach ($routes as $route) {
            $this->assertContains($route, $all_routes);
        }
    }

    protected function assertRoutesNotContains($routes)
    {
        $all_routes = collect(Route::getRoutes())->map(function ($route) {
            return [
                'method' => implode('|', $route->methods()),
                'uri'    => $route->uri(),
                'name'   => $route->getName(),
                'action' => ltrim($route->getActionName(), '\\'),
            ];
        })->all();

        foreach ($routes as $route) {
            $this->assertNotContains($route, $all_routes);
        }
    }

    public function testGeneratingRoutes()
    {
        MainPay::routes();

        $enabled_routes = [
            [
                "method" => "POST",
                "uri" => "mainpay/notification",
                "name" => "mainpay.notification",
                "action" => "MainPayController@notification",
            ],
            [
                "method" => "GET|HEAD",
                "uri" => "mainpay/finished",
                "name" => "mainpay.finished",
                "action" => "MainPayController@finished",
            ],
            [
                "method" => "GET|HEAD",
                "uri" => "mainpay/unfinished",
                "name" => "mainpay.unfinished",
                "action" => "MainPayController@unfinished",
            ],
            [
                "method" => "GET|HEAD",
                "uri" => "mainpay/error",
                "name" => "mainpay.error",
                "action" => "MainPayController@error",
            ],
        ];

        $this->assertRoutesContains($enabled_routes);
    }

    public function testGeneratingRoutesWithoutNotificationRoute()
    {
        MainPay::routes([
            'notification' => false,
        ]);

        $enabled_routes = [
            [
                "method" => "GET|HEAD",
                "uri" => "mainpay/finished",
                "name" => "mainpay.finished",
                "action" => "MainPayController@finished",
            ],
            [
                "method" => "GET|HEAD",
                "uri" => "mainpay/unfinished",
                "name" => "mainpay.unfinished",
                "action" => "MainPayController@unfinished",
            ],
            [
                "method" => "GET|HEAD",
                "uri" => "mainpay/error",
                "name" => "mainpay.error",
                "action" => "MainPayController@error",
            ],
        ];

        $disabled_routes = [
            [
                "method" => "POST",
                "uri" => "mainpay/notification",
                "name" => "mainpay.notification",
                "action" => "MainPayController@notification",
            ],
        ];

        $this->assertRoutesContains($enabled_routes);
        $this->assertRoutesNotContains($disabled_routes);
    }

    public function testGeneratingRoutesWithoutFinishedRoute()
    {
        MainPay::routes([
            'finished' => false,
        ]);

        $enabled_routes = [
            [
                "method" => "POST",
                "uri" => "mainpay/notification",
                "name" => "mainpay.notification",
                "action" => "MainPayController@notification",
            ],
            [
                "method" => "GET|HEAD",
                "uri" => "mainpay/unfinished",
                "name" => "mainpay.unfinished",
                "action" => "MainPayController@unfinished",
            ],
            [
                "method" => "GET|HEAD",
                "uri" => "mainpay/error",
                "name" => "mainpay.error",
                "action" => "MainPayController@error",
            ],
        ];

        $disabled_routes = [
            [
                "method" => "GET|HEAD",
                "uri" => "mainpay/finished",
                "name" => "mainpay.finished",
                "action" => "MainPayController@finished",
            ],
        ];

        $this->assertRoutesContains($enabled_routes);
        $this->assertRoutesNotContains($disabled_routes);
    }

    public function testGeneratingRoutesWithoutUnfinishedRoute()
    {
        MainPay::routes([
            'unfinished' => false,
        ]);

        $enabled_routes = [
            [
                "method" => "POST",
                "uri" => "mainpay/notification",
                "name" => "mainpay.notification",
                "action" => "MainPayController@notification",
            ],
            [
                "method" => "GET|HEAD",
                "uri" => "mainpay/finished",
                "name" => "mainpay.finished",
                "action" => "MainPayController@finished",
            ],
            [
                "method" => "GET|HEAD",
                "uri" => "mainpay/error",
                "name" => "mainpay.error",
                "action" => "MainPayController@error",
            ],
        ];

        $disabled_routes = [
            [
                "method" => "GET|HEAD",
                "uri" => "mainpay/unfinished",
                "name" => "mainpay.unfinished",
                "action" => "MainPayController@unfinished",
            ],
        ];

        $this->assertRoutesContains($enabled_routes);
        $this->assertRoutesNotContains($disabled_routes);
    }

    public function testGeneratingRoutesWithoutErrorRoute()
    {
        MainPay::routes([
            'error' => false,
        ]);

        $enabled_routes = [
            [
                "method" => "POST",
                "uri" => "mainpay/notification",
                "name" => "mainpay.notification",
                "action" => "MainPayController@notification",
            ],
            [
                "method" => "GET|HEAD",
                "uri" => "mainpay/finished",
                "name" => "mainpay.finished",
                "action" => "MainPayController@finished",
            ],
            [
                "method" => "GET|HEAD",
                "uri" => "mainpay/unfinished",
                "name" => "mainpay.unfinished",
                "action" => "MainPayController@unfinished",
            ],
        ];

        $disabled_routes = [
            [
                "method" => "GET|HEAD",
                "uri" => "mainpay/error",
                "name" => "mainpay.error",
                "action" => "MainPayController@error",
            ],
        ];

        $this->assertRoutesContains($enabled_routes);
        $this->assertRoutesNotContains($disabled_routes);
    }
}
