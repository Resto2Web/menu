<?php


namespace Resto2web\Menu\Domain\Cart\Actions;


use Gloudemans\Shoppingcart\Facades\Cart;

class GetCartTotalWithDeliveryAction
{
    public static function execute()
    {
//        if (session('deliveryoptions.' . $restaurant->slug) == 'takeaway') {
            return Cart::subtotal();
//        } else {
//            return Cart::subtotal() + delivery($restaurant);
//        }
    }
}
