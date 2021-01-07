<?php


namespace Resto2web\Menu\Domain\Meals\Models;


use Illuminate\Database\Eloquent\Model;

class MealOptionGroup extends Model
{
    public const OR = 'or';
    public const AND = 'and';
    protected $guarded = [];

    public function mealOptions()
    {
        return $this->hasMany(MealOption::class);
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
}
