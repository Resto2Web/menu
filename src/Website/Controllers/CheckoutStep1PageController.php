<?php


namespace Resto2web\Menu\Website\Controllers;


use Resto2web\Menu\Domain\Cart\Actions\GetCartTotalWithDeliveryAction;

class CheckoutStep1PageController
{
    public function index()
    {
        $totalWithDelivery = GetCartTotalWithDeliveryAction::execute();
        return view('resto2web::pages.checkout.checkout')
            ->with(compact('totalWithDelivery'));
    }

    public function store()
    {

        dd(request());
    }
}
