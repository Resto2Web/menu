<?php

use Illuminate\Support\Facades\Route;
use Resto2web\Menu\Admin\Meals\Controllers\MealCategoriesController;
use Resto2web\Menu\Admin\Meals\Controllers\MenuSettingsController;
use Resto2web\Menu\Admin\Meals\Controllers\MealCategoriesPositionController;
use Resto2web\Menu\Admin\Meals\Controllers\MealsController;
use Resto2web\Menu\Admin\Meals\Controllers\MealsPositionController;
use Resto2web\Menu\Admin\Orders\Controllers\OrdersController;
use Resto2web\Menu\Domain\Meals\Models\Meal;
use Resto2web\Menu\Domain\Orders\Actions\ConfirmOrderAction;
use Resto2web\Menu\Domain\Orders\Actions\RefuseOrderAction;
use Resto2web\Menu\Domain\Orders\Actions\ShipOrderAction;
use Resto2web\Menu\Domain\Orders\Models\Order;
use Resto2web\Menu\Website\Controllers\CheckoutPageController;
use Resto2web\Menu\Website\Controllers\CheckoutThanksPageController;
use Resto2web\Menu\Website\Controllers\MenuPageController;

Route::middleware(['api', 'auth:sanctum'])->group(function () {
    Route::get('api/meals', function () {
        $meals = Meal::all();
        return $meals;
    });
    Route::get('api/meals/{meal}', function (Meal $meal) {
        return $meal;
    });

    Route::get('api/orders', function () {
        return Order::all();
    });

    Route::get('api/orders/{order}', function (Order $order) {
        $order->order_items;
        return $order;
    });

    Route::patch('api/orders/{order}/confirmed', function (Order $order) {
        ConfirmOrderAction::execute($order);
        $order->order_items;
        return $order->refresh();
    });

    Route::patch('api/orders/{order}/refused', function (Order $order) {
        RefuseOrderAction::execute($order);
        $order->order_items;
        return $order->refresh();
    });

    Route::patch('api/orders/{order}/shipped', function (Order $order) {
        ShipOrderAction::execute($order);
        $order->order_items;
        return $order->refresh();
    });

});
