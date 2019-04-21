<?php
include('include/init.php');



// 计算页码  共有多少页
$current = isset($_GET['page'])?$_GET['page']:1;
$limit = 4;  //每页显示个数
$start = ($current - 1) * $limit;
$size = 3; //页数

// 获取总条数
$sql = "SELECT COUNT(n_id) AS count FROM wd_news";
$count = getOne($sql);
$count = $count['count'];

//
$sql = "SELECT * FROM wd_news ORDER BY n_time DESC LIMIT $start,$limit";
$news = getAll($sql);


// 分页
$page = page($current,$count,$limit,$size,$class='meneame');

// echo $page;exit;
// pre($news);



include('view/news_list.html');
?>