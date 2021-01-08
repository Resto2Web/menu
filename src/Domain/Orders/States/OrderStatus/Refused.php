<?php


namespace Resto2web\Menu\Domain\Orders\States\OrderStatus;


class Refused extends OrderStatus
{
    public static string $name = 'refused';

    public function color(): string
    {
        return 'red';
    }

    public function displayName(): string
    {
        return 'refusée';
    }
}
