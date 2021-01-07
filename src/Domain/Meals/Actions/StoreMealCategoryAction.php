<?php


namespace Resto2web\Menu\Domain\Meals\Actions;


use Resto2web\Menu\Admin\Meals\DataTransferObjects\MealCategoryData;
use Resto2web\Menu\Domain\Meals\Models\MealCategory;


class StoreMealCategoryAction
{
    public static function execute(MealCategoryData $data)
    {
        $data->position = MealCategory::count() + 1;
        return MealCategory::create($data->toArray());
    }
}
