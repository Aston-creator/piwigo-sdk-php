<?php
/**
 * Created by PhpStorm.
 * User: pe
 * Date: 2020/8/7
 * Time: 11:53
 */

namespace aston_creator\piwigo_sdk_php;


class Http
{
    private static $client;
    private static $cookie;


    public static function client()
    {
        if (self::$client == null) {
            self::$client = new \GuzzleHttp\Client();
        }
        return self::$client;
    }

    public static function getCookieJar()
    {
        if (self::$cookie == null) {
            self::$cookie = new \GuzzleHttp\Cookie\CookieJar();
        }
        return self::$cookie;
    }

    public static function get(array $param = array())
    {
        $param = array_merge($param, ['format' => 'json']);
        $uri = Config::getDomain() . '/ws.php?' . http_build_query($param);
        return self::request('get', $uri);
    }

    public static function post(array $param = array())
    {
        $uri = Config::getDomain() . '/ws.php?format=json';
        $param = ['form_params' => $param];
        return self::request('post', $uri, $param);
    }

    private static function request($method, $uri, $param = array())
    {
        $param = array_merge($param, ['cookies' => self::getCookieJar()]);
        $result = (string)self::client()->request($method, $uri, $param)->getBody();
        $response = json_decode($result);
        if (isset($response->stat) && $response->stat == 'ok') {
            return $response->result;
        } else {
            throw new \Exception($result);
        }
    }
}