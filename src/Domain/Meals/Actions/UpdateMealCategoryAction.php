<?php


namespace Resto2web\Menu\Domain\Meals\Actions;


use Resto2web\Menu\Admin\Meals\DataTransferObjects\MealCategoryData;
use Resto2web\Menu\Domain\Meals\Models\MealCategory;

class UpdateMealCategoryAction
{
    public static function execute(MealCategoryData $data, MealCategory $mealCategory)
    {
        $mealCategory->update($data->toArray());
    }
}
