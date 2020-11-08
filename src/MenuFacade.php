<?php

namespace Resto2web\Menu;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Resto2web\Menu\Skeleton\SkeletonClass
 */
class MenuFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'menu';
    }
}
