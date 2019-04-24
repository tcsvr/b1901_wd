<?php
header('content-type:text/html; charset=utf-8');

session_start();
include('include/function.php');
include('include/config.php');

$con = mysql_connect($hostname,$dbusername,$dbpassword)or die('链接失败！');
//设置编码
mysql_set_charset($dbcharset);
//选择数据库
mysql_select_db($dbtable)or die('选择失败！');

if($_POST){
    if(!isset($_POST['username']) || empty($_POST['username'] )){
        alert('请输入账号');
    }

    if(!isset($_POST['password']) || empty($_POST['password'] )){
        alert('请输入密码');
    }

    if(strlen($_POST['username'])<4 || strlen($_POST['username'])>16){
        alert('账号长度为4-16位');
    }
    
    if(strlen($_POST['password'])<4 || strlen($_POST['password'])>16){
        alert('密码长度为4-16位');
    }
    $status = preg_match("/\W/",$_POST['username']);
    if($status){
        alert("用户名为 英文、数字 、下划线");
    }

    $username  = trim($_POST['username']);
    $password  = md5($_POST['password']);

    $sql = "SELECT * FROM wd_admin WHERE admin_username = '{$username}'";
    $userinfo = getOne($sql);
    if($userinfo){
        $verify = $userinfo['verify'];
        $pass = md5($password.$verify);
        if($pass == $userinfo['admin_password']){
            $_SESSION['islog'] = '1';
            $_SESSION['username'] = $username;
            $_SESSION['adminid'] = $userinfo['admin_id'];
            $time = time();
            $ip = $_SERVER['SERVER_ADDR'];
            $sql = "UPDATE wd_admin SET `lasttime`='$time' , `lastip`='$ip'";
            mysql_query($sql) ;
            alert('登陆成功','index.php');

        }else{
            alert('密码错误！');
        }
    }else{
        alert('账号不正确！');
    }

}
include('view/login.html')
?>