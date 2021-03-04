<?php


namespace Resto2web\Menu\Admin\Orders\Components;


use Livewire\Component;
use Resto2web\Menu\Domain\Orders\Models\Order;
use Resto2web\Menu\Settings\MenuSettings;

class EditOrderDeliveryInfosComponent extends Component
{
    public Order $order;
    public bool $edit = false;
    public bool $hasFreeDeliveryMinimum;
    public string $type;


    public function mount()
    {
        $settings = app(MenuSettings::class);
        $this->hasFreeDeliveryMinimum = $settings->hasFreeDeliveryMinimum;
        $this->loadFromOrder();

//        $this->loadFromOrder();
    }

    public function render()
    {
        return view('resto2web-admin::pages.orders.components.edit-order-delivery-infos-component');
    }

    public function save()
    {


        $this->edit = false;
    }

    public function toggleEdit()
    {
        $this->loadFromOrder();
        return $this->edit = !$this->edit;
    }

    public function loadFromOrder()
    {
        $this->type = $this->order->type;
    }
}
