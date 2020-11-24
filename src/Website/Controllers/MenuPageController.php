<?php


namespace Resto2web\Menu\Website\Controllers;


use Artesaos\SEOTools\Traits\SEOTools;
use Resto2web\Core\Common\Controllers\Controller;
use Resto2web\Menu\Domain\Menu\Models\MealCategory;

class MenuPageController extends Controller
{
    use SEOTools;
    public function __invoke()
    {
        $mealCategories = MealCategory::all();
        $this->seo()->setTitle('Menu');
        return view('resto2web::pages.menu')
            ->with(compact('mealCategories'));
    }
}
