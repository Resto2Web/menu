<?php


namespace Resto2web\Menu\Domain\Menu\Models;


use Illuminate\Database\Eloquent\Model;

class MealCategory extends Model
{
    protected $guarded = [];

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }
}
