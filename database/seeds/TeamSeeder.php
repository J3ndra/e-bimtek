<?php

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Design;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::create([
            'name'     => 'Hiskia',
            'email'    => 'get@hiskia.dev',
            'password' => Hash::make('123456')
        ]);

        Design::create([
          'name'                 => 'Certificate 1',
          'file'                 => 'images\certificate/certificate1604651449sertifikat-1.png',
          'n_import_font'            => "@import  url('https://fonts.googleapis.com/css2?family=Big+Shoulders+Inline+Text:wght@100&display=swap');",
          'n_horizontal'           => 'center',
          'n_vertical'             => 270,
          'n_margin_left'          => 0,
          'n_margin_right'         => 0,
          'n_font_style'             => 'sans',
          'n_font_size'            => 20,
          'd_import_font'            => "@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');",
          'd_horizontal'           => 'center',
          'd_vertical'             => 320,
          'd_margin_left'          => 250,
          'd_margin_right'         => 250,
          'd_font_style'             => 'sans',
          'd_font_size'            => 20,
          'is_active'            => 0
        ]);
    }
}
