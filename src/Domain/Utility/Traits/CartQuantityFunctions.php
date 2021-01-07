<?php


namespace Resto2web\Menu\Domain\Utility\Traits;


use Gloudemans\Shoppingcart\Facades\Cart;

trait CartQuantityFunctions
{

    public function addOne()
    {
        $cartItem = Cart::get($this->rowId);
//        if ($cartItem->associatedModel == Gift::class && $cartItem->model->type == 'free_delivery') {
//            return;
//        }
        Cart::update($this->rowId, $cartItem->qty + 1);
        $this->emit('updatedCart');
    }

    public function removeOne()
    {
        if ($this->rowId) {
            $cartItem = Cart::get($this->rowId);
            Cart::update($this->rowId, $cartItem->qty - 1);
            if ($cartItem->qty == 0) {
                $this->rowId = null;
            }
            $this->emit('updatedCart');
        }
    }

    public function removeFromCart()
    {
        Cart::update($this->rowId, 0);
        $this->rowId = null;
        $this->emit('updatedCart');
    }
}

