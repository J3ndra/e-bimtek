<?php

use Carbon\Carbon;
use Facades\Services\Course\CourseService as Course;
use Facades\Services\Payment\PaymentService as Payment;

if (!function_exists('daterange')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function daterange($date, $type = 'end', $format = 'Y-m-d')
    {
    	$dates = explode(' to ', $date);

    	if ($type == 'start') {
    		$date = Carbon::parse($dates[0])->format($format);
    	}else{
    		$date = Carbon::parse($dates[1])->format($format);
    	}

    	return $date;
    }
}

if (!function_exists('isSold')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function isSold($course)
    {
        return Payment::isPaided($course);
    }
}