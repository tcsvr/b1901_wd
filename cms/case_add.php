<?php
include('include/init.php');


//
if($_POST){
  if($_POST['ca_id']=='0'){
    alert('请选择分类');
    // $disp = 'block';
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
        alert('请上传文件');
    }else{
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
        
    }
    //
    $sql = "INSERT INTO wd_case
    (`c_title`,`c_img`,`c_thumb`,`c_detail`,`c_isshow`,`ca_id`)
    VALUES
    ('{$c_title}','{$c_img}','{$c_thumb}','{$c_detail}','{$c_isshow}','{$ca_id}')";
    //
    $bool = mysql_query($sql);
    //
    if($bool && mysql_affected_rows()){
		header('Location:case_list.php?caid='.$caid);
	}else{
		alert('添加失败！','case_add.php');
	}







}








include('view/case_add.html');
?>