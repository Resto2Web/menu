<?php


namespace Resto2web\Menu\Domain\Menu\Actions;
use App\Domain\Restaurants\Models\Restaurant;

class RefreshMealCategoriesPositionAction
{
    public static function execute(Restaurant $restaurant)
    {
        $i = 1;
        foreach ($restaurant->meal_categories as $meal_category) {
            $meal_category->update([
                'position' => $i
            ]);
            $i++;
        }
    }
}
