<?php


namespace Resto2web\Menu\Domain\Menu\Actions;



use Resto2web\Menu\Domain\Menu\Models\Meal;

class ToggleMealActiveStateAction
{
    public static function execute(Meal $meal)
    {
        $meal->update(['active'=>!$meal->active]);
    }
}
