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

if($_POST){
    // 判断是否为空 

    if(!empty($_POST['u_name']) && isset($_POST['u_name'])){
        $u_name = trim($_POST['u_name']);
        if($u_name!=$userinfo['u_name']){
            $sqln = "SELECT u_id FROM wd_user WHERE u_name = '{$u_name}'";
            $reu_name = getOne($sqln);
            // var_dump($reusername);exit;
            if($reu_name){
                alert('用户名已存在');
            }
        
            $status = preg_match("/\W+/",$u_name,$match);
            if($status){
                echo '请输入的英文、数字、下划线';
            }else{
                if(strlen($u_name)<4 || strlen($u_name)>16){
                    echo '请输入4—16位的用户名';
                }
            }
        }
    } 

    $u_real = isset($_POST['u_real'])?$_POST['u_real']:'';
    $u_sex = isset($_POST['u_sex'])?$_POST['u_sex']:'';
    $u_phone = isset($_POST['u_phone'])?$_POST['u_phone']:'';
    $u_email = isset($_POST['u_email'])?$_POST['u_email']:'';
    $u_birthday = isset($_POST['u_birthday'])?$_POST['u_birthday']:'';

    $sql = "UPDATE wd_user SET  `u_name`= '{$u_name}',`u_sex`= '{$u_sex}',`u_real`= '{$u_real}',`u_phone`= '{$u_phone}', `u_email`='{$u_email}', `u_birthday`='{$u_birthday}' WHERE  u_id = '{$uid}' ";

    $bool = mysql_query($sql);
    // var_dump($bool);exit;
	if($bool && mysql_affected_rows()){
        alert('修改成功','user_info.php');
	}else{
        alert('请修改','change_message.php');
    }
    
	
}











include('view/change_message.html');
?>