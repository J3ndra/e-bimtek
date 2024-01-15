<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'     => 'Hiskia',
            'email'    => 'get@hiskia.dev',
            'password' => Hash::make('123456')
        ]);

        Admin::create([
            'name'     => 'Bagas',
            'email'    => 'baagas0@gmail.com',
            'password' => Hash::make('123456')
        ]);
    }
}
