<?php


namespace Resto2web\Menu\Domain\Orders\Actions;


use Resto2web\Menu\Domain\Orders\States\OrderStatus\Refused;

class RefuseOrderAction
{

    public static function execute(\Resto2web\Menu\Domain\Orders\Models\Order $order)
    {
        $order->status->transitionTo(Refused::class);
    }
}
