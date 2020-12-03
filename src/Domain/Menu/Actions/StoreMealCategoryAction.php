<?php


namespace Resto2web\Menu\Domain\Menu\Actions;


use Resto2web\Menu\Admin\Meals\DataTransferObjects\MealCategoryData;
use Resto2web\Menu\Domain\Menu\Models\MealCategory;


class StoreMealCategoryAction
{
    public static function execute(MealCategoryData $data)
    {
        $data->position = MealCategory::count() + 1;
        return MealCategory::create($data->toArray());
    }
}
