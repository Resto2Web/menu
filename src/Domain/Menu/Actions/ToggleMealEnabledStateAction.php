<?php


namespace Resto2web\Menu\Domain\Menu\Actions;


use App\Domain\Meals\Models\Meal;

class ToggleMealEnabledStateAction
{
    public static function execute(Meal $meal)
    {
        $meal->update(['enabled'=>!$meal->enabled]);
    }
}
