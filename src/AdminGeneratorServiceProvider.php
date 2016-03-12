<?php namespace Interpro\AdminGenerator;

use Illuminate\Support\ServiceProvider;

class AdminGeneratorServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('AdminGenerator', function () {
            return new AdminGenerator;
        });
    }
    public function boot(){
        require __DIR__ . '/Laravel/Http/routes.php';
    }

}