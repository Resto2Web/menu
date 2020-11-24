<?php


namespace Resto2web\Menu\Domain\Menu\Actions;


use Exception;
use Resto2web\Menu\Domain\Menu\Models\Meal;

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
