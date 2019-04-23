<?php
include('include/init.php');

$islog = isset($_COOKIE['islog'])?$_COOKIE['islog']:'';
if(!$islog){
	echo '请先登录';
	header('location:login.php');
}else{
    // pre($_COOKIE);
    $uid = $_COOKIE['uid'];
    // pre($uid);
    $sql = "SELECT * FROM wd_user WHERE u_id = '{$uid}'";
    $userinfo = getOne($sql);
    // pre($userinfo);
}




include('view/user_info.html');
?>