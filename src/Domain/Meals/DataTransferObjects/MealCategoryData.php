<?php


namespace Resto2web\Menu\Domain\Meals\DataTransferObjects;


use Illuminate\Foundation\Http\FormRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Str;

class MealCategoryData extends DataTransferObject
{
    public string $name;
    public string $slug;
    public int $position = 1;
    public bool $active;

    public static function fromRequest(FormRequest $request)
    {
        return new self([
            'name' => $request->input('name'),
            "slug" => Str::slug($request->input('name')),
            'position' => 1,
            'active' => $request->has('active'),
        ]);
    }

}
