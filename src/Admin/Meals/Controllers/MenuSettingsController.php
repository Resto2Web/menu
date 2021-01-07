<?php

namespace Resto2web\Menu\Admin\Meals\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Resto2web\Core\Common\Controllers\Controller;
use Resto2web\Menu\Settings\MenuSettings;

class MenuSettingsController extends Controller
{

    public function show()
    {
        $settings = app(MenuSettings::class);
        return view("resto2web-admin::pages.settings.menu")
            ->with(compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'minimumOrder' => 'required|numeric'
        ]);
        $settings = app(MenuSettings::class);

        $settings->minimumOrder = $request->input('minimumOrder');
        $settings->takeaway = $request->has('takeaway');
        $settings->delivery = $request->has('delivery');
        $settings->hasFreeDeliveryMinimum = $request->has('hasFreeDeliveryMinimum');
        $settings->freeDeliveryMinimum = $request->input('freeDeliveryMinimum');
        $settings->deliveryPrice = $request->input('deliveryPrice');
        $settings->save();
        notify()->addNotification('success','Modifications enregistreées');
        return back();
    }
}
