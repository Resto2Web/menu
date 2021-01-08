<?php


namespace Resto2web\Menu\Website\Components\Checkout;


use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Resto2web\Core\Settings\GeneralSettings;
use Resto2web\Menu\Domain\Meals\Models\Meal;
use Resto2web\Menu\Domain\Orders\Actions\GenerateFormattedOptionsArrayAction;
use Resto2web\Menu\Domain\Orders\Actions\GenerateUniqueOrderNumberAction;
use Resto2web\Menu\Domain\Orders\DataTransferObjects\OrderData;
use Resto2web\Menu\Domain\Orders\DataTransferObjects\OrderItemData;
use Resto2web\Menu\Domain\Orders\Models\Order;
use Resto2web\Menu\Domain\Orders\Models\OrderItem;
use Resto2web\Menu\Domain\Orders\Notifications\AdminNewOrderNotification;
use Resto2web\Menu\Domain\Orders\Notifications\UserNewOrderNotification;
use Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper;

class CheckoutComponent extends Component
{

    protected $listeners = [
        'changedOrderType',
        'checkout'
    ];

    public int $currentStep = 1;
    public string $email;
    public string $phone_number;
    public string $firstName;
    public string $lastName;
    public string $date;
    public string $time;
    public string $city;
    public string $address;
    public string $postal_code;
    public bool $schedule = false;

    public function mount()
    {
        $this->email = CartOrderHelper::get('contact.email', Auth::user()->email ?? '');
        $this->phone_number = CartOrderHelper::get('contact.phone_number', Auth::user()->phone_number ?? '');
        $this->firstName = CartOrderHelper::get('contact.firstName', Auth::user()->firstName ?? '');
        $this->lastName = CartOrderHelper::get('contact.lastName', Auth::user()->lastName ?? '');
        $this->date = CartOrderHelper::get('date', '');
        $this->time = CartOrderHelper::get('time', '');
        $this->city = CartOrderHelper::get('address.city', '');
        $this->postal_code = CartOrderHelper::get('address.postal_code', '');
        $this->address = CartOrderHelper::get('address.address', '');
        $this->currentStep = CartOrderHelper::get('currentStep', 1);
        $this->currentStep = 1;
    }

    public function render()
    {
        return view('resto2web::pages.checkout.components.checkout-component');
    }

    public function changedOrderType()
    {
        $this->render();
    }

    public function checkout()
    {
        $contactData = $this->validate([
            'email' => 'required|email',
            'phone_number' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
        ]);
        CartOrderHelper::set('contact', $contactData);

        if (CartOrderHelper::isDelivery()) {
            $addressData = $this->validate([
                'city' => 'required',
                'address' => 'required',
                'postal_code' => 'required'
            ]);
            CartOrderHelper::set('address', $addressData);
        }
        //TODO
        $this->date = '8/1/2021';
        $this->time = '11:20';
        CartOrderHelper::set('date', $this->date);
        CartOrderHelper::set('time', $this->time);

        $orderNumber = GenerateUniqueOrderNumberAction::execute();

        $orderData = new OrderData([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
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

        if (Auth::user()) {
            $orderData->user_id = Auth::id();
        }

        $order = Order::create($orderData->toArray());
        foreach (Cart::content() as $item) {
            switch ($item->associatedModel) {
                case Meal::class:
                    $orderItemData = new OrderItemData([
                        'quantity' => (float) $item->qty,
                        'meal_id' => $item->id,
                        'order_id' => $order->id,
                        'name' => $item->model->name,
                        'price' => (float) $item->price,
                        'options' => GenerateFormattedOptionsArrayAction::execute($item)
                    ]);
                    OrderItem::create($orderItemData->toArray());
                    break;
            }
        }

        Notification::route('mail',app(GeneralSettings::class)->email)
            ->notify(new AdminNewOrderNotification($order));
        Notification::route('mail',$order->email)
            ->notify(new UserNewOrderNotification($order));
        CartOrderHelper::clearEverything();
        $this->redirect(route('checkout.thanks'));

    }

    public function update($field,$value)
    {

    }
}
