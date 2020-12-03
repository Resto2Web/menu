<?php


namespace Resto2web\Menu\Domain\Menu\Actions;



use Exception;
use Resto2web\Menu\Domain\Menu\Models\MealCategory;

class DestroyMealCategoryAction
{
    public static function execute(MealCategory $mealCategory)
    {
        foreach ($mealCategory->meals as $meal) {
            $meal->update([
                'meal_category_id' => null
            ]);
        }
        $mealCategory->delete();
        RefreshMealCategoriesPositionAction::execute();
    }
}
