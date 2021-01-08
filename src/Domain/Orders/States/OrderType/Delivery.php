<?php


namespace Resto2web\Menu\Domain\Orders\States\OrderType;


class Delivery extends OrderType
{

    public static string $name = 'delivery';
    public function color(): string
    {
        return 'teal';
        // TODO: Implement color() method.
    }

    public function displayName(): string
    {
        return 'A livrer';
    }
}
