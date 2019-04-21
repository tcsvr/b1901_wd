<?php
include('include/init.php');


$sql = "SELECT * FROM wd_article WHERE a_id=2";
$contact = getOne($sql);


// pre($contact);exit;
// echo $contact['a_content'];exit;







include('view/contact.html');
?>