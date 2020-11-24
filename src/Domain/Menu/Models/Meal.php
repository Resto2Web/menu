<?php


namespace Resto2web\Menu\Domain\Menu\Models;


use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(MealCategory::class,'meal_category_id');
    }
}
