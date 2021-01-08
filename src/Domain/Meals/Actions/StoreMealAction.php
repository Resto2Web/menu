<?php


namespace Resto2web\Menu\Domain\Meals\Actions;

use Resto2web\Menu\Domain\Meals\DataTransferObjects\MealData;
use Resto2web\Menu\Domain\Meals\Models\Meal;
use Resto2web\Menu\Domain\Meals\Models\MealCategory;

class StoreMealAction
{

    public static function execute(MealData $data): Meal
    {
        if ($data->meal_category_id != null) {
            $mealCategory = MealCategory::findOrFail($data->meal_category_id);
            $data->position = $mealCategory->meals()->count() + 1;
        }
        return Meal::create($data->toArray());
    }
}
