<?php
include('include/init.php');

if($_POST){
    // pre($_POST);
    if(!isset($_POST['username']) || empty($_POST['username'])){
        echo '请输入用户名';exit;
    }
    //用户名要验证和清除左右空格
    $username = trim($_POST['username']);
    $sqln = "SELECT u_id FROM wd_user WHERE u_name = '{$username}'";
    $reusername = getOne($sqln);
    // var_dump($reusername);exit;
    if($reusername){
        alert('用户名已存在');
    }

    $status = preg_match("/\W+/",$username,$match);
    if($status){
        echo '请输入的英文、数字、下划线';
    }else{
        if(strlen($username)<4 || strlen($username)>16){
            echo '请输入4—16位的用户名';
        }
    }
    
    //密码和确认对比
    if($_POST['pass'] != $_POST['repass']){
        echo '密码不一致';exit;
    }

    if(!isset($_POST['pass']) || empty($_POST['pass'])){
        echo '请输入密码';exit;
    }
    if(strlen($_POST['pass'])<4 || strlen($_POST['pass'])>16){
        echo '请输入4—16位的密码';exit;
    }else{
        $pass = md5($_POST['pass']);
    }
    $sql = "INSERT INTO wd_user (`u_name`,`u_password`) VALUES ('{$username}','{$pass}')";

    $bool = mysql_query($sql);
    if(!$bool && mysql_affected_rows()){
    echo '注册失败';exit;
    }else{

        $sql = "SELECT * FROM wd_user WHERE u_name = '{$username}'";
        $userinfo = getOne($sql);
        // pre($userinfo);

        setcookie('islog','1');
        // 存用户名
        setcookie('username',$userinfo['u_name']);
        // 存用户ID
        setcookie('uid',$userinfo['u_id']);

        header('Location:user_info.php');
    }


}






include('view/register.html');
?>