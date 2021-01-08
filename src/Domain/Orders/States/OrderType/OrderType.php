<?php


namespace Resto2web\Menu\Domain\Orders\States\OrderType;


use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;


abstract class OrderType extends State
{
    abstract public function color(): string;
    abstract public function displayName(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->allowTransitions([
                [Delivery::class,Takeaway::class],
                [Takeaway::class,Delivery::class],
            ]);
    }

}
