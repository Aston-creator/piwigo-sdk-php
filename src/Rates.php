<?php
/**
 * Created by PhpStorm.
 * User: zhanghd
 * Date: 2020/8/9
 * Time: 16:15
 */

namespace aston_creator\piwigo_sdk_php;


class Rates
{
    public function delete(int $user_id, $anonymous_id = null, int $image_id = null)
    {
        $param = [
            'method' => 'pwg.rates.delete',
            'user_id' => Validate::check('user_id', $user_id, null, 'i')
        ];

        if ($anonymous_id != null) {
            $param['anonymous_id'] = Validate::check('anonymous_id', $anonymous_id);
        }

        if ($image_id != null) {
            $param['image_id'] = Validate::check('image_id', $image_id, null, 'i');
        }

        return Http::post($param);
    }
}