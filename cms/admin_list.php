<?php
include('include/init.php');

$sql = "SELECT * FROM wd_admin ";

$admin = getAll($sql);
// $adminlist = $adminlist[];










include('view/admin_list.html');

?>