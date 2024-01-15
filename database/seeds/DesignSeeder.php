<?php

use Illuminate\Database\Seeder;
use App\Models\Design;

class DesignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Design::create([
          'name'                 => 'Certificate 1',
          'file'                 => 'certificate1.png',
          'horizontal'           => 300,
          'vertical'             => 500,
          'is_horizontal_center' => 0,
          'is_vertical_center'   => 0,
          'is_active'            => 0
        ]);
    }
}
