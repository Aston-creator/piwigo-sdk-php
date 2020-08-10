<?php
/**
 * Created by PhpStorm.
 * User: zhanghd
 * Date: 2020/8/9
 * Time: 16:22
 */

namespace aston_creator\piwigo_sdk_php;


class Tags
{
    /**
     * Adds a new tag
     * 添加一个新标签
     * @param $name
     * @return mixed
     */
    public function add($name)
    {
        return Http::post(['name' => $name, 'method' => 'pwg.tags.add']);
    }

    public function getAdminList()
    {
        return Http::get(['method' => 'pwg.tags.getAdminList']);
    }

    public function getImages($tag_id, $tag_url_name, $tag_name, array $param = null)
    {
        $array = ['method' => 'pwg.tags.getImages'];

    }

    public function getList(bool $sort_by_counter = null)
    {
        $param = ['method' => 'pwg.tags.getList'];
        if ($sort_by_counter != null) {
            $param['sort_by_counter'] = Validate::check('sort_by_counter',$sort_by_counter,null,'b');
        }
        return Http::get($param);
    }
}