<?php
/**
 * Created by PhpStorm.
 * User: zhanghd
 * Date: 2020/8/9
 * Time: 19:40
 */

namespace aston_creator\piwigo_sdk_php;


class Themes
{
    public function performAction(string $action, string $theme)
    {
        return Http::get([
            'method' => 'pwg.themes.performAction',
            'action' => Validate::in_array('action', $action, ['activate', 'deactivate', 'delete', 'set_default']),
            'theme' => Validate::check('theme', $theme),
            'pwg_token' => ClassFactory::getClass('session')->getStatus('pwg_token')
        ]);
    }


}