<?php


namespace Resto2web\Menu\Domain\Orders\DataTransferObjects;


use Carbon\Carbon;

class OrderData extends \Spatie\DataTransferObject\DataTransferObject
{

    public string $first_name;
    public string $last_name;
    public string $email;
    public string $phone_number;
    public string $type;
    public float $delivery;
    public float $total;
    public string $number;
    public ?string $address;
    public ?string $postal_code;
    public ?string $city;
    public Carbon $date;
    public Carbon $time;
    public ?int $user_id;

}
