<?php
include('include/init.php');


$pid = isset($_GET['pid'])?$_GET['pid']:0;

$sql = "SELECT `p_img`,`p_thumb` FROM wd_partner WHERE p_id={$pid}";
$partner = getOne($sql);

$deleteImg = $partner['p_img'];
$deleteThumb = $partner['p_thumb'];

//判断文件存在 且大于0
if(file_exists(_UPLOADS_.$deleteImg) && filesize(_UPLOADS_.$deleteImg) >0){
	unlink(_UPLOADS_.$deleteImg);
}
if(file_exists(_THUMBS_.$deleteThumb) && filesize(_THUMBS_.$deleteThumb) >0){
	unlink(_THUMBS_.$deleteThumb);
}



$sql = "DELETE FROM wd_partner WHERE p_id={$pid}";
$bool = mysql_query($sql);



if($bool && mysql_affected_rows()){
	header('Location:partner_list.php');
}else{
	alert('删除失败！','partner_del.php');
}



?>