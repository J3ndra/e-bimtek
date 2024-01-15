<?php

use Facades\Services\Course\FeedbackService as Feedback;
use Facades\Services\Course\CourseService as Course;

if (!function_exists('feedbacks')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function feedbacks()
    {
        return Feedback::take();
    }
}

if (!function_exists('recommendedCourses')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function recommendedCourses()
    {
        return Course::recomended();
    }
}
