<?php

namespace JePaFe\Blog;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'blog');
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/blog'),
        ], 'blog-views');
        $this->mergeConfigFrom(__DIR__ . '/../config/blog.php', 'blog');
        $this->publishes([
            __DIR__ . '/../config/blog.php' => config_path('blog.php'),
        ], 'blog-config');
    }
}
