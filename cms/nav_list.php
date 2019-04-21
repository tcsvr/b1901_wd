<?php
include('include/init.php');


$sql = "SELECT * FROM wd_nav ORDER BY n_id ASC";

$nav = getAll($sql);


//
if($_POST){
    //获取选中的id数组
    $navarr = $_POST['navarr'];
    //转化为字符串
    $navstr = implode(',',$navarr);
    //用条件删除多个
    $sql = "DELETE FROM wd_nav WHERE n_id IN($navstr)";
    //执行
    $bool = mysql_query($sql);

    //判断删除是否成功，成功则跳转回去，失败则提示
    if($bool && mysql_affected_rows()){
        header('Location:nav_list.php');
    }else{
        alert('删除失败');
    }
    
}   





include('view/nav_list.html');
?>