<?php
include('include/init.php');

//案例分类
$sql = "SELECT * FROM wd_case_category";
$category = getAll($sql);


//获取案例分类id
$caid = isset($_GET['caid']) ? $_GET['caid']:1;
$caid = intval($caid);   //确保是数字

$sql = "SELECT * FROM wd_case_category WHERE ca_id={$caid}";  //搜索分类id

$status = getOne($sql);     


if(!$status){
    //alert('页面缺少数据','index.php');
    //php的重定向
    header('Location:case_list.php');
}


//获取数据总条数
$sql = "SELECT count(c_id) AS count FROM wd_case WHERE ca_id={$caid} AND c_isshow=1";
$count = getOne($sql);
$count = $count['count'];


//控制条数 控制页码
$current = isset($_GET['page']) ? $_GET['page'] : 1;
$limit= 8;
$start = ($current - 1) * $limit;
$size = 3;


//案例列表
$sql = "SELECT `c_id`,`c_title`,`c_img`,`ca_id` FROM wd_case WHERE ca_id={$caid} AND c_isshow=1 ORDER BY c_id DESC LIMIT {$start},{$limit}";
$case = getAll($sql);


// 分页
$page = page($current,$count,$limit,$size,$class='meneame');

// pre($case);






include('view/case_list.html');
?>