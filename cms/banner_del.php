<?php
include('include/init.php');


$bid = isset($_GET['bid'])?$_GET['bid']:0;

$sql = "SELECT `b_img`,`b_thumb` FROM wd_banner WHERE b_id={$bid}";
$banner = getOne($sql);

$deleteImg = $banner['b_img'];
$deleteThumb = $banner['b_thumb'];

//判断文件存在 且大于0
if(file_exists(_UPLOADS_.$deleteImg) && filesize(_UPLOADS_.$deleteImg) >0){
	unlink(_UPLOADS_.$deleteImg);
}
if(file_exists(_THUMBS_.$deleteThumb) && filesize(_THUMBS_.$deleteThumb) >0){
	unlink(_THUMBS_.$deleteThumb);
}



$sql = "DELETE FROM wd_banner WHERE b_id={$bid}";
$bool = mysql_query($sql);



if($bool && mysql_affected_rows()){
	header('Location:banner_list.php');
}else{
	alert('删除失败!');
}



?>