<?php


namespace Resto2web\Menu\Website\Components;


use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Resto2web\Menu\Domain\Cart\Actions\GetCartTotalWithDeliveryAction;
use Resto2web\Menu\Domain\Menu\Models\Meal;

class MealItem extends Component
{
    public Meal $meal;

    public function render()
    {
        return view('resto2web::pages.menu.components.meal-item-component');
    }

    public function addToCart()
    {
        Cart::add($this->meal, 1);
        $this->emit('updatedCart');
    }

}
