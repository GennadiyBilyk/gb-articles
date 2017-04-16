<?php

namespace GennadiyBilyk\Articles;

use Illuminate\Support\ServiceProvider;

class ArticlesProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            __DIR__.'/src/Http/Sections' => app_path('/Http/Sections')
        ], 'sections');


        $this->publishes([
            __DIR__.'/src/Models/Article' => app_path('/Models/Article')
        ], 'models');

        //
        $this->publishes([
            __DIR__.'/src/database/migrations/' => base_path('/database/migrations'),


        ], 'migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
