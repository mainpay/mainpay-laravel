<?php

namespace MainPay\Laravel\Console;

use Illuminate\Console\Command;
use Illuminate\Console\DetectsApplicationNamespace;
use Illuminate\Filesystem\Filesystem;

class ScaffoldCommand extends Command
{
    use DetectsApplicationNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mainpay:scaffold';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold MainPay controller and routes';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->files = new Filesystem();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->createController();
        $this->createRoutes();

        $this->info('MainPay scaffolding generated successfully.');
    }

    /**
     * Create controller file.
     *
     * @return void
     */
    protected function createController()
    {
        $controller = str_replace('{{namespace}}', $this->getAppNamespace(), $this->files->get(__DIR__.'/stubs/MainPayController.stub'));
        $controller_path = app_path('Http/Controllers/MainPayController.php');

        $this->makeDirectory($controller_path);
        $this->files->put($controller_path, $controller);
    }

    /**
     * Create routes file.
     *
     * @return void
     */
    protected function createRoutes()
    {
        $routes = $this->files->get(__DIR__.'/stubs/routes.stub');
        $routes_path = base_path('routes/web.php');

        if ($this->files->exists($routes_path)) {
            $this->files->append($routes_path, $routes);
        }else {
            $prefix = "<?php \n";
            $routes = $prefix.$routes;

            $this->makeDirectory($routes_path);
            $this->files->put($routes_path, $routes);
        }
    }

    /**
     * Build the directory for the files if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0755, true, true);
        }

        return $path;
    }
}
