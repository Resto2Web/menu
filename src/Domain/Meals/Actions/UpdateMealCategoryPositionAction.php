<?php


namespace Resto2web\Menu\Domain\Meals\Actions;

use Resto2web\Menu\Domain\Meals\Models\MealCategory;

class UpdateMealCategoryPositionAction
{
    public static function execute(MealCategory $mealCategory, $newPosition)
    {
        $meal_categories = MealCategory::all();
        $oldPosition = $mealCategory->position;
        if ($oldPosition < $newPosition) {
            foreach ($meal_categories->sortBy('position') as $line) {
                if ($oldPosition < $line->position && $line->position <= $newPosition) {
                    //LES AUTRES MONTENT
                    $line->update(['position'=>$line->position - 1]);
                }
            }
        } else {
            foreach ($meal_categories->sortBy('position') as $line) {
                if ($line->position < $oldPosition && $line->position >= $newPosition) {
                    //LES AUTRES DESCENDENT
                    $line->update(['position'=>$line->position + 1]);
                }
            }
        }

        $mealCategory->update(['position'=>$newPosition]);
    }
}
