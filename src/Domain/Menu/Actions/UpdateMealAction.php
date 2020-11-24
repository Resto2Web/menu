<?php


namespace Resto2web\Menu\Domain\Menu\Actions;


use Resto2web\Menu\Admin\Meals\DataTransferObjects\MealData;
use Resto2web\Menu\Domain\Menu\Models\Meal;

class UpdateMealAction
{
    public static function execute(MealData $data, Meal $meal)
    {
        //TODO Make this work as intended
        if ($data->meal_category_id == null) {
//            $data->position
//        }else{
            $data->position = 1;
        }
        $meal->update($data->toArray());
    }
}
