<?php
/**
 * Created by PhpStorm.
 * User: pe
 * Date: 2020/8/7
 * Time: 16:22
 */

namespace aston_creator\piwigo_sdk_php;


class Categories
{

    /**
     * Returns a list of categories
     * 返回类别列表
     * @param array|null $param
     * @return mixed
     * @throws \Exception
     */
    public function getList(array $param = null)
    {
        $temp = ['method' => 'pwg.categories.getList'];

        if (isset($param['cat_id'])) {
            $temp['cat_id'] = Validate::check('cat_id', $param['cat_id'], null, 'i');
        }

        if (isset($param['recursive'])) {
            $temp['recursive'] = Validate::check('recursive', $param['recursive'], null, 'b');
        }

        if (isset($param['public'])) {
            $temp['public'] = Validate::check('public', $param['public'], null, 'b');
        }

        if (isset($param['tree_output'])) {
            $temp['tree_output'] = Validate::check('tree_output', $param['tree_output'], null, 'b');
        }

        if (isset($param['fullname'])) {
            $temp['fullname'] = Validate::check('fullname', $param['fullname'], null, 'b');
        }

        if (isset($param['thumbnail_size'])) {
            Validate::check('thumbnail_size', $param['thumbnail_size']);
            $temp['thumbnail_size'] = Validate::in_array('thumbnail_size', $param['thumbnail_size'], ['square', 'thumb', '2small', 'xsmall', 'small', 'medium', 'large', 'xlarge', 'xxlarge']);
        }

        $categories = Http::get($temp);

        return $categories->categories;
    }

    /**
     * Adds an album.
     * 添加相册
     * @param string $name
     * @param int|null $parent
     * @param string|null $comment
     * @param bool|null $visible
     * @param string|null $status
     * @param bool|null $commentable
     * @return mixed
     * @throws \Exception
     */
    public function add(string $name, int $parent = null, string $comment = null, bool $visible = null, string $status = null, bool $commentable = null)
    {
        $param = [
            'name' => Validate::check('name', $name),
            'method' => 'pwg.categories.add',
        ];

        if ($parent != null) {
            $param['parent'] = Validate::check('parent', $parent, null, 'i');
        }

        if ($comment != null) {
            $param['comment'] = Validate::check('comment', $comment);
        }

        if ($visible != null) {
            $param['visible'] = Validate::check('visible', $visible, null, 'i');
        }

        if ($status != null) {
            Validate::check('status', $status);
            $param['status'] = Validate::in_array('status', $status, ['public', 'private']);
        }

        if ($commentable != null) {
            $param['commentable'] = Validate::check('commentable', $commentable, null, 'b');
        }

        return Http::post($param)->id;
    }

    /**
     * * Deletes album(s)
     * 删除相册
     * @param array $category_id
     * @param string|null $photo_deletion_mode
     * @return mixed
     * @throws \Exception
     */
    public function delete(array $category_id, string $photo_deletion_mode = null)
    {
        Validate::check('photo_deletion_mode', $photo_deletion_mode);
        return Http::post([
            'method' => 'pwg.categories.delete',
            'category_id' => Validate::check('category_id', $category_id, '[]', 'i'),
            'photo_deletion_mode' => Validate::in_array('category_id', $category_id, ['delete_orphans', 'no_delete', 'force_delete']),
            'pwg_token' => ClassFactory::getClass('session')->getStatus('pwg_token')
        ]);
    }

    /**
     * Deletes the album thumbnail. Only possible if $conf['allow_random_representative']
     * 删除相册缩略图
     * @param int $category_id
     * @return mixed
     * @throws \Exception
     */
    public function deleteRepresentative(int $category_id)
    {
        return Http::post([
            'method' => 'pwg.categories.deleteRepresentative',
            'category_id' => Validate::check('category_id', $category_id, '[]', 'i')
        ]);
    }

    /**
     * Get albums list as displayed on admin page.
     * 获取显示在管理页面上的相册列表
     * @return mixed
     */
    public function getAdminList()
    {
        return Http::get(['method' => 'pwg.categories.getAdminList']);
    }

    /**
     * Returns elements for the corresponding categories.
     * cat_id can be empty if recursive is true.
     * order comma separated fields for sorting
     *
     * @param array|null $param
     * @return mixed
     * @throws \Exception
     */
    public function getImages(array $param = null)
    {
        $temp = ['method' => 'pwg.categories.getImages'];

        if (isset($param['cat_id'])) {
            $temp['cat_id'] = Validate::check('cat_id', $param['cat_id'], null, 'i');
        }

        if (isset($param['recursive'])) {
            $temp['recursive'] = Validate::check('cat_id', $param['cat_id'], null, 'i');
        }

        if (isset($param['per_page'])) {
            $temp['per_page'] = Validate::check('per_page', $param['per_page'], null, 'i');
        }

        if (isset($param['page'])) {
            $temp['page'] = Validate::check('page', $param['page'], null, 'i');
        }

        if (isset($param['order'])) {
            $temp['order'] = Validate::is_array('order', $param['order'], ['id', 'file', 'name', 'hit', 'rating_score', 'data_creation', 'data_available,random']);
        }

        if (isset($param['f_min_rate'])) {
            $temp['f_min_rate'] = Validate::check('f_min_rate', $param['f_min_rate'], null, 'f');
        }

        if (isset($param['f_max_rate'])) {
            $temp['f_max_rate'] = Validate::check('f_max_rate', $param['f_max_rate'], null, 'f');
        }

        if (isset($param['f_min_hit'])) {
            $temp['f_min_hit'] = Validate::check('f_min_hit', $param['f_min_hit'], null, 'f');
        }

        if (isset($param['f_max_hit'])) {
            $temp['f_max_hit'] = Validate::check('f_max_hit', $param['f_max_hit'], null, 'f');
        }

        if (isset($param['f_min_ratio'])) {
            $temp['f_min_ratio'] = Validate::check('f_min_ratio', $param['f_min_ratio'], null, 'f');
        }

        if (isset($param['f_max_ratio'])) {
            $temp['f_max_ratio'] = Validate::check('f_max_ratio', $param['f_max_ratio'], null, 'f');
        }

        if (isset($param['f_max_level'])) {
            $temp['f_max_level'] = Validate::check('f_max_ratio', $param['f_max_ratio'], null, 'i');
        }

        if (isset($param['f_min_date_available'])) {
            $temp['f_min_date_available'] = Validate::check('f_min_date_available', $param['f_min_date_available']);
        }

        if (isset($param['f_max_date_available'])) {
            $temp['f_max_date_available'] = Validate::check('f_max_date_available', $param['f_max_date_available']);
        }

        if (isset($param['f_min_date_created'])) {
            $temp['f_min_date_created'] = Validate::check('f_min_date_created', $param['f_min_date_created']);
        }

        if (isset($param['f_max_date_created'])) {
            $temp['f_max_date_created'] = Validate::check('f_max_date_created', $param['f_max_date_created']);
        }


        return Http::get($temp);
    }

    public function move(array $category_id, int $parent)
    {
        return Http::post([
            'category_id' => $category_id,
            'parent' => $parent,
            'pwg_token' => ClassFactory::getClass('session')->getStatus('pwg_token'),
            'method' => 'pwg.categories.getImages',
        ]);
    }

    /**
     * Find a new album thumbnail.
     * 查找新的相册缩略图
     * @param array $category_id
     * @return mixed
     * @throws \Exception
     */
    public function refreshRepresentative(array $category_id)
    {
        return Http::post([
            'category_id' => Validate::check('category_id', $category_id, null, 'i'),
            'method' => 'pwg.categories.refreshRepresentative',
        ]);
    }

    /**
     * Changes properties of an album.
     * 更改相册的属性
     * @param int $category_id
     * @param string|null $name
     * @param string|null $comment
     * @param string|null $status
     * @return mixed
     */
    public function setInfo(int $category_id, string $name = null, string $comment = null, string $status = null)
    {
        $param = [
            'category_id' => $category_id,
            'method' => 'pwg.categories.setInfo',
        ];

        if (isset($name)) {
            $param['name'] = $name;
        }

        if (isset($comment)) {
            $param['comment'] = $comment;
        }

        if (isset($status) && Validate::categoriesStatus($status)) {
            $param['status'] = $status;
        }


        return Http::post($param);
    }

    /**
     * Changes the rank of an album
     * 更改专辑的等级
     * @param array $category_id
     * @param int|null $rank
     * @return mixed
     */
    public function setRank(array $category_id, int $rank = null)
    {
        $param = [
            'category_id' => $category_id,
            'method' => 'pwg.categories.setRank',
        ];

        if (isset($rank) && is_numeric($rank)) {
            $param['rank'] = $rank;
        }

        return Http::post($param);
    }

    /**
     * Sets the representative photo for an album. The photo doesn't have to belong to the album.
     * @param int $category_id
     * @param int $image_id
     * @return mixed
     */
    public function setRepresentative(int $category_id, int $image_id)
    {
        return Http::post([
            'category_id' => $category_id,
            'method' => 'pwg.categories.setRepresentative',
            'image_id' => $image_id,
        ]);
    }
}