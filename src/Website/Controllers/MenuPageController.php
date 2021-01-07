<?php


namespace Resto2web\Menu\Website\Controllers;


use Artesaos\SEOTools\Traits\SEOTools;
use Resto2web\Core\Common\Controllers\Controller;
use Resto2web\Menu\Domain\Meals\Models\MealCategory;

class MenuPageController extends Controller
{
    use SEOTools;
    public function __invoke()
    {
        $mealCategories = MealCategory::all();
        $this->seo()->setTitle('Meals');
        return view('resto2web::pages.menu')
            ->with(compact('mealCategories'));
    }
}
