<?php
include('include/init.php');

//提交前执行
$bid = isset($_GET['bid'])?$_GET['bid']:0;

$sql = "SELECT * FROM wd_banner WHERE b_id={$bid}";
$banner = getOne($sql);

// pre($banner);
// [b_id] => 7
//     [b_img] => 2019/04/155583566412738.jpg
//     [b_thumb] => 2019-04/21/155583566412738.jpg
//     [b_isshow] => 1
// pre($banner['b_img']);
$deleteImg = $banner['b_img'];
$deleteThumb = $banner['b_thumb'];




// pre($case);

//提交后执行
if($_POST){
    // pre($_POST);
    //简单的数据
    $b_isshow = isset($_POST['b_isshow'])?$_POST['b_isshow']:0;

    // pre($_POST);
    //文件上传
    if(!isset($_FILES['upload']['name']) || empty($_FILES['upload']['name'])){
        //没上传文件
        $sql = "UPDATE wd_banner SET `b_isshow`={$b_isshow} WHERE b_id={$bid}";
        
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
        $b_img = $images['filename'];  //我们要的数据
        
        //生成缩略图
        $img = _UPLOAD_.$b_img;      //图片来源地址
        $info = getimagesize($img); //取得图像参数
        $son_w = $info[0];
        $son_h = $info[1];
        
        $son_width = 100;   //缩略图的宽
        $son_height = $son_h*$son_width/$son_w;  //缩略图的高
        $url = _THUMBS_;   //缩略图存放路径
        $thumpath = substr(strrchr($b_img, '/'),1); //缩略图的名称
        
        $b_thumb = thumb_img($img,$son_width,$son_height,$url,$thumpath); //我们要的数据 缩略图
        
        //
        $sql = "UPDATE wd_banner SET `b_img`='{$b_img}',`b_thumb`='{$b_thumb}' , `b_isshow`={$b_isshow} WHERE b_id={$bid}";

        
    }
    $bool = mysql_query($sql);
    if($bool && mysql_affected_rows()){
        header('Location:banner_list.php');
    }else{
        alert('修改失败！','banner_edit.php?bid='.$bid);
    }
 
    


}





// pre($case);



include('view/banner_edit.html');
?>