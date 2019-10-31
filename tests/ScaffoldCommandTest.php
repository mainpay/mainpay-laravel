<?php

namespace MainPay\Laravel\Tests;

use Illuminate\Filesystem\Filesystem;

class ScaffoldCommandTest extends TestCase
{
    protected $files;

    protected function setUp() : void
    {
        parent::setUp();

        $this->files = new Filesystem();
    }

    public function testScaffolding()
    {
        $this->artisan('mainpay:scaffold')
             ->expectsOutput('MainPay scaffolding generated successfully.');

        $routes_path = base_path('routes/web.php');
        $routes_content = $this->files->get($routes_path);

        $controller_path = app_path('Http/Controllers/MainPayController.php');
        $controller_content = $this->files->get($controller_path);

        $this->assertStringContainsString('MainPay::routes()', $routes_content);
        $this->assertStringContainsString('class MainPayController', $controller_content);
    }
}
