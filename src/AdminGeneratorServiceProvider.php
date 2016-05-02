<?php namespace Interpro\AdminGenerator;

use Illuminate\Support\ServiceProvider;

class AdminGeneratorServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('admingenerator', function () {
            return new AdminGenerator;
        });
    }
    public function boot(){
        require __DIR__ . '/Laravel/Http/routes.php';
        $this->publishes([__DIR__ . '/Laravel/config/page.php' => config_path('page.php')]);
    }

}