<?php
header('content-type:text/html; charset=utf-8');


//包含函数库文件
include('include/function.php');
//包含配置文件
include('include/config.php');
include_once('include/page/page.php');


// 连接数据库
$con = mysql_connect($hostname,$dbusername,$dbpassword)or die('链接失败！');
//设置编码
mysql_set_charset($dbcharset);
//选择数据库
mysql_select_db($dbtable)or die('选择失败！');

//操作数据库
//导航
$sql = "SELECT * FROM wd_nav WHERE n_isshow=1";
$nav = getAll($sql);



//广告图
$sql = "SELECT * FROM wd_banner WHERE b_isshow=1";
$banner = getAll($sql);
// pre($banner);

//title
$naid = isset($_GET['naid'])?$_GET['naid']:1 ;

$sql = "SELECT * FROM wd_nav WHERE n_isshow=1 AND n_id={$naid} ";
$navcu = getOne($sql);


$caid = isset($_GET['caid']) ? $_GET['caid']:1;
$caid = intval($caid);   //确保是数字

$sql = "SELECT ca_id FROM wd_case_category WHERE ca_id={$caid}";  //搜索分类id

$status = getOne($sql);  
if(!$status){
    //alert('页面缺少数据','index.php');
    //php的重定向
    header('Location:index.php');
}
// echo $navcu['n_id'];
// exit;


?>