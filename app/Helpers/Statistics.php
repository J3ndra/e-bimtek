<?php

use Facades\Services\StatisticService as Statistic;

if (!function_exists('earnings')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function earnings()
    {
    	return Statistic::earnings();
    }
}

if (!function_exists('sales')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function sales()
    {
    	return Statistic::sales();
    }
}