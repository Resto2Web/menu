<?php


namespace Resto2web\Menu\Domain\Orders\Actions;


use Illuminate\Support\Facades\Notification;
use Resto2web\Menu\Domain\Orders\Notifications\UserOrderConfirmedNotification;
use Resto2web\Menu\Domain\Orders\States\OrderStatus\Confirmed;

class ConfirmOrderAction
{

    public static function execute(\Resto2web\Menu\Domain\Orders\Models\Order $order)
    {
        $order->status->transitionTo(Confirmed::class);
        Notification::route('mail',$order->email)
            ->notify(new UserOrderConfirmedNotification($order));
    }
}
