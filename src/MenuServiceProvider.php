<?php

namespace Resto2web\Menu;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Resto2web\Menu\Admin\Meals\Components\MealOptionsComponent;
use Resto2web\Menu\Admin\Orders\Components\CreateOrderMenuMealItemComponent;
use Resto2web\Menu\Admin\Orders\Components\CreateOrderSidebarComponent;
use Resto2web\Menu\Admin\Orders\Components\EditOrderCustomerInfosComponent;
use Resto2web\Menu\Admin\Orders\Components\EditOrderDeliveryInfosComponent;
use Resto2web\Menu\Admin\Orders\Components\OrderStatusChangerComponent;
use Resto2web\Menu\Website\Components\Cart\CartMealItemComponent;
use Resto2web\Menu\Website\Components\CartSidebarComponent;
use Resto2web\Menu\Website\Components\Checkout\CheckoutComponent;
use Resto2web\Menu\Website\Components\Menu\MenuMealItemComponent;
use Resto2web\Menu\Website\Components\Menu\MenuMealOptionsModal;
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
         $this->loadRoutesFrom(__DIR__.'/../routes/api.php');


        Livewire::component('website.components.cart-sidebar', CartSidebarComponent::class);
        Livewire::component('website.components.cart.meal-item', CartMealItemComponent::class);
        Livewire::component('website.components.menu.meal-item', MenuMealItemComponent::class);
        Livewire::component('website.components.menu.meal-options-modal', MenuMealOptionsModal::class);
        Livewire::component('website.components.checkout', CheckoutComponent::class);

        Livewire::component('admin.meals.components.meal-options', MealOptionsComponent::class);
        Livewire::component('admin.orders.components.order-status-changer', OrderStatusChangerComponent::class);
        Livewire::component('admin.orders.components.create-order-sidebar', CreateOrderSidebarComponent::class);
        Livewire::component('admin.orders.components.create-order-menu-meal-item', CreateOrderMenuMealItemComponent::class);
        Livewire::component('admin.orders.components.edit-order-customer-info', EditOrderCustomerInfosComponent::class);
        Livewire::component('admin.orders.components.edit-order-delivery-info', EditOrderDeliveryInfosComponent::class);

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
