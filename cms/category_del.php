<?php
include('include/init.php');


//删除
//获取id 如果没有则不能删除
$caid = isset($_GET['caid'])?$_GET['caid']:0;

$sql = "DELETE FROM wd_case_category WHERE ca_id=$caid";

$bool = mysql_query($sql);

if($bool && mysql_affected_rows()){
	alert('已删除！','category_list.php');
}else{
	alert('删除失败！','category_del.php?caid='.$caid);
}





?>
