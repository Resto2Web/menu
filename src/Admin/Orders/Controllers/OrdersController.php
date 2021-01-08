<?php

namespace Resto2web\Menu\Admin\Orders\Controllers;



use Resto2web\Core\Common\Controllers\Controller;
use Resto2web\Menu\Domain\Orders\Models\Order;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view("resto2web-admin::pages.orders.index")
            ->with(compact('orders'));
    }

    public function show(Order $order)
    {
        return view('resto2web-admin::pages.orders.show')
            ->with(compact('order'));
    }

}
