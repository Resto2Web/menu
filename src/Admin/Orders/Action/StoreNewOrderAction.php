<?php


namespace Resto2web\Menu\Admin\Orders\Action;


use Gloudemans\Shoppingcart\Facades\Cart;
use Resto2web\Menu\Domain\Meals\Models\Meal;
use Resto2web\Menu\Domain\Orders\Actions\GenerateFormattedOptionsArrayAction;
use Resto2web\Menu\Domain\Orders\DataTransferObjects\OrderData;
use Resto2web\Menu\Domain\Orders\DataTransferObjects\OrderItemData;
use Resto2web\Menu\Domain\Orders\Models\Order;
use Resto2web\Menu\Domain\Orders\Models\OrderItem;

class StoreNewOrderAction
{
    public static function execute(OrderData $orderData)
    {
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
        return $order;

    }
}
