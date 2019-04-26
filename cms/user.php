<?php
include('include/init.php');


$sql = "SELECT * FROM wd_user ORDER BY lasttime ASC";
$user = getAll($sql);

$current = isset($_GET['page'])?$_GET['page']:1;
$limit = 2;  //每页显示个数
$start = ($current - 1) * $limit;
$size = 2; //页数

// 获取总条数
$sql = "SELECT COUNT(n_id) AS count FROM wd_news";
$count = getOne($sql);
$count = $count['count'];

//
$sql = "SELECT * FROM wd_user ORDER BY lasttime ASC LIMIT $start,$limit";
$user = getAll($sql);


// 分页
$page = page($current,$count,$limit,$size,$class='meneame');



if($_POST){
    //获取选中的id数组
    $uidarr = $_POST['uidarr'];
    //转化为字符串
    $uidstr = implode(',',$uidarr);
    //用条件删除多个
    $sql = "DELETE FROM wd_user WHERE u_id IN($uidstr)";
    //执行
    $bool = mysql_query($sql);

    //判断删除是否成功，成功则跳转回去，失败则提示
    if($bool && mysql_affected_rows()){
        header('Location:user.php');
    }else{
        alert('删除失败');
    }
    
}   












include('view/user.html');
?>




?>