<?php

$mobile = $_GET['mobile'];
$content = $_GET['content'];
$url = 'http://10.10.32.2:8080/service/data/ws/rest/message/checkAndSend';
$post_data = array(
    'content'=>'【卡卡贷】'.$content,
    'productType'=>'kkd',
    'mobile'=>$mobile
);

$res = http_post_json($url,json_encode($post_data));
/**
 * PHP发送Json对象数据, 发送HTTP请求
 *
 * @param string $url 请求地址
 * @param array $data 发送数据
 * @return String
 */
function http_post_json($url, $data) {
    $ch = curl_init ( $url );
    curl_setopt ( $ch, CURLOPT_POST, 1 );
    curl_setopt ( $ch, CURLOPT_HEADER, 0 );
    curl_setopt ( $ch, CURLOPT_FRESH_CONNECT, 1 );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt ( $ch, CURLOPT_FORBID_REUSE, 1 );
    curl_setopt ( $ch, CURLOPT_TIMEOUT, 30 );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, array ('Content-Type: application/json; charset=utf-8', 'Content-Length: ' . strlen ($data) ) );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
    $ret = curl_exec ( $ch );
    echo  "Request Info : url: " . $url . " ,send data: " . $data . "  \n";
    echo  "Respnse Info : " . $ret . "  \n";
    curl_close ( $ch );
    return $ret;
}

