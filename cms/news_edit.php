<?php
include('include/init.php');

//提交前执行
$nid = isset($_GET['nid'])?$_GET['nid']:0;

$sql = "SELECT * FROM wd_news WHERE n_id='{$nid}'";
$news = getOne($sql);
// pre($news);
$deleteImg = $news['n_img'];
$deleteThumb = $news['n_thumb'];




// pre($news);

//提交后执行
if($_POST){
    // pre($_POST);
    if(!isset($_POST['n_title']) || empty($_POST['n_title'])){
		alert('请填写标题');
	}
	if(!isset($_POST['editorValue']) || empty($_POST['editorValue'])){
		alert('请填写详情');
    }
    //简单的数据
    $n_title = $_POST['n_title'];
    $n_time = $_POST['n_time'];
    $n_detail = $_POST['editorValue'];

    // pre($_POST);
    //文件上传
    if(!isset($_FILES['upload']['name']) || empty($_FILES['upload']['name'])){
        //没上传文件
        $sql = "UPDATE wd_news SET `n_title`='{$n_title}',`n_detail`='{$n_detail}',`n_time`={$n_time} WHERE n_id={$nid}";
        
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
        $n_img = $images['filename'];  //我们要的数据
        
        //生成缩略图
        $img = _UPLOAD_.$n_img;      //图片来源地址
        $info = getimagesize($img); //取得图像参数
        $son_w = $info[0];
        $son_h = $info[1];
        
        $son_width = 80;   //缩略图的宽
        $son_height = $son_h*$son_width/$son_w;  //缩略图的高
        $url = _THUMBS_;   //缩略图存放路径
        $thumpath = substr(strrchr($n_img, '/'),1); //缩略图的名称
        
        $n_thumb = thumb_img($img,$son_width,$son_height,$url,$thumpath); //我们要的数据 缩略图
        
        //
        $sql = "UPDATE wd_news SET `n_title`='{$n_title}',`n_img`='{$n_img}',`n_thumb`='{$n_thumb}',`n_detail`='{$n_detail}',`n_time`='{$n_time}' WHERE n_id='{$nid}'";

        
    }
    $bool = mysql_query($sql);
    if($bool && mysql_affected_rows()){
        header('Location:news_list.php');
    }else{
        alert('修改失败！','news_edit.php?nid='.$nid);
    }
 
    


}





// pre($news);



include('view/news_edit.html');
?>