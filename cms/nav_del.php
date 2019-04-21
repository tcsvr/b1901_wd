<?php
include('include/init.php');


//删除
$nid = isset($_GET['nid'])?$_GET['nid']:0;

$sql = "DELETE FROM wd_nav WHERE n_id=$nid";
$bool = mysql_query($sql);


if($bool && mysql_affected_rows()){
	header('Location:nav_list.php');
}else{
	alert('删除失败！','nav_del.php?nid='.$nid);
}



?>