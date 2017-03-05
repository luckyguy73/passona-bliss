<?php

namespace App\Providers;

use App\{Area, Category};
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\{AreaComposer, NavigationComposer};

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', AreaComposer::class);
        View::composer('layouts.partials.nav', NavigationComposer::class);
        
        View::composer(['listings.partials.forms.areas'], function ($view) {
            $areas = Area::get()->toTree();
            
            $view->with(compact('areas'));
        });
        
        View::composer(['listings.partials.forms.categories'], function ($view) {
            $categories = Category::get()->toTree();
            
            $view->with(compact('categories'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AreaComposer::class);
    }
}
