<?php


namespace Resto2web\Menu\Domain\Utility\Helpers;


use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Resto2web\Menu\Domain\Cart\Actions\GetDeliveryPriceAction;
use Resto2web\Menu\Domain\Meals\Models\Meal;
use Resto2web\Menu\Settings\MenuSettings;

class CartOrderHelper
{
    public MenuSettings $settings;

    const BASE_KEY = 'order';

    const DELIVERY = "delivery";
    const TAKEAWAY = "takeaway";

    protected static array $orderTypes = [1 => self::DELIVERY, 2 => self::TAKEAWAY];


    public static function isDelivery(): bool
    {
        if (self::getSettings()->onlyDelivery()) {
            return true;
        }
        if (self::getSettings()->onlyTakeaway()) {
            return false;
        }
        return self::getType() == self::DELIVERY;
    }

    public static function isTakeaway(): bool
    {
        if (self::getSettings()->onlyDelivery()) {
            return false;
        }
        if (self::getSettings()->onlyTakeaway()) {
            return true;
        }
        return self::getType() == self::TAKEAWAY;
    }

    public static function setType($type)
    {
        self::set('type', $type);
    }

    public static function getType() : string
    {
        $default = self::getDefaultOrderType();
        return self::get('type', $default);
    }


    public static function addToCart(Meal $meal, $qty = 1, $options = [], $price = null)
    {
        $row = Cart::add($meal, $qty, $options);
        if (!is_null($price)) {
            $row->price = $price;
        }
    }

    public static function canCheckout(): bool
    {
        if (Cart::subtotal() <= 0) {
            return false;
        }

        if (Cart::subtotal() < self::getSettings()->minimumOrder && Cart::subTotal() > 0) {
            return false;
        }
        return true;
    }
    public static function hasFreeDelivery(): bool
    {
        if (self::getSettings()->hasFreeDeliveryMinimum && self::getSettings()->freeDeliveryMinimum <= Cart::subtotal() || self::getSettings()->deliveryPrice == 0) {
            return true;
        }
        //TODO add freeDelivery Gift
        return false;
    }

    public static function getDeliveryPrice() : float
    {
        return GetDeliveryPriceAction::execute();
    }

    public static function clearEverything()
    {
        Cart::destroy();
        Session::put(self::BASE_KEY, null);
    }

    /**
     * @return string
     */
    public static function getDefaultOrderType(): string
    {
        $default = self::DELIVERY;
        if (self::getSettings()->onlyDelivery()) {
            $default = self::DELIVERY;
        }
        if (self::getSettings()->onlyTakeaway()) {
            $default = self::TAKEAWAY;
        }
        return $default;
    }

    public static function getSettings() : MenuSettings
    {
        return app(MenuSettings::class);
    }

    public static function get(string $key,$default = null)
    {
        return Session::get(self::prepareKey($key),$default);
    }

    public static function set(string $key,$value)
    {
        Session::put(self::prepareKey($key),$value);
    }

    public static function prepareKey(string $key): string
    {
        return self::BASE_KEY.'.'.$key;
    }

    public static function getTotal()
    {
        return Cart::subtotal() + self::getDeliveryPrice();
    }

}
