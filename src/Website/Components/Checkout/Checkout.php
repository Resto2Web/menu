<?php


namespace Resto2web\Menu\Website\Components\Checkout;


use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Resto2web\Menu\Domain\Orders\Models\Order;
use Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper;

class Checkout extends Component
{

    public int $currentStep = 1;
    public string $email;
    public string $phone_number;
    public string $name;
    public string $date;
    public string $time;

    public function mount()
    {
        $this->email = CartOrderHelper::get('contact.email',Auth::user()->email ?? '');
        $this->phone_number = CartOrderHelper::get('contact.phone_number',Auth::user()->phone_number ?? '');
        $this->name = CartOrderHelper::get('contact.name',Auth::user()->fullName ?? '');
        $this->date = CartOrderHelper::get('date','');
        $this->time = CartOrderHelper::get('time','');
        $this->currentStep = CartOrderHelper::get('currentStep',1);
    }

    public function render()
    {
        return view('resto2web::pages.checkout.components.checkout-component');
    }

    public function continue()
    {
        switch ($this->currentStep) {
            case 1:
                $this->validate([
                   'email' => 'required|email',
                   'phone_number' => 'required',
                   'name' => 'required',
                ]);
                CartOrderHelper::set('contact.email',$this->email);
                CartOrderHelper::set('contact.phone_number',$this->phone_number);
                CartOrderHelper::set('contact.name',$this->name);
                $this->currentStep = 2;
                CartOrderHelper::set('currentStep',$this->currentStep);
                break;
            case 2:
                $this->validate();
                $this->date = '8/1/2021';
                $this->time = '11:20';
                CartOrderHelper::set('date',$this->date);
                CartOrderHelper::set('time',$this->time);

                $this->currentStep = 3;
                CartOrderHelper::set('currentStep',$this->currentStep);
                break;
            case 3:
                $data['name'] = CartOrderHelper::get('contact.name');
                $data['email'] = CartOrderHelper::get('contact.email');
                $data['phone_number'] = CartOrderHelper::get('contact.phone_number');

                Order::create($data);

                break;
            default:
                throw new \Exception('Step not recognized');
                break;
        }
    }
}
