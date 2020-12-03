<?php


namespace Resto2web\Menu\Domain\Menu\Actions;

use Resto2web\Menu\Domain\Menu\Models\MealCategory;

class RefreshMealCategoriesPositionAction
{
    public static function execute()
    {
        $i = 1;
        $mealCategories = MealCategory::all();
        foreach ($mealCategories as $mealCategory) {
            $mealCategory->update([
                'position' => $i
            ]);
            $i++;
        }
    }
}
