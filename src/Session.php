<?php
/**
 * Created by PhpStorm.
 * User: pe
 * Date: 2020/8/5
 * Time: 12:28
 */

namespace aston_creator\piwigo_sdk_php;


class Session
{
    private $status;

    public function login(string $user_name, string $password)
    {
        $response = Http::post([
            'username' => $user_name,
            'password' => $password,
            'method' => 'pwg.session.login'
        ]);

        return $response ? $this->getStatus() : false;
    }

    public function getStatus(string $key = null)
    {
        if ($this->status == null) {
            $this->status = Http::get(['method' => 'pwg.session.getStatus',]);
        }

        return !empty($key) && isset($this->status->$key) ? $this->status->$key : $this->status;
    }

    public function logout()
    {
        return Http::get(['method' => 'pwg.session.logout',]);
    }
}