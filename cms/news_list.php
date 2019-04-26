<?php
include('include/init.php');


//查询数据
// $sql = "SELECT `n_id`,`n_title`,`n_thumb`,`n_time` FROM wd_news  ORDER BY n_id DESC";
// $news = getAll($sql);




if($_POST){
    $nidarr = $_POST['nidarr'];
    $nidstr = implode(',',$nidarr);
    
    $sql = "DELETE FROM wd_news WHERE n_id IN($nidstr)";
    $bool = mysql_query($sql);

    if($bool && mysql_affected_rows()){
        header('Location:news_list.php');
    }else{
        alert('删除失败！','news_list.php');
    }

}

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



include('view/news_list.html');
?>