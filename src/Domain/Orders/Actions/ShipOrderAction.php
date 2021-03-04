<?php


namespace Resto2web\Menu\Domain\Orders\Actions;


use Illuminate\Support\Facades\Notification;
use Resto2web\Menu\Domain\Orders\Models\Order;
use Resto2web\Menu\Domain\Orders\Notifications\UserOrderShippedNotification;
use Resto2web\Menu\Domain\Orders\States\OrderStatus\Shipped;

class ShipOrderAction
{

    public static function execute(Order $order)
    {
        $order->status->transitionTo(Shipped::class);
        Notification::route('mail',$order->email)
            ->notify(new UserOrderShippedNotification($order));
    }
}
