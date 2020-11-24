<?php

use Resto2web\Menu\Admin\Meals\Controllers\MealCategoriesController;
use Resto2web\Menu\Admin\Meals\Controllers\MealsController;

use Resto2web\Menu\Website\Controllers\MenuPageController;

Route::get('/menu', MenuPageController::class)->name('menu');


Route::group(['as'=> 'admin.','prefix' => 'admin','middleware'=> 'web'],function(){
    Route::middleware('admin')->group(function (){
        Route::resource('meal-categories', MealCategoriesController::class);
        Route::resource('meals', MealsController::class);
    });
});

