<?php


namespace Resto2web\Menu\Domain\Orders\States\OrderStatus;


class Canceled extends OrderStatus
{
    public static string $name = 'canceled';
    public function color(): string
    {
        return 'red';
    }

    public function displayName(): string
    {
        return 'annulée';
    }
}
