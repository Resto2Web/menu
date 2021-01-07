<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateMenuSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('menu.takeaway', false);
        $this->migrator->add('menu.delivery', false);
        $this->migrator->add('menu.minimumOrder',0);
        $this->migrator->add('menu.hasFreeDeliveryMinimum',false);
        $this->migrator->add('menu.freeDeliveryMinimum',0);
        $this->migrator->add('menu.deliveryPrice',0);
    }
}
