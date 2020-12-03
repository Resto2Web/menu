<?php

use Illuminate\Support\Facades\Route;
use Resto2web\Menu\Admin\Meals\Controllers\MealCategoriesController;
use Resto2web\Menu\Admin\Meals\Controllers\MealCategoriesPositionController;
use Resto2web\Menu\Admin\Meals\Controllers\MealsController;
use Resto2web\Menu\Admin\Meals\Controllers\MealsPositionController;
use Resto2web\Menu\Website\Controllers\CheckoutStep1PageController;
use Resto2web\Menu\Website\Controllers\MenuPageController;

Route::middleware('web')->group(function () {

    Route::get('/menu', MenuPageController::class)->name('menu');
    Route::get('/commander', [CheckoutStep1PageController::class,'index'])->name('checkout.step1.index');
    Route::post('/commander', [CheckoutStep1PageController::class,'store'])->name('checkout.step1.store');

    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'web'], function () {
        Route::middleware('admin')->group(function () {
            Route::patch('meal-categories/position/{mealCategory}', MealCategoriesPositionController::class);
            Route::resource('meal-categories', MealCategoriesController::class);
            Route::patch('meals/position/{meal}', MealsPositionController::class);
            Route::resource('meals', MealsController::class);
        });
    });
});
