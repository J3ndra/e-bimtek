<?php

use Illuminate\Database\Seeder;
use Facades\Services\Course\FeedbackService as Feedback;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Feedback::init();
    }
}
