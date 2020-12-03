<?php


namespace Resto2web\Menu\Domain\Menu\Actions;


use Resto2web\Menu\Domain\Menu\Models\MealCategory;

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
