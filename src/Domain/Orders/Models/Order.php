<?php


namespace Resto2web\Menu\Domain\Orders\Models;


use Illuminate\Database\Eloquent\Model;
use Resto2web\Core\Domain\Users\Models\User;
use Resto2web\Menu\Domain\Orders\States\OrderStatus\OrderStatus;
use Resto2web\Menu\Domain\Orders\States\OrderType\OrderType;
use Spatie\ModelStates\HasStates;

class Order extends Model
{
    use HasStates;

    protected $guarded = [];

    protected $casts = [
        'history' => 'array',
        'date' => 'date',
        'time' => 'datetime',
        'status' => OrderStatus::class,
        'type' => OrderType::class,
    ];

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute() : string
    {
        return $this->first_name." ".$this->last_name;
    }


}
