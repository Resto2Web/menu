<?php


namespace Resto2web\Menu\Domain\Orders\Actions;


use Gloudemans\Shoppingcart\CartItem;
use Resto2web\Menu\Domain\Meals\Models\MealOption;

class GenerateFormattedOptionsArrayAction
{
    public static function execute(CartItem $item): array
    {
        $formattedOptions = [];
        foreach ($item->options as $selectedOption) {
            if (is_array($selectedOption)) {
                foreach ($selectedOption as $optionId => $value) {
                    if ($value) {
                        $option = MealOption::findOrFail($optionId);
                        $formattedOptions[] = $option->name;
                    }
                }
            } else {
                $option = MealOption::findOrFail($selectedOption);
                $formattedOptions[] = $option->name;
            }
        }
        return $formattedOptions;

    }
}
