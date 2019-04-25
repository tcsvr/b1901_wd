<?php
include('include/init.php');

$islog = isset($_COOKIE['islog'])?$_COOKIE['islog']:'';
if(!$islog){
	echo '请先登录';
	header('location:login.php');
}else{
    $uid = $_COOKIE['uid'];
    $sql = "SELECT * FROM wd_user WHERE u_id = '{$uid}'";
    $userinfo = getOne($sql);
}
$isshow = "none";
$tip ='';
if($_POST){
    $isshow = "1";
    if(!isset($_POST['password']) || empty($_POST['password'])){
        //密码有误，请重新验证
    
        $tip = '原密码不能为空，请输入';
        // alert($tip);
    
    }else{
    
        $pass = md5($_POST['password']);
        
        if($userinfo['u_password']!=$pass){
    
           $tip = '原密码有误，请重新验证';
        //    alert($tip);
    
        }


        if(!isset($_POST['changepassword']) || empty($_POST['changepassword']) ){
            $tip ='请填写修改密码';
        }

        if(!isset($_POST['rechangepassword']) || empty($_POST['rechangepassword']) ){
            $tip ='请填写确认修改的密码';
        }

        // 判断长度
        if(strlen($_POST['changepassword'])<4 || strlen($_POST['changepassword'])>16 ){
            $tip ='密码长度为4-16位';
        }
        if(strlen($_POST['rechangepassword'])<4 || strlen($_POST['rechangepassword'])>16 ){
            $tip ='密码长度为4-16位';
        }

        if($_POST['changepassword'] != $_POST['rechangepassword']){
            $tip ='修改密码和确认密码不一致';
        }
    } 
    if($_POST['changepassword'] == $_POST['password']){
        $tip ='原密码和修改密码一致，请重新修改';
    }
    $changepassword = md5($_POST['changepassword']);

    $sql = "UPDATE wd_user SET  `u_password`= '{$changepassword}'  WHERE  u_id = '{$uid}'";

    $bool = mysql_query($sql);
    // var_dump(mysql_affected_rows());exit;
    if($bool && mysql_affected_rows()){
        alert('修改成功，请重新登录','login.php');
    }else{
        $tip = '原密码有误';
    }















}










include('view/change_password.html');
?>