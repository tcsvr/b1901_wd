<?php
include('include/init.php');

//在提交前执行
//获取分类id
$caid = isset($_GET['caid'])?$_GET['caid']:1;

$sql = "SELECT ca_name FROM wd_case_category WHERE ca_id='{$caid}'";
$category = getOne($sql);


//提交后执行
if($_POST){
    if(!isset($_POST['ca_name']) || empty($_POST['ca_name'])){
        alert('请填写分类名称');
    }
    //获取数据
    $ca_name = $_POST['ca_name'];

    //
    $sql = "SELECT ca_id FROM wd_case_category WHERE ca_name='{$ca_name}'";
    $repeat = getOne($sql);
    if($repeat){
        alert('名称分类重复');
    }
    
    $sql = "UPDATE wd_case_category SET `ca_name`='{$ca_name}' WHERE ca_id='{$caid}'";
    $bool = mysql_query($sql);

    if($bool && mysql_affected_rows()){
        alert('修改成功','category_list.php');
    }else{
        alert('修改失败','category_edit.php?caid='.$caid);
    }

}
// pre($category);


include('view/category_edit.html');
?>