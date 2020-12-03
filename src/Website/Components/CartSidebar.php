<?php


namespace Resto2web\Menu\Website\Components;


use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Resto2web\Menu\Domain\Cart\Actions\GetCartTotalWithDeliveryAction;

class CartSidebar extends Component
{
    protected $listeners = ['updatedCart'];

    public function render()
    {
        return view('resto2web::pages.menu.components.cart-sidebar-component');
    }

    public function updatedCart()
    {
        $this->render();
    }

    public function getCanCheckoutProperty()
    {
        return (bool) Cart::count() ;
    }

    public function getTotalWithDeliveryProperty()
    {
        return GetCartTotalWithDeliveryAction::execute();
    }

}
