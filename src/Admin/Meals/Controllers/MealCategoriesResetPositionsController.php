<?php

namespace Resto2web\Menu\Admin\Meals\Controllers;

use Domain\Meals\Actions\ResetMealCategoryMealsOrder;
use Domain\Meals\Models\MealCategory;
use App\Common\Controllers\Controller;

class MealCategoriesResetPositionsController extends Controller
{
    public function __invoke(MealCategory $mealCategory)
    {
        ResetMealCategoryMealsOrder::execute($mealCategory);
        toastSuccess('Numérotation rafraîchie');
        return redirect()->back();
    }
}
