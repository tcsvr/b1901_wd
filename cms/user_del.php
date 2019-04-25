<?php
include('include/init.php');

//删除
$uid = isset($_GET['uid'])?$_GET['uid']:0;

$sql = "DELETE FROM wd_user WHERE u_id=$uid";
$bool = mysql_query($sql);


if($bool && mysql_affected_rows()){
	header('Location:user.php');
}else{
	alert('删除失败！');
}














?>