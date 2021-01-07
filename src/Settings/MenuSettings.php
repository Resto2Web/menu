<?php

namespace Resto2web\Menu\Settings;


use Spatie\LaravelSettings\Settings;

class MenuSettings extends Settings
{
    public bool $takeaway;
    public bool $delivery;

    public float $minimumOrder;
    public bool $hasFreeDeliveryMinimum;
    public float $freeDeliveryMinimum;
    public float $deliveryPrice;

    public static function group(): string
    {
        return 'menu';
    }

    public function onlyDelivery()
    {
        return $this->delivery && !$this->takeaway;
    }

    public function onlyTakeaway()
    {
        return !$this->delivery && $this->takeaway;
    }
}
