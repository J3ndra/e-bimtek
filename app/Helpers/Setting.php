<?php

use Facades\Services\SettingService;

if (!function_exists('setting')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function setting($slug, $default = '')
    {
        return SettingService::findBySlug($slug);
    }
}

if (!function_exists('footer_link')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function footer_link($slug, $default = '')
    {
        return SettingService::allBySlug($slug);
    }
}
