<?php
include('include/init.php');


//查询数据
$sql = "SELECT `c_id`,`c_title`,`c_thumb`,`c_isshow` FROM wd_case  WHERE ca_id={$caid} ORDER BY c_id DESC";
$catelist = getAll($sql);




if($_POST){
    $idarr = $_POST['idarr'];
    $idstr = implode(',',$idarr);
    
    $sql = "DELETE FROM wd_case WHERE c_id IN($idstr)";
    $bool = mysql_query($sql);

    if($bool && mysql_affected_rows()){
        header('Location:case_list.php?caid='.$caid);
    }else{
        alert('删除失败！','case_list.php?caid='.$caid);
    }

}




include('view/case_list.html');
?>