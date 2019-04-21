<?php

include('include/init.php');


$nid = isset($_GET['nid'])?$_GET['nid']:1;

$sql = "SELECT `n_title`,`n_detail` FROM wd_news WHERE n_id=$nid";

$new = getOne($sql);

// pre($new);


//上一个id
$sql = "SELECT n_id FROM wd_news WHERE n_id<$nid ORDER BY n_id DESC LIMIT 1";
$prev = getOne($sql);
// pre($prev);

//下一个id
$sql = "SELECT n_id FROM wd_news WHERE n_id>$nid ORDER BY n_id DESC LIMIT 1";
$next = getOne($sql);
// pre($next);







include('view/news.html');
?>