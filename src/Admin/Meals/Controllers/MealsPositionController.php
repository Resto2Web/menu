<?php

namespace Resto2web\Menu\Admin\Meals\Controllers;

use Domain\Meals\Actions\UpdateMealPositionAction;
use Domain\Meals\Models\Meal;
use App\Common\Controllers\Controller;
use Illuminate\Http\Request;

class MealsPositionController extends Controller
{
    public function __invoke(Request $request, Meal $meal)
    {
        UpdateMealPositionAction::execute($meal,$request->input('new_pos'));
        return json_encode(['status' => 'ok']);
    }
}
