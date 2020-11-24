<?php


namespace Resto2web\Menu\Admin\Meals\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreMealCategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            "name" => "required",
        ];
    }
}
