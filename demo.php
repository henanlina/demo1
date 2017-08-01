<?php
/**
 * Created by xjj.
 * User: admin
 * Date: 2017/8/1
 * Time: 16:27
 */

/**
 * call_user_func、call_user_func_array 都是直接调用自定义的函数，如果回调函数不存在，只会产生警告
 * 但不是阻断性的
 */
class classOne{
    static function FuncA($param){
        echo $param;
    }
}

function FuncB($param){
    echo $param;
}

/**
 * 利用数组直接调用对象中的方法
 */
call_user_func(['classOne','FuncA'],'以数组形式调用对象中的方法，不用创建对象<br>');

/**
 * 直接调用方法
 */
call_user_func('FuncB','直接调用方法<br>');

function FuncC($param1,$param2){
    echo $param1,'<br>',$param2;
}

/**
 * 以数组形式做为参数，传给回调函数
 */
call_user_func_array('FuncC',['参数1','参数2']);