<?php


namespace Resto2web\Menu\Settings;


use Spatie\LaravelSettings\Settings;

class PaymentsSettings extends Settings
{
    public bool $cashOnDelivery;
    public bool $cardOnDelivery;
    public bool $acceptsBancontact;
    public bool $acceptsVisa;
    public bool $online;

    public static function group(): string
    {
        return 'payments';
    }
}
