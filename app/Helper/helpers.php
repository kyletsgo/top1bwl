<?php
/**
 * Created by PhpStorm.
 * User: KyleCW.Lin
 * Date: 2019/2/4
 * Time: 下午 09:29
 */

if (! function_exists('isApiCall')) {
    /**
     *  Check if is API call
     *
     * @return bool
     */
    function isApiCall()
    {
        if (is_null(request()->url())) {
            return false;
        }

        return str_contains(request()->url(), '/api/');
    }
}

if (! function_exists('oDebug')) {
    /**
     *  Debug log
     *
     * @param $message
     */
    function oDebug($message)
    {
        $bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
        $caller = array_shift($bt);

        $message = print_r($message, true);
        $account_id = auth('api')->user()->account_id ?? '';
        $file = basename($caller['file']);
        $line = $caller['line'];

        Log::debug($message, ['id' => $account_id, 'file' => $file, 'line' => $line]);
    }
}
