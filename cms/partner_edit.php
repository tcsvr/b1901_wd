<?php
include('include/init.php');

//提交前执行
$pid = isset($_GET['pid'])?$_GET['pid']:0;

$sql = "SELECT * FROM wd_partner WHERE p_id={$pid}";
$partner = getOne($sql);
// pre($partner);

$deleteImg = $partner['p_img'];
$deleteThumb = $partner['p_thumb'];




// pre($case);

//提交后执行
if($_POST){
    // pre($_POST);

    if(!isset($_POST['p_title']) || empty($_POST['p_title'])){
		alert('请填写标题');
	}
	if(!isset($_POST['p_link']) || empty($_POST['p_link'])){
		alert('请填写链接');
    }

    //简单的数据
    $p_title = $_POST['p_title'];
    $p_link = $_POST['p_link'];

    // pre($_POST);
    //文件上传
    if(!isset($_FILES['upload']['name']) || empty($_FILES['upload']['name'])){
        //没上传文件
        $sql = "UPDATE wd_partner SET `p_title`='{$p_title}' , `p_link`='{$p_link}' WHERE p_id='{$pid}'";


        
    }else{
        //如果原图片存在且大于0
        //删除原图片
        if(file_exists(_UPLOADS_.$deleteImg) && filesize(_UPLOADS_.$deleteImg) >0){
            unlink(_UPLOADS_.$deleteImg);
        }
        if(file_exists(_THUMBS_.$deleteThumb) && filesize(_THUMBS_.$deleteThumb) >0){
            unlink(_THUMBS_.$deleteThumb);
        }
        
        //上传操作
        $name = 'upload';
        $uri = _UPLOADS_;
        $images = upload($name,$uri);
        $p_img = $images['filename'];  //我们要的数据
        
        //生成缩略图
        $img = _UPLOAD_.$p_img;      //图片来源地址
        $info = getimagesize($img); //取得图像参数
        $son_w = $info[0];
        $son_h = $info[1];
        
        $son_width = 100;   //缩略图的宽
        $son_height = $son_h*$son_width/$son_w;  //缩略图的高
        $url = _THUMBS_;   //缩略图存放路径
        $thumpath = substr(strrchr($p_img, '/'),1); //缩略图的名称
        
        $p_thumb = thumb_img($img,$son_width,$son_height,$url,$thumpath); //我们要的数据 缩略图
        
      
        
        //
        $sql = "UPDATE wd_partner SET `p_img`='{$p_img}',`p_thumb`='{$p_thumb}',`p_title`='{$p_title}' WHERE p_id='{$pid}'";

        
    }
    $bool = mysql_query($sql);
    if($bool && mysql_affected_rows()){
        header('Location:partner_list.php');
    }else{
        alert('修改失败！','partner_edit.php?pid='.$pid);
    }
 
    


}





// pre($case);



include('view/partner_edit.html');
?>