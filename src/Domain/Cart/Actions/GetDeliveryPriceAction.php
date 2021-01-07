<?php


namespace Resto2web\Menu\Domain\Cart\Actions;


use Gloudemans\Shoppingcart\Facades\Cart;
use Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper;
use Resto2web\Menu\Settings\MenuSettings;

class GetDeliveryPriceAction
{
    public static function execute()
    {
        if (CartOrderHelper::hasFreeDelivery() || CartOrderHelper::isTakeaway()) {
            return 0;
        } else {
            $settings = app(MenuSettings::class);
            return $settings->deliveryPrice;
        }
    }
}
