<?php
/**
 * Created by PhpStorm.
 * User: zhanghd
 * Date: 2020/8/8
 * Time: 14:36
 */

namespace aston_creator\piwigo_sdk_php;


class Groups
{
    public function add(string $name, bool $is_default = null)
    {
        $param = [
            'name' => $name,
            'method' => 'pwg.groups.add'
        ];

        if (isset($is_default) && is_bool($is_default)) {
            $param['is_default'] = $is_default;
        }

        return Http::post($param);
    }

    public function addUser(array $group_id, int $user_id)
    {
        Http::post([
            'group_id' => $group_id,
            'user_id' => $user_id,
            'method' => 'pwg.groups.addUser',
            'pwg_token' => ClassFactory::getClass('session')->getStatus('pwg_token'),
        ]);
    }

    public function delete(array $group_id)
    {
        return Http::post([
            'group_id' => $group_id,
            'method' => 'pwg.groups.delete',
            'pwg_token' => ClassFactory::getClass('session')->getStatus('pwg_token'),
        ]);
    }

    public function deleteUser(int $group_id, array $user_id)
    {
        return Http::post([
            'group_id' => $group_id,
            'user_id' => $user_id,
            'method' => 'pwg.groups.deleteUser',
            'pwg_token' => ClassFactory::getClass('session')->getStatus('pwg_token'),
        ]);
    }

    public function getList(int $group_id = null, string $name = null, int $per_page = null, int $page = null, int $order = null)
    {

        Http::post([]);
    }

    public function setInfo()
    {

    }
}