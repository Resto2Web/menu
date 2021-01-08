<?php


namespace Resto2web\Menu\Admin\Orders\Components;


use Livewire\Component;
use Resto2web\Menu\Domain\Orders\Models\Order;
use Resto2web\Menu\Domain\Orders\States\OrderStatus\Confirmed;
use Resto2web\Menu\Domain\Orders\States\OrderStatus\Refused;
use Resto2web\Menu\Domain\Orders\States\OrderStatus\Shipped;

class OrderStatusChangerComponent extends Component
{
    public Order $order;

    public function render()
    {
        return view('resto2web-admin::pages.orders.components.status-changer-component');
    }

    public function sendOrder()
    {
        $this->order->status->transitionTo(Shipped::class);
    }

    public function confirmOrder()
    {
        $this->order->status->transitionTo(Confirmed::class);
    }

    public function refuseOrder()
    {
        $this->order->status->transitionTo(Refused::class);
    }
}
