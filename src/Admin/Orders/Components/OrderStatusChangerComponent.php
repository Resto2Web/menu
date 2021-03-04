<?php


namespace Resto2web\Menu\Admin\Orders\Components;


use Livewire\Component;
use Resto2web\Menu\Domain\Orders\Actions\CancelOrderAction;
use Resto2web\Menu\Domain\Orders\Actions\ConfirmOrderAction;
use Resto2web\Menu\Domain\Orders\Actions\RefuseOrderAction;
use Resto2web\Menu\Domain\Orders\Actions\ShipOrderAction;
use Resto2web\Menu\Domain\Orders\Models\Order;

class OrderStatusChangerComponent extends Component
{
    public Order $order;

    public function render()
    {
        return view('resto2web-admin::pages.orders.components.status-changer-component');
    }

    public function sendOrder()
    {
        ShipOrderAction::execute($this->order);
    }

    public function confirmOrder()
    {
        ConfirmOrderAction::execute($this->order);
    }

    public function refuseOrder()
    {
        RefuseOrderAction::execute($this->order);
    }

    public function cancelOrder()
    {
        CancelOrderAction::execute($this->order);
    }
}
