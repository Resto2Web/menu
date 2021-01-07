<?php


namespace Resto2web\Menu\Domain\Cart\Actions;


use Gloudemans\Shoppingcart\Facades\Cart;
use Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper;

class GetCartTotalWithDeliveryAction
{
    public static function execute()
    {
        return CartOrderHelper::getDeliveryPrice() + Cart::subtotal();
    }
}
