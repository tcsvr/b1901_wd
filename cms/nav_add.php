<?php
include('include/init.php');


if($_POST){

    if(!isset($_POST['n_name']) || empty($_POST['n_name'])){
        alert('请填写导航名称');
    }
    if(!isset($_POST['n_link']) || empty($_POST['n_link'])){
        alert('请填写导航链接');
    }
    //限制链接的格式
    if(!strpos($_POST['n_link'],'.php') && !strpos($_POST['n_link'],'.html')){
        alert('链接有错误');
    }

    //获取数据
    $name = trim($_POST['n_name']); 
    $link = $_POST['n_link'];
    $isshow = isset($_POST['n_isshow'])? $_POST['n_isshow']:0;

    
    $sql = "SELECT n_id FROM wd_nav WHERE n_name='{$name}'";
    $repeat = getOne($sql);
    if($repeat){
        alert('导航重复');
    }

    $sql =  "INSERT INTO wd_nav (`n_name`,`n_link`,`n_isshow`) VALUES ('{$name}','{$link}','{$isshow}')";
    $bool = mysql_query($sql);

    if($bool && mysql_affected_rows()){
        header('Location:nav_list.php');
    }else{
        alert('添加失败');
    }


}






include('view/nav_add.html');
?>