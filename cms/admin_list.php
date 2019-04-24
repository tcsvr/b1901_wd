<?php
include('include/init.php');

$sql = "SELECT * FROM wd_admin ";

$admin = getAll($sql);
// $adminlist = $adminlist[];

if($_POST){
    //获取选中的id数组
    $aidarr = $_POST['aidarr'];
    //转化为字符串
    $aidstr = implode(',',$aidarr);
    //用条件删除多个
    $sql = "DELETE FROM wd_admin WHERE admin_id IN($aidstr)";
    //执行
    $bool = mysql_query($sql);
    //判断删除是否成功，成功则跳转回去，失败则提示
    if($bool && mysql_affected_rows()){
        header('Location:admin_list.php');
    }else{
        alert('删除失败');
    }
    
}   










include('view/admin_list.html');

?>