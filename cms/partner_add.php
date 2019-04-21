<?php
include('include/init.php');


//
if($_POST){

    if(!isset($_POST['p_title']) || empty($_POST['p_title'])){
		alert('请填写标题');
	}
	if(!isset($_POST['p_link']) || empty($_POST['p_link'])){
		alert('请填写链接');
    }

    //简单的数据
    $p_title = $_POST['p_title'];
    $p_link = $_POST['p_link'];

    //文件上传
    if(!isset($_FILES['upload']['name']) || empty($_FILES['upload']['name'])){
        alert('请上传文件');
    }else{
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

    }
    //
    $sql = "INSERT INTO wd_partner
    (`p_img`,`p_thumb`,`p_title`,`p_link`)
    VALUES
    ('{$p_img}','{$p_thumb}','{$p_title}','{$p_link}')";
    
    $bool = mysql_query($sql);
    // var_dump($bool);
    // exit;
    if($bool && mysql_affected_rows()){
        header('Location:partner_list.php');
	}else{

		alert('添加失败！','partner_add.php');
	}






}








include('view/partner_add.html');
?>