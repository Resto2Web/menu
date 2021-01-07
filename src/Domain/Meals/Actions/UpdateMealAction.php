<?php


namespace Resto2web\Menu\Domain\Meals\Actions;


use Resto2web\Menu\Admin\Meals\DataTransferObjects\MealData;
use Resto2web\Menu\Domain\Meals\Models\Meal;
use Resto2web\Menu\Domain\Meals\Models\MealCategory;

class UpdateMealAction
{
    public static function execute(MealData $data, Meal $meal)
    {
        if ($data->position != $meal->position) {
            if ($meal->category) {
                $oldCategory = $meal->category;
            }
            if ($data->meal_category_id == null) {
                $data->position = 1;
            }else{
                $mealCategory = MealCategory::findOrFail($data->meal_category_id);
                $data->position = $mealCategory->meals()->count() + 1;
            }
        }

        $meal->update($data->toArray());

        if (isset($oldCategory)) {
            RefreshMealsPositionInCategoryAction::execute($oldCategory);
        }
    }
}
