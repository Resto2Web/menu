<?php


namespace Resto2web\Menu\Domain\Meals\Models;

use Illuminate\Database\Eloquent\Model;

class MealCategory extends Model
{
    protected $guarded = [];

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    public function active_meals()
    {
        return $this->hasMany(Meal::class)->where('active',true);
    }

}
