<?php
include('include/init.php');
session_start();
if($_POST){
    // 判断是否为空
	if(!isset($_POST['username']) || empty($_POST['username'])){
		alert('请输入用户名');
	}
    
	// 用户名：
	// 密码
    if(!isset($_POST['pass']) || empty($_POST['pass'])){
        alert('请输入密码');
    }
	if(!isset($_POST['code']) || empty($_POST['code'])){
		alert('请输入验证码！');
	}
	// 获取数据
	$code = $_POST['code'];
	$cookiecode = $_SESSION['code'];

	if($code!=$cookiecode){
		alert('请输入正确的验证码！');
	}else{
		// 获取数据
		$user = trim($_POST['username']);
		$pass = md5($_POST['pass']);
		// 判断有没有注册：
		$sql = "SELECT * FROM wd_user WHERE `u_name`='{$user}' AND `u_password`='{$pass}'";
		$userinfo = getOne($sql);
		if($userinfo){
			// 登录成功
			echo '登录成功';
			// 存登录状态
			setcookie('islog','1');
			// 存用户名
			setcookie('username',$userinfo['u_name']);
			// 存用户ID
			setcookie('uid',$userinfo['u_id']);
			header('Location:index.php');
		}else{
			alert('用户名或密码错误');
		}

	}

}




include('view/login.html');
?>