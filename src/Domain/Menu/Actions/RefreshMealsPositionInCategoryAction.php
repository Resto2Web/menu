<?php


namespace Resto2web\Menu\Domain\Menu\Actions;


use App\Domain\Meals\Models\MealCategory;

class RefreshMealsPositionInCategoryAction
{
    public static function execute(MealCategory $mealCategory)
    {
        $i = 1;
        foreach ($mealCategory->meals->sortBy('position') as $meal) {
            $meal->update(['position' => $i]);
            $i += 1;
        }
    }
}
