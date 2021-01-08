<?php


namespace Resto2web\Menu\Domain\Meals\DataTransferObjects;


use Illuminate\Foundation\Http\FormRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Str;

class MealData extends DataTransferObject
{
    public string $name;
    public string $slug;
    public string $description = '';
    public string $ingredients = '';
    public float $price = 0.00;
    public ?int $meal_category_id;
    public int $position = 1;
    public bool $active;
    public bool $available;

    public static function fromRequest(FormRequest $request)
    {
        return new self([
            'name' => $request->input('name'),
            "slug" => Str::slug($request->input('name')),
            "description" => $request->input('description'),
            "ingredients" => $request->input("ingredients"),
            "price" => (float) $request->input('price'),
            "meal_category_id" => ((int) $request->input('meal_category_id')) ?? null,
            'position' => 1,
            'active' => $request->has('active'),
            'available' => $request->has('available'),
        ]);
    }

}
