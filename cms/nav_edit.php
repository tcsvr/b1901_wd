<?php
include('include/init.php');

//提交前执行


$nid = isset($_GET['nid'])?$_GET['nid']:1;

$sql = "SELECT * FROM wd_nav WHERE n_id=$nid";
$nav = getAll($sql);
$nav = $nav[0];


//提交后执行
if($_POST){
    //
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
    $isshow = isset($_POST['n_isshow'])? $_POST['n_isshow']:0;  //获取是否显示
    $name = trim($_POST['n_name']);    //名称
    $link = $_POST['n_link'];          //链接

    // pre($nid);
    $sql = "UPDATE wd_nav SET `n_name`='{$name}',`n_link`='{$link}',`n_isshow`='{$isshow}' WHERE n_id='{$nid}'";
    
    $bool = mysql_query($sql);

    if($bool && mysql_affected_rows()){
        header('Location:nav_list.php');
    }else{
        alert('修改失败','nav_edit.php?nid='.$nid);
    }

}








include('view/nav_edit.html');
?>