<?php
include('include/init.php');

$aid = isset($_GET['aid'])?$_GET['aid']:0;

$sql = "DELETE FROM wd_admin WHERE admin_id={$aid}";

$bool = mysql_query($sql);

if($bool && mysql_affected_rows()){

	header('Location:admin_list.php');

}else{

	alert('删除失败！');

}






?>