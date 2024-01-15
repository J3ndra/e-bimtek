<?php

use Illuminate\Database\Seeder;
use Facades\Services\WhatsappService;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WhatsappService::send('+6285155064115', 'testttttttttt');
    }
}
