<?php

namespace App\Handlers;

use GuzzleHttp\Client;
use Overtrue\Pinyin\Pinyin;

class SlugTranslateHandler
{
    private $api, $appid, $key;

    public function __construct($text)
    {
        $this->text = $text;
        $this->api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
        $this->appid = config('services.baidu_translate.appid');
        $this->key = config('services.baidu_translate.key');
    }

    public function translate()
    {
        $http = new Client();

        if (empty($this->appid) || empty($this->key)) {
            return $this->pinyin();
        }

        $response = $http->get($this->httpBuildQuery());

        $result = json_decode($response->getBody(), true);

        if (!isset($result['trans_result'][0]['dst'])) {
            $this->pinyin();
        }

        return str_slug($result['trans_result'][0]['dst']);
    }

    public function pinyin()
    {
        return str_slug(app(Pinyin::class)->permalink($this->text));
    }

    public function httpBuildQuery()
    {
       $salt = time();

       $sign = md5($this->appid . $this->text . $salt . $this->key);

       $query = http_build_query([
           'q' => $this->text,
           'from' => 'zh',
           'to' => 'en',
           'appid' => $this->appid,
           'salt' => $salt,
           'sign' => $sign
       ]);

       return $this->api . $query;
    }
}