<?php
return array(
	//'配置项'=>'配置值'
    'STATIC_URL' =>'http://www.demo.com',
    //设置允许访问的模块
    'MODULE_ALLOW_LIST' => ['Home','Admin'],
    //设置默认模块
    'DEFAULT_MODULE' => 'Home',
    //自定义错误模板
    'TMPL_ACTION_ERROR' =>'./Public/error.html',
    //自定义成功模板
    'TMPL_ACTION_SUCCESS' =>'./Public/success.html',
);