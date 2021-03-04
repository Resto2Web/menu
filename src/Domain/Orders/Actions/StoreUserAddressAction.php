<?php


namespace Resto2web\Menu\Domain\Orders\Actions;


use Resto2web\Core\Domain\Users\DataTransferObjects\AddressData;
use Resto2web\Core\Domain\Users\Models\User;
use Resto2web\Core\Domain\Users\Models\UserAddress;

class StoreUserAddressAction
{
    public static function execute(User $user, AddressData $addressData)
    {
        $addressData = $addressData->toArray();
        $addressData = array_merge($addressData,['user_id'=> $user->id]);
        $addressData['default'] = !(bool) $user->addresses()->count();
        $addressData['title'] = 'Adresse par défaut';

        return UserAddress::create($addressData);
    }
}
