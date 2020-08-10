<?php
/**
 * Created by PhpStorm.
 * User: zhanghd
 * Date: 2020/8/9
 * Time: 16:08
 */

namespace aston_creator\piwigo_sdk_php;


class Plugins
{
    /**
     * Gets the list of plugins with id, name, version, state and description.
     * 获取具有ID，名称，版本，状态和描述的插件列表
     * @return mixed
     */
    public function getList()
    {
        return Http::get(['method' => 'pwg.plugins.getList']);
    }

    public function performAction($action, $plugin)
    {
        return Http::get([
            'method' => 'pwg.plugins.performAction',
            'action' => Validate::in_array('action', $action, ['install', 'activate', 'deactivate', 'uninstall', 'delete']),
            'plugin' => Validate::check('plugin', $plugin),
            'pwg_token' => ClassFactory::getClass('session')->getStatus('pwg_token')
        ]);
    }


}