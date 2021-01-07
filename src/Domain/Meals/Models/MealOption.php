<?php


namespace Resto2web\Menu\Domain\Meals\Models;


use Illuminate\Database\Eloquent\Model;

class MealOption extends Model
{
    protected $guarded = [];

    public function optionGroup()
    {
        return $this->belongsTo(MealOptionGroup::class);
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
}
