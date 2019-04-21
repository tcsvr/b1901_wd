<?php
include('include/init.php');



//服务项目
$sql = "SELECT * FROM wd_service ORDER BY s_id ASC";
$service = getAll($sql);

//将php数组转换为js数组
$imgArr1 = "[";
$imgArr2 = "[";
foreach($service as $v){
    $imgArr1 .= "'".$v['s_img1']."',";
    $imgArr2 .= "'".$v['s_img2']."',";
}
$imgArr1 = rtrim($imgArr1,',');
$imgArr2 = rtrim($imgArr2,',');
$imgArr1 .= "]";
$imgArr2 .= "]";


// pre($imgArr1);


//案例分类
$sql = "SELECT * FROM wd_case_category";
$category = getAll($sql);


//获取案例分类id
$caid = isset($_GET['caid']) ? $_GET['caid']:1;
$caid = intval($caid);   //确保是数字

$sql = "SELECT ca_id FROM wd_case_category WHERE ca_id={$caid}";  //搜索分类id

$status = getOne($sql);         

if(!$status){
    //alert('页面缺少数据','index.php');
    //php的重定向
    header('Location:index.php');
}


//案例列表
$sql = "SELECT `c_id`,`c_title`,`c_img`,`ca_id` FROM wd_case WHERE ca_id={$caid} AND c_isshow=1 ORDER BY c_id DESC LIMIT 7";
$case = getAll($sql);


//关于我们
$sql = "SELECT * FROM wd_article WHERE a_id=1";
$about = getOne($sql);
$about = $about['a_content'];

// echo $abuot;exit;
$about = preg_replace("/<[^<>]+>/",'', $about); //过滤标签

// $about = mb_substr($abuot,0,78,'utf-8');


//最新资讯
$sql = "SELECT `n_id`,`n_title`,`n_detail`,`n_time` FROM wd_news ORDER BY n_id DESC LIMIT 4";
$news = getAll($sql);



//合作伙伴
$sql = "SELECT * FROM wd_partner";
$partner = getAll($sql);

// pre($partner);

// $get = get_url();

// echo $get;
// exit;


$get = get_url();

$get = str_replace('index.php','case.php',$get);

// echo $get;
// exit;


include('view/index.html');
?>