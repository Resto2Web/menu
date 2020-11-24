<?php


namespace Resto2web\Menu\Admin\Meals\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreMealRequest extends FormRequest
{
    public function rules()
    {
        return [
            "name" => "required",
            "description" => "nullable",
            "price" => "required|numeric",
            "image" => "nullable",
            "ingredients" => "nullable",
            "meal_category_id" => "nullable"
        ];
    }
}
