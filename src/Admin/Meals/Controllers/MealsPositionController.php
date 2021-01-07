<?php

namespace Resto2web\Menu\Admin\Meals\Controllers;

use Illuminate\Http\Request;
use Resto2web\Core\Common\Controllers\Controller;
use Resto2web\Menu\Domain\Meals\Actions\UpdateMealPositionAction;
use Resto2web\Menu\Domain\Meals\Models\Meal;

class MealsPositionController extends Controller
{
    public function __invoke(Request $request, Meal $meal)
    {
        UpdateMealPositionAction::execute($meal,$request->input('new_pos'));
        return json_encode(['status' => 'ok']);
    }
}
