<?php
/**
 * Created by PhpStorm.
 * User: zhanghd
 * Date: 2020/8/9
 * Time: 15:54
 */

namespace aston_creator\piwigo_sdk_php;


class Permissions
{
    /**
     * Adds permissions to an album.
     * 向相册添加权限
     * @param int $cat_id
     * @param null $group_id
     * @param int|null $user_id
     * @param bool|null $recursive
     * @return mixed
     * @throws \Exception
     */
    public function add(int $cat_id, $group_id = null, int $user_id = null, bool $recursive = null)
    {
        $param = [
            'method' => 'pwg.permissions.add',
            'pwg_token' => ClassFactory::getClass('session')->getStatus('pwg_token'),
            'cat_id' => Validate::check('cat_id', $cat_id, '[]', 'i'),
        ];

        if ($group_id != null) {
            $param['group_id'] = Validate::check('group_id', $group_id, '[]', 'i');
        }

        if ($user_id != null) {
            $param['user_id'] = Validate::check('user_id', $user_id, '[]', 'i');
        }

        if ($recursive != null) {
            $param['recursive'] = Validate::check('recursive', $recursive, null, 'b');
        }

        return Http::post($param);
    }

    /**
     * Returns permissions: user ids and group ids having access to each album ; this list can be filtered. Provide only one parameter!
     * 返回权限：有权访问每个相册的用户ID和组ID； 此列表可以被过滤。 仅提供一个参数！
     * @param null $cat_id
     * @param null $group_id
     * @param null $user_id
     * @return mixed
     * @throws \Exception
     */
    public function getList($cat_id = null, $group_id = null, $user_id = null)
    {
        $param = ['method' => 'pwg.permissions.getList'];

        if ($cat_id != null) {
            $param['cat_id'] = Validate::check('cat_id', $cat_id, '[]', 'i');
        }

        if ($group_id != null) {
            $param['group_id'] = Validate::check('group_id', $group_id, '[]', 'i');
        }

        if ($user_id != null) {
            $param['user_id'] = Validate::check('user_id', $user_id, '[]', 'i');
        }

        return Http::get($param);
    }

    /**
     * Removes permissions from an album.
     * 从相册中删除权限
     * @param $cat_id
     * @param null $group_id
     * @param null $user_id
     * @return mixed
     * @throws \Exception
     */
    public function remove($cat_id, $group_id = null, $user_id = null)
    {
        $param = [
            'method' => 'pwg.permissions.remove',
            'pwg_token' => ClassFactory::getClass('session')->getStatus('pwg_token'),
            'cat_id' => Validate::check('cat_id', $cat_id, '[]', 'i'),
        ];

        if ($group_id != null) {
            $param['group_id'] = Validate::check('group_id', $group_id, '[]', 'i');
        }

        if ($user_id != null) {
            $param['user_id'] = Validate::check('user_id', $user_id, '[]', 'i');
        }

        return Http::post($param);
    }
}