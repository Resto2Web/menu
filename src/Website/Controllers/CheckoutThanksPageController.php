<?php


namespace Resto2web\Menu\Website\Controllers;


use Resto2web\Core\Common\Controllers\Controller;
use Resto2web\Menu\Domain\Cart\Actions\GetCartTotalWithDeliveryAction;

class CheckoutThanksPageController extends Controller
{
    public function __invoke()
    {
        return view('resto2web::pages.checkout.thanks');
    }
}
