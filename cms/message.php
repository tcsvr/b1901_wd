<?php
include('include/init.php');


$sql = "SELECT * FROM wd_message ORDER BY m_time DESC";
$message = getAll($sql);


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