<?php
include('include/init.php');

if($_POST){
    // 判断是否为空
    if(!isset($_POST['admin_username']) || empty($_POST['admin_username']) ){
        alert('请填写用户名');
    }

    if(!isset($_POST['password']) || empty($_POST['password']) ){
        alert('请填写用户名');
    }
    // 判断长度
    if(strlen($_POST['admin_username'])<4 || strlen($_POST['admin_username'])>16 ){
        alert('用户名长度为4-16位');
    }
    if(strlen($_POST['password'])<4 || strlen($_POST['password'])>16 ){
        alert('用户名长度为4-16位');
    }
    // 判断特殊字符。。
    $status = preg_match("/\W+/",$_POST['admin_username']);
    if($status){
        alert('用户名有英文字母、数字、下划线组成');
    }
	// 判断密码是否一致
	if($_POST['password']!=$_POST['repassword']){
		alert('密码不一致');
	}
	// 判断用户是否已存在
	// 获取数据
	$username = trim($_POST['admin_username']);
	$real = isset($_POST['real'])?$_POST['real']:'';
	$sql = "SELECT * FROM wd_admin WHERE admin_username='{$username}'";
	$ex = getOne($sql);
	if($ex){
		alert('账号已存在');
	}
	$pass = md5($_POST['password']);
	$verify = md5(rand(10000,99999));
	$password = md5($pass.$verify);

	$sql = "INSERT INTO wd_admin (`admin_username`,`admin_real`,`admin_password`,`verify`) VALUES 
    ('{$username}','{$real}','{$password}','{$verify}')";
    $bool = mysql_query($sql);
    // var_dump($bool);exit;
	if($bool && mysql_affected_rows()){
		// alert('');
		header('location:admin_list.php');
	}
	
}


















include('view/admin_add.html');

?>