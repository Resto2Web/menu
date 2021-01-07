<?php


namespace Resto2web\Menu\Domain\Meals\Actions;


use Exception;
use Resto2web\Menu\Domain\Meals\Models\Meal;

class DestroyMealAction
{
    public static function execute(Meal $meal)
    {
        try {
            $meal->delete();
            RefreshMealsPositionInCategoryAction::execute($meal->category);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
