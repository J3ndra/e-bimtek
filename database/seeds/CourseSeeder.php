<?php

use Illuminate\Database\Seeder;
use Facades\Services\Course\CategoryService as Category;
use Facades\Services\Course\CourseService as Course;
use Facades\Services\Course\LessonService as Lesson;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Category::init();
    	Course::init();
    	// Lesson::init();
    }
}
