<?php

/**
 * 请求类
 * Created by lina.
 * User: admin
 * Date: 2017/8/2
 * Time: 13:24
 */
class Request
{
    /**
     * PHP发送Json对象数据, 发送HTTP请求
     *
     * @param string $url 请求地址
     * @param array $data 发送数据
     * * * * * * * * * * *如果需要传送json格式的数据，需要在调用方法之前json编码下data参数
     * @return String
     */
    function http_post_json($functionName, $url, $data) {
        $ch = curl_init ( $url );
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_HEADER, 0 );
        curl_setopt ( $ch, CURLOPT_FRESH_CONNECT, 1 );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_FORBID_REUSE, 1 );
        curl_setopt ( $ch, CURLOPT_TIMEOUT, 30 );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, array ('Content-Type: application/json; charset=utf-8', 'Content-Length: ' . strlen ( $data ) ) );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
        $ret = curl_exec ( $ch );
        echo $functionName . " : Request Info : url: " . $url . " ,send data: " . $data . "  \n";
        echo $functionName . " : Respnse Info : " . $ret . "  \n";
        curl_close ( $ch );
        return $ret;
    }
}