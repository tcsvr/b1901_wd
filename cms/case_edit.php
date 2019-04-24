<?php
include('include/init.php');

//提交前执行
$cid = isset($_GET['cid'])?$_GET['cid']:0;

$sql = "SELECT * FROM wd_case WHERE c_id={$cid}";
$case = getOne($sql);

$deleteImg = $case['c_img'];
$deleteThumb = $case['c_thumb'];





//提交后执行
if($_POST){
    // pre($_POST);
    if($_POST['ca_id']=='0'){
        alert('请选择分类');
      }
    if(!isset($_POST['c_title']) || empty($_POST['c_title'])){
		alert('请填写标题');
	}
	if(!isset($_POST['editorValue']) || empty($_POST['editorValue'])){
		alert('请填写详情');
    }
    //简单的数据
    $c_isshow = isset($_POST['c_isshow'])?$_POST['c_isshow']:0;
    $ca_id = $_POST['ca_id'];
    $c_title = $_POST['c_title'];
    $c_detail = $_POST['editorValue'];

    //文件上传
    if(!isset($_FILES['upload']['name']) || empty($_FILES['upload']['name'])){
        //没上传文件
        $sql = "UPDATE wd_case SET `c_title`='{$c_title}',`c_detail`='{$c_detail}',`c_isshow`={$c_isshow},`ca_id`={$ca_id} WHERE c_id={$cid}";
        
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
        $c_img = $images['filename'];  //我们要的数据
        
        //生成缩略图
        $img = _UPLOAD_.$c_img;      //图片来源地址
        $info = getimagesize($img); //取得图像参数
        $son_w = $info[0];
        $son_h = $info[1];
        
        $son_width = 80;   //缩略图的宽
        $son_height = $son_h*$son_width/$son_w;  //缩略图的高
        $url = _THUMBS_;   //缩略图存放路径
        $thumpath = substr(strrchr($c_img, '/'),1); //缩略图的名称
        
        $c_thumb = thumb_img($img,$son_width,$son_height,$url,$thumpath); //我们要的数据 缩略图
        
        $sql = "UPDATE wd_case SET `c_title`='{$c_title}',`c_img`='{$c_img}',`c_thumb`='{$c_thumb}',`c_detail`='{$c_detail}',`c_isshow`={$c_isshow},`ca_id`={$ca_id} WHERE c_id={$cid}";

        
    }
    $bool = mysql_query($sql);
    if($bool && mysql_affected_rows()){
        header('Location:case_list.php?caid='.$caid);
    }else{
        alert('修改失败！','case_edit.php?cid='.$cid);
    }
 
    


}




include('view/case_edit.html');
?>