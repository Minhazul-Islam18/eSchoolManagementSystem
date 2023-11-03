<?php

use App\Models\SiteSetting;

if (!function_exists('setting')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function setting($key, $default = null)
    {
        return SiteSetting::getByKey($key, $default);
    }
}
