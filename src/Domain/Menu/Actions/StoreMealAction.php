<?php


namespace Resto2web\Menu\Domain\Menu\Actions;

use Resto2web\Menu\Admin\Meals\DataTransferObjects\MealData;
use Resto2web\Menu\Domain\Menu\Models\Meal;
use Resto2web\Menu\Domain\Menu\Models\MealCategory;
use Str;

class StoreMealAction
{

    public static function execute(MealData $data)
    {
        if ($data->meal_category_id != null) {
            $mealCategory = MealCategory::findOrFail($data->meal_category_id);
            $data->position = $mealCategory->meals->max('position') + 1;
        }
        return Meal::create($data->toArray());
    }
}
