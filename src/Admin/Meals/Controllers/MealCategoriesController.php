<?php


namespace Resto2web\Menu\Admin\Meals\Controllers;


use Resto2web\Core\Common\Controllers\Controller;
use Resto2web\Menu\Admin\Meals\DataTransferObjects\MealCategoryData;
use Resto2web\Menu\Admin\Meals\Requests\StoreMealCategoryRequest;
use Resto2web\Menu\Admin\Meals\Requests\UpdateMealCategoryRequest;
use Resto2web\Menu\Domain\Meals\Actions\DestroyMealCategoryAction;
use Resto2web\Menu\Domain\Meals\Actions\StoreMealCategoryAction;
use Resto2web\Menu\Domain\Meals\Actions\UpdateMealCategoryAction;
use Resto2web\Menu\Domain\Meals\Models\MealCategory;


class MealCategoriesController extends Controller
{
    public function index()
    {
        $mealCategories = MealCategory::all();
        return view("resto2web-admin::pages.meal-categories.index")
            ->with(compact('mealCategories'));
    }

    public function show()
    {
        abort(404);
    }

    public function create()
    {
        abort(404);
    }

    public function store(StoreMealCategoryRequest $request)
    {
        $data = MealCategoryData::fromRequest($request);
        StoreMealCategoryAction::execute($data);
        notify('Catégorie ajoutée', 'success', 'Succès');
        return redirect(route("admin.meal-categories.index"));
    }

    public function edit(MealCategory $meal_category)
    {
        return view("resto2web-admin::pages.meal-categories.edit")
            ->with(compact("meal_category"));
    }

    public function update(UpdateMealCategoryRequest $request, MealCategory $mealCategory)
    {
        $data = MealCategoryData::fromRequest($request);
        UpdateMealCategoryAction::execute($data, $mealCategory);
        notify('Catégorie modifiée', 'success', 'Succès');
        return back();
    }

    public function destroy(MealCategory $mealCategory)
    {
        DestroyMealCategoryAction::execute($mealCategory);
        notify('Catégorie supprimée','success', 'Succès');
        return redirect(route('admin.meal-categories.index'));
    }
}
