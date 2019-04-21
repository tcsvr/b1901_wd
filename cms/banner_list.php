<?php
include('include/init.php');


//查询数据
$sql = "SELECT * FROM wd_banner  ORDER BY b_id ASC";
$banner = getAll($sql);




//
if($_POST){
    $bidarr = $_POST['bidarr'];
    $bidstr = implode(',',$bidarr);
    
    $sql = "DELETE FROM wd_banner WHERE b_id IN($bidstr)";
    $bool = mysql_query($sql);

    if($bool && mysql_affected_rows()){
        header('Location:banner_list.php');
    }else{
        alert('删除失败！','banner_list.php');
    }

}




include('view/banner_list.html');
?>