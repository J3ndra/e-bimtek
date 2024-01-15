<?php

use Illuminate\Database\Seeder;
use Facades\Services\Payment\ChannelService;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChannelService::sync();
    }
}
