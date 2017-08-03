<?php
/**
 * Created by xjj.
 * User: admin
 * Date: 2017/8/2
 * Time: 15:16
 */

function url($data){
    //http_build_query 将给出的数据、对象、字符串转换成url_encode之后的字符串
    return C('STATIC_URL').'?'.http_build_query($data);
}