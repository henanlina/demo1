<?php

/**
 * array_walk_recursive($array,$method)
 * 数组$array 中的每个元素都执行一次method方法
 * 想到的一个用处：批量过滤接口数据
 * 比较有用的
 */

function myfunction($value,$key)
{
    echo "键 $key 的值是 $value 。<br>";
}
$a1=array("a"=>"red","b"=>"green");
$a2=array($a1,"1"=>"blue","2"=>"yellow");
array_walk_recursive($a2,"myfunction");
/* 输出内容：
 *  键 a 的值是 red 。
    键 b 的值是 green 。
    键 1 的值是 blue 。
    键 2 的值是 yellow 。
 */

