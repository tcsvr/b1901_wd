<?php
include('include/init.php');


//删除
$nid = isset($_GET['nid'])?$_GET['nid']:0;

$sql = "SELECT `n_img`,`n_thumb` FROM wd_news WHERE n_id={$nid}";
$news = getOne($sql);

$deleteImg = $news['n_img'];
$deleteThumb = $news['n_thumb'];

//判断文件存在 且大于0
if(file_exists(_UPLOADS_.$deleteImg) && filesize(_UPLOADS_.$deleteImg) >0){
	unlink(_UPLOADS_.$deleteImg);
}
if(file_exists(_THUMBS_.$deleteThumb) && filesize(_THUMBS_.$deleteThumb) >0){
	unlink(_THUMBS_.$deleteThumb);
}



$sql = "DELETE FROM wd_news WHERE n_id={$nid}";
$bool = mysql_query($sql);



if($bool && mysql_affected_rows()){
	header('Location:news_list.php');
}else{
	alert('删除失败！','news_del.php?nid='.$nid);
}



?>