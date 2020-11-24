<?php


namespace Resto2web\Menu\Admin\Meals\Controllers;


use Resto2web\Core\Common\Controllers\Controller;
use Resto2web\Menu\Admin\Meals\DataTransferObjects\MealCategoryData;
use Resto2web\Menu\Admin\Meals\Requests\StoreMealCategoryRequest;
use Resto2web\Menu\Admin\Meals\Requests\UpdateMealCategoryRequest;
use Resto2web\Menu\Domain\Menu\Actions\StoreMealCategoryAction;
use Resto2web\Menu\Domain\Menu\Actions\UpdateMealCategoryAction;
use Resto2web\Menu\Domain\Menu\Models\MealCategory;


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
//        toastSuccess('Nouvelle catégorie ajoutée', 'Succès');
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
        UpdateMealCategoryAction::execute($data,$mealCategory);
//        notify()->success('Catégorie modifiée', 'Succès');
        return back();
    }

    public function destroy(MealCategory $mealCategory)
    {
        if(DestroyMealCategoryAction::execute($mealCategory)){
            toastSuccess('Catégorie supprimée', 'Succès');
        }else{
            toastError('Il y a eu une erreur', 'Erreur');
        }
        return redirect(route('dashboard.meal-categories.index'));
    }
}
