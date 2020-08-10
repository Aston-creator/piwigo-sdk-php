<?php
/**
 * Created by PhpStorm.
 * User: zhanghd
 * Date: 2020/8/7
 * Time: 23:09
 */

namespace aston_creator\piwigo_sdk_php;


class ClassFactory
{
    private static $class_map = [];

    public static function getClass(string $class_name)
    {
        $name = strtolower($class_name);
        if (!isset(self::$class_map[$name])) {
            $class_name = __NAMESPACE__ . '\\' . ($class_name);
            self::$class_map[$name] = new $class_name();
        }
        return self::$class_map[$name];
    }
}