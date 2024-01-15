<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => 'Hiskia',
            'email'    => 'get@hiskia.dev',
            'password' => Hash::make('123456')
        ]);
    }
}
