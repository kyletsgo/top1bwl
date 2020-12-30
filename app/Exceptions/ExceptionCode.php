<?php
/**
 * Created by PhpStorm.
 * User: KyleCW.Lin
 * Date: 2019/1/23
 * Time: 上午 11:32
 */

namespace App\Exceptions;


class ExceptionCode
{
    public static $baseErrCodes = [
        ApiException::class => 1000,
        LoginException::class => 2000,
        CarException::class => 3000,
        MemberException::class => 4000,
        ChatbotException::class => 5000,
        RedeemException::class => 6000,
    ];

    public static function getBaseCode($class)
    {
        if (!self::isClassExist($class)) {
            throw new \RuntimeException("Base Exception Code not defined. Exception Class: {$class}");
        }

        return ExceptionCode::$baseErrCodes[$class];
    }

    public static function isClassExist($class)
    {
        return array_key_exists($class, static::$baseErrCodes);
    }

}