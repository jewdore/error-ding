<?php
/**
 * Created by PhpStorm.
 * User: jewdore
 * Date: 2018/6/19
 * Time: 下午3:32
 */

namespace Jewdore\ErrorDing;


use Illuminate\Support\Facades\Log;

class Popup
{
    private $send_url = null;

    public function __construct($send_url)
    {
        $this->send_url = $send_url;
    }

    public function sendTextMessage($message)
    {
        return $this->sendMessage($message);

    }

    protected function sendMessage($post)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->send_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json;'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // 线下环境不用开启curl证书验证, 未调通情况可尝试添加该代码
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        $data = curl_exec($ch);
        Log::info("发送结果：".json_encode($data));
        curl_close($ch);
        return $data;
    }

}