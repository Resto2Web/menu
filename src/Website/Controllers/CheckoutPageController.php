<?php


namespace Resto2web\Menu\Website\Controllers;


use Resto2web\Core\Common\Controllers\Controller;
use Resto2web\Menu\Domain\Cart\Actions\GetCartTotalWithDeliveryAction;

class CheckoutPageController extends Controller
{
    public function index()
    {
        return view('resto2web::pages.checkout.checkout');
    }

    public function store()
    {

        dd(request());
    }
}
