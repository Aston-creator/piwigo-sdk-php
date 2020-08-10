<?php
/**
 * Created by PhpStorm.
 * User: zhanghd
 * Date: 2020/8/9
 * Time: 19:45
 */

namespace aston_creator\piwigo_sdk_php;


class Users
{
    /**
     * Registers a new user.
     * 注册一个新用户
     * @param string $username
     * @param array|null $param
     * @return mixed
     * @throws \Exception
     */
    public function add(string $username, array $param = null)
    {
        $array = [
            'method' => 'pwg.users.add',
            'username' => Validate::check('username', $username),
            'pwg_token' => ClassFactory::getClass('session')->getStatus('pwg_token')
        ];

        if (isset($param['password'])) {
            $array['password'] = Validate::check('password', $param['password']);
            $array['password_confirm'] = $param['password'];
        }

        if (isset($param['email'])) {
            $array['email'] = Validate::check('email', $param['email']);
        }

        if (isset($param['send_password_by_mail'])) {
            $array['send_password_by_mail'] = Validate::check('send_password_by_mail', $param['send_password_by_mail'], null, 'b');
        }

        return Http::post($array);
    }

    /**
     * Deletes on or more users. Photos owned by this user are not deleted.
     * 删除一个或多个用户。 该用户拥有的照片不会被删除
     * @param $user_id
     * @return mixed
     * @throws \Exception
     */
    public function delete($user_id)
    {
        return Http::get([
            'user_id' => Validate::check('user_id', $user_id, '[]', 'i'),
            'pwg_token' => ClassFactory::getClass('session')->getStatus('pwg_token'),
            'method' => 'pwg.users.delete'
        ]);
    }

    /**
     * Adds the indicated image to the current user's favorite images.
     * 将指示的图像添加到当前用户的收藏夹图像
     * @param $image_id
     * @return mixed
     * @throws \Exception
     */
    public function favoritesDdd($image_id)
    {
        return Http::get([
            'method' => 'pwg.users.favorites.add',
            'image_id' => Validate::check('image_id', $image_id, '[]', 'i')
        ]);
    }

    /**
     * Returns the favorite images of the current user.
     * 返回当前用户的收藏夹图像
     * @param int|null $per_page
     * @param int|null $page
     * @param string|null $order
     * @return mixed
     * @throws \Exception
     */
    public function favoritesGetList(int $per_page = null, int $page = null, string $order = null)
    {
        $param = ['method' => 'pwg.users.favorites.hetList'];

        if ($per_page != null) {
            $param['per_page'] = Validate::check('per_page', $per_page, null, 'i');
        }

        if ($page != null) {
            $param['per_page'] = Validate::check('page', null, 'i');
        }

        if ($order != null) {
            $temp = ['id', 'file', 'name', 'hit', 'rating_score', 'date_creation', 'date_available', 'random'];
            $param['order'] = Validate::in_array('order', $order, $temp);
        }

        return Http::get($param);
    }

    public function favoritesRemove($image_id)
    {
        return Http::get([
            'method' => 'pwg.users.favorites.remove',
            'image_id' => Validate::check('image_id', $image_id, '[]', 'i')
        ]);
    }

    /**
     * Get a new authentication key for a user. Only works for normal/generic users (not admins)
     * 获取用户的新身份验证密钥。 仅适用于普通/普通用户（不适用于管理员）
     * @return mixed
     */
    public function getAuthKey()
    {
        return Http::post([
            'method' => 'pwg.users.getAuthKey',
            'user_id' => ClassFactory::getClass('session')->getStatus('user_id'),
            'pwg_token' => ClassFactory::getClass('session')->getStatus('pwg_token'),
        ]);
    }

    /**
     * Retrieves a list of all the users.
     * 检索所有用户的列表
     * @param array|null $param
     * @return mixed
     * @throws \Exception
     */
    public function getList(array $param = null)
    {
        $array = ['method' => 'pwg.users.getList'];

        if (isset($param['user_id'])) {
            $array['user_id'] = Validate::check('user_id', $param['user_id'], '[]', 'i');
        }

        if (isset($param['username'])) {
            $array['username'] = Validate::check('username', $param['username']);
        }

        if (isset($param['status'])) {
            Validate::check('status', $param['status']);
            $array['status'] = Validate::in_array('status', $param['status'], ['guest', 'generic', 'normal', 'admin', 'webmaster']);
        }

        if (isset($param['min_level'])) {
            $array['min_level'] = Validate::check('min_level', $param['min_level'], null, 'i');
        }

        if (isset($param['group_id'])) {
            $array['group_id'] = Validate::check('group_id', $param['group_id'], '[]', 'i');
        }

        if (isset($param['per_page'])) {
            $array['per_page'] = Validate::check('per_page', $param['per_page'], null, 'i');
        }

        if (isset($param['page'])) {
            $array['page'] = Validate::check('page', $param['page'], null, 'i');
        }

        if (isset($param['order'])) {
            Validate::check('order', $param['order']);
            $array['order'] = Validate::in_array('order', $param['order'], ['id', 'username', 'level', 'email']);
        }

        if (isset($param['order'])) {
            Validate::check('order', $param['order']);
            $array['order'] = Validate::in_array('order', $param['order'], ['id', 'username', 'level', 'email']);
        }

        if (isset($param['display'])) {
            $array['display'] = Validate::check('display', $param['display']);
        }

        return Http::get($param);
    }

    /**
     * Updates a user. Leave a field blank to keep the current value.
     * 更新用户。 将字段留空以保留当前值
     * @param $user_id
     * @param array|null $param
     * @return mixed
     * @throws \Exception
     */
    public function setInfo($user_id, array $param = null)
    {
        $array = [
            'method' => 'pwg.user.setInfo',
            'pwg_token' => ClassFactory::getClass('session')->getStatus('pwg_token'),
            'user_id' => Validate::check('user_id', $user_id)
        ];

        if (isset($param['username'])) {
            $array['username'] = Validate::check('username', $param['username']);
        }

        if (isset($param['password'])) {
            $array['password'] = Validate::check('password', $param['password']);
        }

        if (isset($param['email'])) {
            $array['email'] = Validate::check('email', $param['email']);
        }

        if (isset($param['status'])) {
            Validate::check('status', $param['status']);
            $array['status'] = Validate::in_array('status', $param['status'], ['guest', 'generic', 'normal', 'admin', 'webmaster']);
        }

        if (isset($param['level'])) {
            $array['level'] = Validate::check('level', $param['level'], null, 'i');
        }

        if (isset($param['language'])) {
            $array['language'] = Validate::check('language', $param['language']);
        }

        if (isset($param['theme'])) {
            $array['theme'] = Validate::check('theme', $param['theme']);
        }

        if (isset($param['group_id'])) {
            $array['group_id'] = Validate::check('group_id', $param['group_id']);
        }

        if (isset($param['nb_image_page'])) {
            $array['nb_image_page'] = Validate::check('nb_image_page', $param['nb_image_page'], null, 'i');
        }

        if (isset($param['recent_period'])) {
            $array['recent_period'] = Validate::check('recent_period', $param['recent_period'], null, 'i');
        }

        if (isset($param['expand'])) {
            $array['expand'] = Validate::check('expand', $param['expand'], null, 'b');
        }

        if (isset($param['show_nb_comments'])) {
            $array['show_nb_comments'] = Validate::check('show_nb_comments', $param['show_nb_comments'], null, 'b');
        }

        if (isset($param['show_nb_hits'])) {
            $array['show_nb_hits'] = Validate::check('show_nb_hits', $param['show_nb_hits'], null, 'b');
        }

        if (isset($param['enabled_high'])) {
            $array['enabled_high'] = Validate::check('enabled_high', $param['enabled_high'], null, 'b');
        }

        return Http::post($array);
    }
}