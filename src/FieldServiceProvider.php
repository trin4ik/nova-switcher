<?php

namespace Trin4ik\NovaSwitcher;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Route;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-switcher', __DIR__.'/../dist/js/field.js');
            //Nova::style('nova-switcher', __DIR__.'/../dist/css/field.css');
        });

        $this->app->booted(function () {
            $this->routes();
        });
    }

    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware('nova')
            ->post('nova-vendor/nova-switcher/toggle/{resource}', SwitchController::class);
    }
}
