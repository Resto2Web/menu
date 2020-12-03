<?php


namespace Resto2web\Menu\Domain\Utility;


use Illuminate\Support\Facades\Session;

class OrderHelper
{
    private string $baseKey = 'order';

    const DELIVERY = 'delivery';
    const COLLECTION = 'collection';

    protected static array $orderTypes = [1 => self::DELIVERY, 2 => self::COLLECTION];

    public function get($key)
    {
        Session::get($this->prepareKey($key));
    }

    public function set($key,$value)
    {
        Session::put($this->prepareKey($key),$value);
    }

    private function prepareKey($key)
    {
        return $this->baseKey.'.'.$key;
    }
}
