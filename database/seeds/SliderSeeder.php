<?php

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::create([
            'name' => 'Demo Slider 1',
            'picture' => 'public/uploads/images/slider/slider_1.png'
        ]);
    }
}
