<?php
include('include/init.php');

//
$caid = isset($_GET['caid'])?$_GET['caid']:1;
$cid = isset($_GET['cid'])?$_GET['cid']:1 ;


$caid = isset($_GET['caid']) ? $_GET['caid']:1;
$caid = intval($caid);   //确保是数字

$sql = "SELECT * FROM wd_case_category WHERE ca_id={$caid}";  //搜索分类id

$statusc = getOne($sql);     

// pre($statusc);
if(!$statusc){
    //alert('页面缺少数据','index.php');
    //php的重定向
    header('Location:case_list.php');
}


$cid = intval($cid);   //确保是数字

$sql = "SELECT * FROM wd_case WHERE c_id={$cid}";  //搜索id

$status = getOne($sql);     

if(!$status){
    //alert('页面缺少数据','index.php');
    //php的重定向
    header('Location:case_list.php');
}



$sql = "SELECT * FROM wd_case WHERE ca_id=$caid AND c_id=$cid";
$case = getOne($sql);

// pre($case);


//上一个id
$sql = "SELECT `c_id`,`ca_id` FROM wd_case WHERE ca_id=$caid AND c_id<$cid ORDER BY c_id DESC LIMIT 1";
$prev = getOne($sql);
// pre($prev);

//下一个id
$sql = "SELECT c_id,`ca_id` FROM wd_case WHERE ca_id=$caid AND c_id>$cid ORDER BY c_id DESC LIMIT 1";
$next = getOne($sql);
// pre($next);







include('view/case.html');
?>