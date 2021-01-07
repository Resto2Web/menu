<?php


namespace Resto2web\Menu\Website\Components\Menu;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Resto2web\Menu\Domain\Meals\Models\Meal;
use Resto2web\Menu\Domain\Meals\Models\MealOption;
use Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper;

class MenuMealOptionsModal extends Component
{
    public Meal $meal;
    public float $total;
    public array $selectedOptions = [];

    public bool $displayWarning = false;

    public function mount()
    {
        $this->total = $this->meal->price;
        foreach ($this->meal->optionsGroups as $optionsGroup) {
            if ($optionsGroup->required && $optionsGroup->mealOptions()->count()) {
                $this->selectedOptions[$optionsGroup->id] = $optionsGroup->mealOptions->first()->id;
            }
        }
    }

    public function render()
    {
        return view('resto2web::pages.menu.components.meal-options-modal-component');
    }

    public function addToCart()
    {
        CartOrderHelper::addToCart($this->meal,1,$this->selectedOptions,$this->total);
        $this->emit('updatedCart');
        $this->emit('closeModal');
    }

    public function updated()
    {
        $this->refreshTotal();
//        dd($this->selectedOptions);
    }


    private function refreshTotal()
    {
        $total = $this->meal->price;
        foreach ($this->selectedOptions as $key => $selectedOption) {
            if (is_array($selectedOption)) {
                foreach ($selectedOption as $optionId => $value) {
                    if ($value) {
                        $option = MealOption::findOrFail($optionId);
                        $total += $option->price;
                    }
                }
            }else{
                if ($selectedOption) {
                    $option = MealOption::findOrFail($selectedOption);
                    $total += $option->price;
                }
            }
        }
        $this->total = $total;
    }
}
