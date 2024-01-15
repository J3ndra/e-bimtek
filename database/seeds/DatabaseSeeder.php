<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ChannelSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(FeedbackSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(SliderSeeder::class);
        // $this->call(DesignSeeder::class);
    }
}
