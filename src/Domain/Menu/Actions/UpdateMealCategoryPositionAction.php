<?php


namespace Resto2web\Menu\Domain\Menu\Actions;



use App\Domain\Meals\Models\MealCategory;

class UpdateMealCategoryPositionAction
{
    public static function execute(MealCategory $mealCategory, $newPosition)
    {
        $oldPosition = $mealCategory->position;
        if ($oldPosition < $newPosition) {
            //ON DESCEND UN LINE
            foreach ($mealCategory->restaurant->meal_categories->sortBy('position') as $line) {
                if ($oldPosition < $line->position && $line->position <= $newPosition) {
                    //LES AUTRES MONTENT
                    $line->update(['position'=>$line->position - 1]);
                }
            }
        } else {
            //ON MONTE UN LINE
            foreach ($mealCategory->restaurant->meal_categories->sortBy('position') as $line) {
                if ($line->position < $oldPosition && $line->position >= $newPosition) {
                    //LES AUTRES DESCENDENT
                    $line->update(['position'=>$line->position + 1]);
                }
            }
        }

        $mealCategory->update(['position'=>$newPosition]);
    }
}
