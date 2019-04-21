<?php
include('include/init.php');


//
if($_POST){

    //简单的数据
    $b_isshow = isset($_POST['b_isshow'])?$_POST['b_isshow']:0;


    //文件上传
    if(!isset($_FILES['upload']['name']) || empty($_FILES['upload']['name'])){
        alert('请上传文件');
    }else{
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
        
    }
    //
    $sql = "INSERT INTO wd_banner
    (`b_img`,`b_thumb`,`b_isshow`)
    VALUES
    ('{$b_img}','{$b_thumb}','{$b_isshow}')";
    //
    $bool = mysql_query($sql);
    //
    if($bool && mysql_affected_rows()){
		header('Location:banner_list.php');
	}else{

    // exit;
		alert('添加失败！','banner_add.php');
	}






}








include('view/banner_add.html');
?>