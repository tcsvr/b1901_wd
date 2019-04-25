<?php
// include('include/init.php');
// 连接数据库
$con = mysql_connect('localhost','root','root')or die('链接失败！');
//设置编码
mysql_set_charset('utf8');
//选择数据库
mysql_select_db('b1901_wendo')or die('选择失败！');

$uid = $uid = $_COOKIE['uid'];

$time = time();

$sql = "UPDATE wd_user SET `lasttime`='{$time}' WHERE u_id='{$uid}'";

$bool = mysql_query($sql);

setcookie('islog','',time()-10);
setcookie('username','',time()-10);
setcookie('uid','',time()-10);


header('location:index.php');
?>