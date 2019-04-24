<?php
include('include/init.php');

//先判断是否为提交动作
if($_POST){
    // pre($_POST);
    //判断是否为空
    if(!isset($_POST['ca_name']) || empty($_POST['ca_name'])){
        alert('请填写分类名称');
    }
    //获取数据
    $ca_name = $_POST['ca_name'];

    //
    $sql = "SELECT ca_id FROM wd_case_category WHERE ca_name='{$ca_name}'";
    $repeat = getOne($sql);
    if($repeat){
        alert('名称重复');
    }

    //写SQL语句
    $sql =  "INSERT INTO wd_case_category (`ca_name`) VALUES ('{$ca_name}')";
    //执行
    $bool = mysql_query($sql);

    //判断是否添加成功
    if($bool && mysql_affected_rows()){
        alert('添加成功','category_list.php');
    }else{
        alert('添加失败');
    }

}



include('view/category_add.html');
?>