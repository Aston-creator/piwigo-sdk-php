<?php
/**
 * Created by PhpStorm.
 * User: zhanghd
 * Date: 2020/8/7
 * Time: 22:37
 */

namespace aston_creator\piwigo_sdk_php;


class ExceptionError extends \Exception
{
    // 重定义构造器使 message 变为必须被指定的属性
    public function __construct($message, $code = 0, Exception $previous = null) {

        // 确保所有变量都被正确赋值
        parent::__construct($message, $code, $previous);
    }
}