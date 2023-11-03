<?php

use App\Models\School;

if (!function_exists('school')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function school(): School
    {
        return  School::where('user_id', auth()->user()->id)->first();
    }
}
