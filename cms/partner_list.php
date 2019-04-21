<?php
include('include/init.php');


//查询数据
$sql = "SELECT * FROM wd_partner  ORDER BY p_id ASC";
$partner = getAll($sql);




//
if($_POST){
    $pidarr = $_POST['pidarr'];
    $pidstr = implode(',',$pidarr);
    
    $sql = "DELETE FROM wd_partner WHERE p_id IN($pidstr)";
    $bool = mysql_query($sql);

    if($bool && mysql_affected_rows()){
        header('Location:partner_list.php');
    }else{
        alert('删除失败！','partner_list.php');
    }

}




include('view/partner_list.html');
?>