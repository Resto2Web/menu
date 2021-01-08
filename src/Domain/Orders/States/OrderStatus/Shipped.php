<?php


namespace Resto2web\Menu\Domain\Orders\States\OrderStatus;


class Shipped extends OrderStatus
{
    public static string $name = 'shipped';

    public function color(): string
    {
        return 'yellow';
    }

    public function displayName(): string
    {
        return 'envoyée';
    }
}
