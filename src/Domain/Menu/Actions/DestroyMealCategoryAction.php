<?php


namespace Resto2web\Menu\Domain\Menu\Actions;


use App\Domain\Meals\Models\MealCategory;
use Exception;

class DestroyMealCategoryAction
{
    public static function execute(MealCategory $mealCategory)
    {
        try {
            foreach ($mealCategory->meals as $meal) {
                $meal->update([
                    'meal_category_id' => null
                ]);

            }
            $mealCategory->delete();
            RefreshMealCategoriesPositionAction::execute($mealCategory->restaurant);
        } catch (Exception $e) {
            return false;
        }
        return false;


    }
}
