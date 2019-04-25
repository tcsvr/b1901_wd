<?php
include('include/init.php');

//删除
$mid = isset($_GET['mid'])?$_GET['mid']:0;

$sql = "DELETE FROM wd_message WHERE m_id=$mid";
$bool = mysql_query($sql);


if($bool && mysql_affected_rows()){
	header('Location:message.php');
}else{
	alert('删除失败！');
}














?>