<?php


namespace Resto2web\Menu\Domain\Meals\Actions;



use Resto2web\Menu\Domain\Meals\Models\Meal;

class ToggleMealActiveStateAction
{
    public static function execute(Meal $meal)
    {
        $meal->update(['active'=>!$meal->active]);
    }
}
