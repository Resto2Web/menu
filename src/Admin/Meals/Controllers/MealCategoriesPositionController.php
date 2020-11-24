<?php

namespace Resto2web\Menu\Admin\Meals\Controllers;

use Domain\Meals\Actions\UpdateMealCategoryPositionAction;
use Domain\Meals\Models\MealCategory;
use Resto2web\Core\Common\Controllers\Controller;
use Illuminate\Http\Request;

class MealCategoriesPositionController extends Controller
{
    public function __invoke(Request $request, MealCategory $mealCategory)
    {
        UpdateMealCategoryPositionAction::execute($mealCategory,$request->input('new_pos'));
        return json_encode(['status' => 'ok','message' => 'Changement de position effectué']);
    }
}
