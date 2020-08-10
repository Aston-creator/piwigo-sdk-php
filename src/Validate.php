<?php
/**
 * Created by PhpStorm.
 * User: zhanghd
 * Date: 2020/8/7
 * Time: 22:00
 */

namespace aston_creator\piwigo_sdk_php;


class Validate
{
    public static function categoriesStatus($status)
    {
        return in_array(strtolower($status), ['public', 'private']);
    }

    public static function imageSizes($size)
    {
        return in_array($size, ['square', 'thumb', '2small', 'xsmall', 'small', 'medium', 'large', 'xlarge', 'xxlarge']);
    }

    public static function check(string $name, $value, string $extra = null, string $type = null)
    {
        if (empty($value)) {
            throw new \Exception($name . 'can not be empty');
        }

        $extra_array = false;
        switch ($extra) {
            case '[]':
                $extra_array = true;
                break;
            case null:
                break;
            default:
                throw new \Exception('extra error');
                break;
        }

        $type = strtolower($type);
        switch ($type) {
            case 'i':
                if (!is_array($value)) {
                    $value = [$value];
                } else if (is_array($value) && $extra_array == false) {
                    throw new \Exception($name . 'can not be array');
                }
                foreach ($value as $k => $v) {
                    if (!is_numeric($v)) {
                        throw new \Exception($name . ' must be integer');
                    }
                }
                break;
            case 'b':
                if (!is_bool($value)) {
                    throw new \Exception($name . ' must be boolean');
                }
                break;
            case 'f':
                if (!is_float($value)) {
                    throw new \Exception($name . ' must be float');
                }
                break;
            case '+':
                if ($value < 0) {
                    throw new \Exception($name . ' must be positive');
                }
                break;
            case null:
                break;
            default:
                throw new \Exception('type error');
                break;
        }

        return $value;
    }

    public static function in_array(string $name, $value, $array)
    {
        if (!in_array($value, $array)) {
            throw new \Exception($name . ' must belong to ' . implode(',', $array));
        }

        return $value;
    }
}