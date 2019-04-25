<?php
include('include/init.php');


$sql = "SELECT * FROM wd_article WHERE a_id=2";
$contact = getOne($sql);

$uid = $_COOKIE['uid'];
$sql = "SELECT * FROM wd_user WHERE u_id = '{$uid}'";
$userinfo = getOne($sql);

if($_POST){
    // pre($_POST);
    if(!isset($_POST['content']) || empty($_POST['content'])){
        
        alert('留言不能为空');

    }else{
        if($userinfo){
            
            $content = trim($_POST['content']);
            $phone = isset($_POST['m_phone'])?$_POST['m_phone']:'';
            $email = isset($_POST['m_email'])?$_POST['m_email']:'';
            $name = isset($_POST['m_name'])?$_POST['m_name']:'';
            $time = time();
            $sql = "INSERT INTO wd_message  (`m_content`,`m_phone`,`m_email`,`m_time`,`u_id`,`m_name`)
             VALUE 
             ('{$content}','{$phone}','{$email}','{$time}','{$uid}','{$name}')";
            $bool = mysql_query($sql);
            if($bool && mysql_affected_rows()){
                alert('留言成功');
            }else{
                alert('留言失败，请重新填写....');
            }
            
        }else{

            $content = $_POST['content'];
            $email = isset($_POST['email'])?$_POST['email']:'';
            $phone = isset($_POST['phone'])?$_POST['phone']:'';
            $phone = isset($_POST['phone'])?$_POST['phone']:'';
            $time = time();
            $sql = "INSERT INTO wd_message  (`m_content`,`m_phone`,`m_email`,`m_time`,`m_name`) 
            VALUE 
            ('{$content}','{$phone}','{$email}','{$time}','{$name}')";
              $bool = mysql_query($sql);
             if($bool && mysql_affected_rows()){
                alert('留言成功');
            }else{
                alert('留言失败，请重新填写');
            }

        }

    }
}

// pre($contact);exit;
// echo $contact['a_content'];exit;







include('view/contact.html');
?>