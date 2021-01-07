<?php


namespace Resto2web\Menu\Domain\Meals\Models;


use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model implements Buyable
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(MealCategory::class,'meal_category_id');
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2, ',', '.')." €";
    }

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }

    public function getBuyableWeight($options = null)
    {
        return 0;
    }

    public function optionsGroups()
    {
        return $this->hasMany(MealOptionGroup::class);
    }

    public function getHasOptionsAttribute()
    {
        return $this->optionsGroups()->count();
    }
}
