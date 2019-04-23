<?php
include('include/init.php');
$aid = isset($_GET['aid'])?$_GET['aid']:0;
$sql = "SELECT * FROM wd_admin WHERE admin_id = '{$aid}'";
$admin = getOne($sql);
// pre($admin);

if($_POST){
    // 判断是否为空

    if(!empty($_POST['password']) && isset($_POST['password'])){
        $pass = md5($_POST['password']);
        $verify = md5(rand(10000,99999));
        $password = md5($pass.$verify);
    
        if($admin!=$password){

            alert('现在的密码不正确');

        }

        if(!isset($_POST['changepassword']) || empty($_POST['changepassword']) ){
            alert('请填写修改密码');
        }

        if(!isset($_POST['rechangepassword']) || empty($_POST['rechangepassword']) ){
            alert('请填写确认修改的密码');
        }

        // 判断长度
        if(strlen($_POST['changepassword'])<4 || strlen($_POST['changepassword'])>16 ){
            alert('密码长度为4-16位');
        }
        if(strlen($_POST['rechangepassword'])<4 || strlen($_POST['rechangepassword'])>16 ){
            alert('密码长度为4-16位');
        }
        if($_POST['changepassword'] != $_POST['rechangepassword']){
            alert('修改密码和确认密码不一致');
        }
    } 

    $real = isset($_POST['admin_real'])?$_POST['admin_real']:'';

    if(isset($_POST['changepassword'])){
        echo 32321;
        $pass = md5($_POST['changepassword']);
        $verify = md5(rand(10000,99999));
        $changepassword = md5($pass.$verify);
        $sql = "UPDATE wd_admin SET  `admin_real`= '{$real}',`admin_password`= '{$changepassword}', `verify`='{$verify}' ";
    }else{
        $sql = "UPDATE wd_admin SET  `admin_real`= '{$real}' ";
    }

    
    pre($sql);
    $bool = mysql_query($sql);
    var_dump($bool);exit;
	if($bool && mysql_affected_rows()){
		// alert('');
		header('location:admin_list.php');
	}else{
        alert('请修改','admin_edit.php?aid='.$aid);
    }
    
	
}

















include('view/admin_edit.html');

?>