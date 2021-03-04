<?php


namespace Resto2web\Menu\Admin\Orders\Components;


use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Resto2web\Core\Domain\Users\DataTransferObjects\AddressData;
use Resto2web\Core\Settings\GeneralSettings;
use Resto2web\Menu\Admin\Orders\Action\StoreNewOrderAction;
use Resto2web\Menu\Domain\Cart\Actions\GetCartTotalWithDeliveryAction;
use Resto2web\Menu\Domain\Meals\Models\Meal;
use Resto2web\Menu\Domain\Orders\Actions\GenerateFormattedOptionsArrayAction;
use Resto2web\Menu\Domain\Orders\Actions\GenerateUniqueOrderNumberAction;
use Resto2web\Menu\Domain\Orders\Actions\StoreUserAddressAction;
use Resto2web\Menu\Domain\Orders\DataTransferObjects\OrderData;
use Resto2web\Menu\Domain\Orders\DataTransferObjects\OrderItemData;
use Resto2web\Menu\Domain\Orders\Models\Order;
use Resto2web\Menu\Domain\Orders\Models\OrderItem;
use Resto2web\Menu\Domain\Orders\Notifications\AdminNewOrderNotification;
use Resto2web\Menu\Domain\Orders\Notifications\UserNewOrderNotification;
use Resto2web\Menu\Domain\Orders\States\OrderStatus\Confirmed;
use Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper;
use Resto2web\Menu\Settings\MenuSettings;

class CreateOrderSidebarComponent extends Component
{
    protected $listeners = ['updatedCart'];

    public float $minimumOrder;
    public bool $onlyDelivery;
    public bool $onlyTakeaway;
    public float $deliveryPrice;
    public bool $hasFreeDeliveryMinimum;
    public float $freeDeliveryMinimum;
    public string $first_name;
    public string $last_name;
    public string $phone_number;
    public string $date;
    public string $time;

    public string $type;
    public string $city;
    public string $address;
    public string $postal_code;
    public bool $checkout = false;


    public function mount()
    {
        $settings = app(MenuSettings::class);
        $this->minimumOrder = $settings->minimumOrder;
        $this->onlyDelivery = $settings->onlyDelivery();
        $this->onlyTakeaway = $settings->onlyTakeaway();
        $this->deliveryPrice = $settings->deliveryPrice;
        $this->hasFreeDeliveryMinimum = $settings->hasFreeDeliveryMinimum;
        $this->freeDeliveryMinimum = $settings->freeDeliveryMinimum;
        $this->first_name = CartOrderHelper::get('first_name', '');
        $this->last_name = CartOrderHelper::get('last_name', '');
        $this->city = CartOrderHelper::get('address.city', '');
        $this->postal_code = CartOrderHelper::get('address.postal_code', '');
        $this->address = CartOrderHelper::get('address.address', '');
        $this->phone_number = CartOrderHelper::get('phone_number', '');
        $this->type = CartOrderHelper::getType();
    }

    public function render()
    {
        return view('resto2web-admin::pages.orders.components.create-order-sidebar-component');
    }

    public function updatedCart()
    {
        $this->render();
    }

    public function getCanCheckoutProperty()
    {
        return (bool) CartOrderHelper::canCheckout() ;
    }

    public function getTotalWithDeliveryProperty()
    {
        return GetCartTotalWithDeliveryAction::execute();
    }

    public function updatedType()
    {
        CartOrderHelper::setType($this->type);
        $this->emit('changedOrderType');
    }

    public function checkout()
    {
        $contactData = $this->validate([
            'phone_number' => 'nullable',
            'first_name' => 'nullable',
            'last_name' => 'nullable',
        ]);
        CartOrderHelper::set('contact', $contactData);

        if (CartOrderHelper::isDelivery()) {
            $addressData = $this->validate([
                'city' => 'required',
                'address' => 'required',
                'postal_code' => 'required'
            ]);
            $addressData = new AddressData($addressData);
            CartOrderHelper::set('address', $addressData->toArray());
        }
        //TODO
        $this->date = '8/1/2021';
        $this->time = '11:20';
        CartOrderHelper::set('date', $this->date);
        CartOrderHelper::set('time', $this->time);

        $orderNumber = GenerateUniqueOrderNumberAction::execute();
        $orderData = new OrderData([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'type' => CartOrderHelper::getType(),
            'delivery' => CartOrderHelper::getDeliveryPrice(),
            'total' => CartOrderHelper::getTotal(),
            'number' => $orderNumber,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
            'city' => $this->city,
            'date' => Carbon::createFromFormat('d/m/Y', CartOrderHelper::get('date')),
            'time' => Carbon::createFromFormat('H:i', CartOrderHelper::get('time')),
        ]);

        $order = StoreNewOrderAction::execute($orderData);
        $order->update([
            'status' => Confirmed::class
        ]);
        if ($order->email) {
            Notification::route('mail',$order->email)
                ->notify(new UserNewOrderNotification($order));
        }
        CartOrderHelper::clearEverything();
        $this->redirect(route('admin.orders.show',$order->id));
    }

}
