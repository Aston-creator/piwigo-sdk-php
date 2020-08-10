<?php
/**
 * Created by PhpStorm.
 * User: zhanghd
 * Date: 2020/8/7
 * Time: 22:55
 */

namespace aston_creator\piwigo_sdk_php;


class Caddie
{
    public function add($image_id)
    {
        if (is_numeric($image_id) || is_array($image_id)) {
            return Http::post([
                'method' => 'pwg.caddie.add',
                'image_id' => $image_id
            ]);
        }
        return 0;
    }
}