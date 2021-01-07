<?php


namespace Resto2web\Menu\Website\Components\Menu;


use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Resto2web\Menu\Domain\Cart\Actions\GetCartTotalWithDeliveryAction;
use Resto2web\Menu\Domain\Meals\Models\Meal;
use Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper;

class MenuMealItem extends Component
{
    public Meal $meal;

    public function render()
    {
        return view('resto2web::pages.menu.components.meal-item-component');
    }

    public function addToCart()
    {
        CartOrderHelper::addToCart($this->meal);
        $this->emit('updatedCart');
    }

}
