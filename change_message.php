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
// pre($userinfo);

// $p_img = 


if($_POST){

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


        if(!isset($_FILES['upload']['name']) || empty($_FILES['upload']['name'])){

            $sql = "UPDATE wd_user SET  `u_name`= '{$u_name}',`u_sex`= '{$u_sex}',
            `u_real`= '{$u_real}',`u_phone`= '{$u_phone}', `u_email`='{$u_email}', 
            `u_birthday`='{$u_birthday}' 
            WHERE  u_id = '{$uid}' ";

            
        
        
        }else {  //上传操作
        $name = 'upload';
        $uri = _UPLOADS_;
        $images = upload($name,$uri);
        $p_img = $images['filename'];  //我们要的数据
    
        // pre($p_img);
        //生成缩略图
        $img = _UPLOAD_.$p_img;      //图片来源地址
        $info = getimagesize($img); //取得图像参数
        $son_w = $info[0];
        $son_h = $info[1];
        
        $son_width = 57;   //缩略图的宽
        $son_height =57; //$son_h*$son_width/$son_w;  //缩略图的高
        $url = _THUMBS_;   //缩略图存放路径
        $thumpath = substr(strrchr($p_img, '/'),1); //缩略图的名称
        
        $p_thumb = thumb_img($img,$son_width,$son_height,$url,$thumpath); //我们要的数据 缩略图

        $sql = "UPDATE wd_user SET  `u_name`= '{$u_name}',`u_sex`= '{$u_sex}',
        `u_real`= '{$u_real}',`u_phone`= '{$u_phone}', `u_email`='{$u_email}', 
        `u_birthday`='{$u_birthday}' ,`u_photo1`='{$p_img}' ,`u_photo2`='{$p_thumb}' 
        WHERE  u_id = '{$uid}' ";


    
        
     }
    
     $bool = mysql_query($sql);
     // var_dump($bool);exit;
     if($bool && mysql_affected_rows()){
         header('Location:change_message.php');
         // alert('修改成功','change_message.php');
     }else{
         alert('请修改','change_message.php');
     }
     
	
}



include('view/change_message.html');
?>