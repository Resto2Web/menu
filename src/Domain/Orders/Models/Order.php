<?php


namespace Resto2web\Menu\Domain\Orders\Models;


use Illuminate\Database\Eloquent\Model;
use Resto2web\Core\Domain\Users\Models\User;
use Spatie\ModelStates\HasStates;

class Order extends Model
{
    use HasStates;
    protected $guarded = [];

    protected $casts = [
        'history' => 'array',
        'date' => 'date',
        'time' => 'datetime',
    ];

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
