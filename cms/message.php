<?php
include('include/init.php');


// $sql = "SELECT * FROM wd_message ORDER BY m_time DESC";
// $message = getAll($sql);


$current = isset($_GET['page'])?$_GET['page']:1;
$limit = 4;  //每页显示个数
$start = ($current - 1) * $limit;
$size = 3; //页数

// 获取总条数
$sql = "SELECT COUNT(n_id) AS count FROM wd_news";
$count = getOne($sql);
$count = $count['count'];

//
$sql = "SELECT * FROM wd_message ORDER BY m_time DESC LIMIT $start,$limit";
$message = getAll($sql);


// 分页
$page = page($current,$count,$limit,$size,$class='meneame');



if($_POST){
    //获取选中的id数组
    $midarr = $_POST['midarr'];
    //转化为字符串
    $midstr = implode(',',$midarr);
    //用条件删除多个
    $sql = "DELETE FROM wd_message WHERE m_id IN($midstr)";
    //执行
    $bool = mysql_query($sql);

    //判断删除是否成功，成功则跳转回去，失败则提示
    if($bool && mysql_affected_rows()){
        header('Location:message.php');
    }else{
        alert('删除失败');
    }
    
}   












include('view/message.html');
?>




?>