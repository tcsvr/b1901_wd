<?php

$hostname = 'localhost';        //主机名
$dbusername = 'root';           //数据库用户名
$dbpassword = 'root';           //数据库密码
$dbcharset = 'utf8';            //数据库编码
$dbtable =  'b1901_wendo';      //数据库名（要查询的数据库）



//配置路径 要用常量来配置 两种
// 1 拉  加载  远程协议  http://
//                     获得http                        获得域名
// $web = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];
// $web = rtrim($web,'/').'/';

define('_WEB_',rtrim($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'],'/').'/');

// CSS 
define('_CSS_',_WEB_.'css/');

// JS 
define('_JS_',_WEB_.'js/');

// img
define('_IMG_',_WEB_.'images/');

// umdeitor  编辑器 富文本
define('_UMEDITOR_',_WEB_.'cms/umeditor/');

// 原图片动态路径
define('_UPLOAD_',_WEB_.'uploads/');

// 缩略图图片动态路径
define('_THUMB_',_WEB_.'thumb/');



// 2  放  D://a/b/c
define('_ROOT_',rtrim($_SERVER['DOCUMENT_ROOT'],'/').'/');

define('_UPLOADS_',_ROOT_.'uploads/');//文件上传


define('_THUMBS_',_ROOT_.'thumb/');//缩略图

// echo _UPLOADS_;exit;
// pre($_SERVER['DOCUMENT_ROOT']);




?>