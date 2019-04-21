<?php
include('include/init.php');


//查询数据
$sql = "SELECT `n_id`,`n_title`,`n_thumb`,`n_time` FROM wd_news  ORDER BY n_id DESC";
$news = getAll($sql);




//
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




include('view/news_list.html');
?>