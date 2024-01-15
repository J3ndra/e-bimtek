<?php

use Illuminate\Database\Seeder;
use Facades\Services\SettingService;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingService::init();
    }
}
