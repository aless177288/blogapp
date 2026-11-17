<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // View Composer para inyectar $categories en las vistas públicas sin consultas redundantes
        View::composer(['layout', 'welcome', 'posts.*'], function ($view) {
            $categories = cache()->remember('nav_categories', 3600, function () {
                return Category::all();
            });
            $view->with('categories', $categories);
        });
    }
}
