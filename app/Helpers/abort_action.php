<?php

if (!function_exists('abort_action')) {

    /**
     * description
     *This function will check is the action is authorized by curerent user. Otherwise user can't edit, update or anything
     * @param int $school_id
     * @return boolean
     */
    function abort_action($school_id)
    {
        return abort_if($school_id !== auth()->user()->id, 404);
    }
}
