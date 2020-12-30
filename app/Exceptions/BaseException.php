<?php
/**
 * Created by PhpStorm.
 * User: KyleCW.Lin
 * Date: 2019/1/23
 * Time: 上午 11:17
 */

namespace App\Exceptions;

use Exception;

abstract class BaseException extends Exception
{
    const FIELD_MSG = 'msg';
    const FIELD_INFO = 'detail';
    const FIELD_MEMBER_ID = 'memid';

    public function __construct(array $errArray, array $relateInfo = [])
    {
        $errorCode = static::getErrorCode($errArray[0]);

        $errorMsgs[self::FIELD_MSG] = $errArray[1];
        $errorMsgs = array_merge($errorMsgs, $relateInfo);
        $errorMsg = json_encode($errorMsgs, JSON_UNESCAPED_UNICODE);

        parent::__construct($errorMsg, $errorCode);
    }

    private static function getErrorCode($code)
    {
        $className = get_called_class();
        $baseCode = ExceptionCode::getBaseCode($className);

        return $baseCode + intval($code);
    }

}