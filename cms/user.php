<?php
include('include/init.php');


$sql = "SELECT * FROM wd_user ORDER BY lasttime ASC";
$user = getAll($sql);


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