<?php
/**
 * Created by PhpStorm.
 * User: jewdore
 * Date: 2018/6/19
 * Time: 下午3:32
 */

namespace Jewdore\ErrorDing;


class DingTalk
{
    private $send_url = null;

    public function __construct($send_url)
    {
        $this->send_url = $send_url;
    }

    public function sendTextMessage($content, $ats = [], $is_at_all = false)
    {
        $msg = array(
            'msgtype' => 'text',
            'text' => array(
                'content' => $content
            ),
            'at' => array(
                'atMobiles' => $ats,
                'isAtAll' => $is_at_all ? true : false
            )
        );
        return $this->sendMessage($msg);

    }

    protected function sendMessage($post_string)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->send_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_string));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // 线下环境不用开启curl证书验证, 未调通情况可尝试添加该代码
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

}