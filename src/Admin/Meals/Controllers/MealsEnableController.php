<?php

namespace Resto2web\Menu\Admin\Meals\Controllers;

use Domain\Meals\Actions\ToggleMealEnabledStateAction;
use Domain\Meals\Models\Meal;
use App\Common\Controllers\Controller;
use Illuminate\Http\Request;

class MealsEnableController extends Controller
{
    public function __invoke(Request $request, Meal $meal)
    {
        ToggleMealEnabledStateAction::execute($meal);
        return json_encode(['status' => 'ok', 'enabled' => $meal->enabled]);
    }
}
