<?php


namespace Resto2web\Menu\Admin\Orders\Components;


use Livewire\Component;
use Resto2web\Menu\Domain\Orders\Models\Order;

class EditOrderCustomerInfosComponent extends Component
{
    public Order $order;
    public string $email;
    public string $phone_number;
    public string $first_name;
    public string $last_name;
    public bool $edit = false;

    public function mount()
    {
        $this->loadFromOrder();
    }

    public function render()
    {
        return view('resto2web-admin::pages.orders.components.edit-order-customer-infos-component');
    }

    public function save()
    {
        $this->order->update([
           'first_name' => $this->first_name,
           'last_name' => $this->last_name,
           'email' => $this->email,
           'phone_number' => $this->phone_number,
        ]);
        $this->edit = false;
    }

    public function toggleEdit()
    {
        $this->loadFromOrder();
        return $this->edit = !$this->edit;
    }

    public function loadFromOrder()
    {
        $this->email = $this->order->email ?? '';
        $this->phone_number = $this->order->phone_number ?? '';
        $this->first_name = $this->order->first_name ?? '';
        $this->last_name = $this->order->last_name ?? '';
    }
}
