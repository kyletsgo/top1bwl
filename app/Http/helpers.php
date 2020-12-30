<?php

/**
 * 轉換DateTime字串為Date
 */
if (!function_exists('toDate'))
{
    function toDate($datetime = null)
    {
        return date_format(new DateTime($datetime), 'Y-m-d');
    }
}

/**
 * 取得GUID
 */
if (!function_exists('getGUID'))
{
    function getGUID(){
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }
        else {
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12);
            return $uuid;
        }
    }
}

/**
 * 檢查陣列是否有重複值
 */
if (!function_exists('has_dupes'))
{
    function has_dupes($array) {
        return count($array) !== count(array_unique($array));
    }
}


if (!function_exists('cdn_url'))
{
    function cdn_url($path = null)
    {
        if (env('APP_ENV') === 'production')
        {
            return env('CDN_URL').$path;
        }
        else
        {
            return env('APP_URL').'/storage'.$path;
        }
    }
}