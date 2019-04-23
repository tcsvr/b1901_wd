<?php
include('include/init.php');

$time = time();

$adminid = $_SESSION['adminid'];
$sql = "SELECT * FROM wd_admin WHERE admin_id = '{$adminid}'";

$userinfo = getOne($sql);

$userinfo['os'] = PHP_OS;

$userinfo['pv'] = PHP_VERSION;

$userinfo['mv'] = mysql_get_server_info();


// pre($userinfo);



include('view/index.html');
?>