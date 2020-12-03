<?php

namespace Resto2web\Menu;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Resto2web\Menu\Website\Components\CartSidebar;
use Resto2web\Menu\Website\Components\MealItem;
use Yoeunes\Notify\NotifyServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'menu');
         $this->loadViewsFrom(__DIR__.'/../resources/views/admin', 'resto2web-admin');
         $this->loadViewsFrom(__DIR__.'/../resources/views/website', 'resto2web');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
         $this->loadRoutesFrom(__DIR__.'/../routes/web.php');


        Livewire::component('website.components.cart-sidebar', CartSidebar::class);
        Livewire::component('website.components.meal-item', MealItem::class);
        require "helpers.php";

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('menu.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/menu'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/menu'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/menu'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'menu');

        // Register the main class to use with the facade
        $this->app->singleton('menu', function () {
            return new Menu;
        });

    }
}
