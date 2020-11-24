<?php


namespace Resto2web\Menu\Domain\Menu\Actions;


use App\Domain\Meals\Models\Meal;

class ToggleMealAvailableStateAction
{
    public static function execute(Meal $meal)
    {
        $meal->update(['available'=>!$meal->available]);
    }
}
