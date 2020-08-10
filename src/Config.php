<?php
/**
 * Created by PhpStorm.
 * User: pe
 * Date: 2020/8/7
 * Time: 15:13
 */

namespace aston_creator\piwigo_sdk_php;


class Config
{
    private static $domain;

    public static function getDomain()
    {
        return self::$domain;
    }

    public static function setDomain(string $domain)
    {
        self::$domain = $domain;
    }
}