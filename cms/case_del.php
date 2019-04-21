<?php
include('include/init.php');


//删除
$cid = isset($_GET['cid'])?$_GET['cid']:0;

$sql = "SELECT `c_img`,`c_thumb` FROM wd_case WHERE c_id={$cid}";
$case = getOne($sql);

$deleteImg = $case['c_img'];
$deleteThumb = $case['c_thumb'];

//判断文件存在 且大于0
if(file_exists(_UPLOADS_.$deleteImg) && filesize(_UPLOADS_.$deleteImg) >0){
	unlink(_UPLOADS_.$deleteImg);
}
if(file_exists(_THUMBS_.$deleteThumb) && filesize(_THUMBS_.$deleteThumb) >0){
	unlink(_THUMBS_.$deleteThumb);
}



$sql = "DELETE FROM wd_case WHERE c_id={$cid}";
$bool = mysql_query($sql);



if($bool && mysql_affected_rows()){
	header('Location:case_list.php?caid='.$caid);
}else{
	alert('删除失败！','case_del.php?cid='.$cid);
}



?>