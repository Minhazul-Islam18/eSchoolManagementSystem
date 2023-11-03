<?php

if (!function_exists('abort_action')) {

    /**
     * description
     *This function will check is the action is authorized by curerent user. Otherwise user can't edit, update or anything
     * @param
     * @return
     */
    function abort_action($e)
    {
        return abort_if($e !== auth()->user()->id, 404);
    }
}
