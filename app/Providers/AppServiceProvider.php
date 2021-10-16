<?php

namespace App\Providers;

use App\Http\Resources\AreaCollection;
use App\Http\Resources\AreaResource;

use App\Models\Album;
use App\Models\Letter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        Route::macro('resourceAdmin', function ($uri, $controller) {
            Route::post("{$uri}/sort", "{$controller}@sort")->name("{$uri}.sort");
            Route::get("{$uri}/{id}/change-status", "{$controller}@changeStatus")->name("{$uri}.status");
            Route::resource($uri, $controller);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('front/*', function ($view) {
            $view->with('user', auth()->user());
            $view->with('letters',
                Cache::remember('letters', 60 * 60, function () {
                    return Letter::type()->sort()->get();
                })
            );

            $view->with('albums',
                Cache::remember('albums', 60 * 60, function () {
                    return Album::type('ready_attachment')->sort()->get();
                })
            );

            $view->with('invitations',
                Cache::remember('invitations', 60 * 60, function () {
                    return Letter::type('invitations')->sort()->get();
                })
            );
            $view->with('thanks',
                Cache::remember('thanks', 60 * 60, function () {
                    return Letter::type('thanks')->sort()->get();
                })
            );

        });

    }
}
