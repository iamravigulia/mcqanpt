<?php

namespace edgewizz\mcqanpt;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class McqanptServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Edgewizz\Mcqanpt\Controllers\McqanptController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // dd($this);
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__ . '/components', 'mcqanpt');
        Blade::component('mcqanpt::mcqanpt.open', 'mcqanpt.open');
        Blade::component('mcqanpt::mcqanpt.index', 'mcqanpt.index');
        Blade::component('mcqanpt::mcqanpt.edit', 'mcqanpt.edit');
    }
}
