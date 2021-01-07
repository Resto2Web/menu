<?php

namespace Resto2web\Menu\Admin\Meals\Controllers;

use Resto2web\Core\Common\Controllers\Controller;
use Illuminate\Http\Request;
use Resto2web\Menu\Domain\Meals\Actions\UpdateMealCategoryPositionAction;
use Resto2web\Menu\Domain\Meals\Models\MealCategory;

class MealCategoriesPositionController extends Controller
{
    public function __invoke(Request $request, MealCategory $mealCategory)
    {
        UpdateMealCategoryPositionAction::execute($mealCategory,$request->input('new_pos'));
        return json_encode(['status' => 'ok','message' => 'Changement de position effectué']);
    }
}
