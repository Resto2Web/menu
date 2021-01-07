<?php


namespace Resto2web\Menu\Website\Components;


use Livewire\Component;
use Resto2web\Menu\Domain\Cart\Actions\GetCartTotalWithDeliveryAction;
use Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper;
use Resto2web\Menu\Settings\MenuSettings;

class CartSidebar extends Component
{
    protected $listeners = ['updatedCart'];

    public float $minimumOrder;
    public bool $onlyDelivery;
    public bool $onlyTakeaway;
    public float $deliveryPrice;
    public bool $hasFreeDeliveryMinimum;
    public float $freeDeliveryMinimum;
    public string $type;

    public function mount()
    {
        $settings = app(MenuSettings::class);
        $this->minimumOrder = $settings->minimumOrder;
        $this->onlyDelivery = $settings->onlyDelivery();
        $this->onlyTakeaway = $settings->onlyTakeaway();
        $this->deliveryPrice = $settings->deliveryPrice;
        $this->hasFreeDeliveryMinimum = $settings->hasFreeDeliveryMinimum;
        $this->freeDeliveryMinimum = $settings->freeDeliveryMinimum;
        $this->type = CartOrderHelper::getType();
    }

    public function render()
    {
        return view('resto2web::pages.menu.components.cart-sidebar-component');
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
    }


}
