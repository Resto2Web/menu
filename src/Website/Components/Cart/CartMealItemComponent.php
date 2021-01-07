<?php


namespace Resto2web\Menu\Website\Components\Cart;


use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Resto2web\Menu\Domain\Utility\Traits\CartQuantityFunctions;

class CartMealItemComponent extends Component
{
    use CartQuantityFunctions;
    public ?string $rowId;

    protected $listeners = [
        'updatedCart' => 'render'
    ];

    public function mount(CartItem $content)
    {
        $this->rowId = $content->rowId;
    }


    public function render()
    {
        if ($this->rowId) {
            if (Cart::content()->has($this->rowId)) {
                $cartItem = Cart::get($this->rowId);
            }else{
                $cartItem = null;
            }
        }else{
            $cartItem = null;
        }
        return view('resto2web::pages.menu.components.cart.meal-item-component')->with([
            'cartItem' => $cartItem
        ]);
    }


}
