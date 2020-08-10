<?php
/**
 * Created by PhpStorm.
 * User: pe
 * Date: 2020/8/5
 * Time: 12:22
 */

namespace aston_creator\piwigo_sdk_php;

class Client
{
    public function __construct(string $domain, string $user_name, string $password)
    {
        Config::setDomain(trim($domain));
        try {
            if ($this->session->login(trim($user_name), trim($password)) === false) {
                throw new \Exception('login error');
            }
        } catch (\Exception $exp) {
            throw new \Exception($exp->getMessage());
        }
    }

    public function __get($name)
    {
        return ClassFactory::getClass($name);
    }

    public function getInfos()
    {
        return Http::get(['method' => 'pwg.getInfos']);
    }

    public function getMissingDerivatives()
    {

    }

    public function getVersion()
    {
        return Http::get(['method' => 'pwg.getVersion']);
    }
}