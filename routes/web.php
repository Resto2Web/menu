<?php

use Illuminate\Support\Facades\Route;
use Resto2web\Menu\Admin\Meals\Controllers\MealCategoriesController;
use Resto2web\Menu\Admin\Meals\Controllers\MenuSettingsController;
use Resto2web\Menu\Admin\Meals\Controllers\MealCategoriesPositionController;
use Resto2web\Menu\Admin\Meals\Controllers\MealsController;
use Resto2web\Menu\Admin\Meals\Controllers\MealsPositionController;
use Resto2web\Menu\Website\Controllers\CheckoutPageController;
use Resto2web\Menu\Website\Controllers\MenuPageController;

Route::middleware('web')->group(function () {

    Route::get('/menu', MenuPageController::class)->name('menu');
    Route::get('/commander', [CheckoutPageController::class,'index'])->name('checkout.index');
    Route::post('/commander', [CheckoutPageController::class,'store'])->name('checkout.store');

    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'web'], function () {
        Route::middleware(['admin','admin-seo'])->group(function () {
            Route::patch('meal-categories/position/{mealCategory}', MealCategoriesPositionController::class);
            Route::resource('meal-categories', MealCategoriesController::class);
            Route::patch('meals/position/{meal}', MealsPositionController::class);
            Route::resource('meals', MealsController::class);
            Route::get('/settings/menu', [MenuSettingsController::class,'show'])->name('settings.menu');
            Route::patch('/settings/menu', [MenuSettingsController::class,'update'])->name('settings.menu');

        });
    });
});
