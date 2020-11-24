<?php

namespace Resto2web\Menu\Admin\Meals\Controllers;

use Domain\Meals\Actions\ToggleMealAvailableStateAction;
use Domain\Meals\Models\Meal;
use App\Common\Controllers\Controller;
use Illuminate\Http\Request;

class MealsAvailabilityController extends Controller
{
    public function __invoke(Request $request, Meal $meal)
    {
        ToggleMealAvailableStateAction::execute($meal);
        return json_encode(['status' => 'ok','available'=> $meal->available]);
    }
}
