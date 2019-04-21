<?php
include('include/init.php');


$sql = "SELECT * FROM wd_article WHERE a_id=1";
$about = getOne($sql);

$sabout = $about['a_content'];

preg_match_all("/<img\s+src=\"(.+)\"/U", $sabout, $matches);

// 原数据库的数据
// pre($matches);

// pre($about);

if($_POST){

	// if(){是否为空}
	// 获取数据
	$a_title = $_POST['a_title'];
	$a_content = $_POST['editorValue'];

	preg_match_all("/<img\s+src=\"(.+)\"/U", $a_content, $submitimg);

	foreach($matches[1] as $v){
		if(!in_array($v, $submitimg[1])){
			
			$delpath = str_replace(_WEB_, _ROOT_, $v);
			echo $delpath.'<br>';
			echo unlink($delpath);

		}
	}
	// "http://www.b1901_wd.com/" _WEB_
	// "C:/phpStudy/WWW/b1901/20190412/www.b1901_wd.com/"  _ROOT_
	// "http://www.b1901_wd.com/cms/umeditor/php/upload/20190420/15557556657101.jpg";
	// pre($submitimg);

	// exit;

	$sql = "UPDATE wd_article SET `a_title`='{$a_title}',`a_content`='{$a_content}' WHERE a_id=1";

	$bool = mysql_query($sql);
	echo '<hr>';
	var_dump($bool);
	var_dump(mysql_affected_rows());
	alert('已保存');

	
}













include('view/about.html');
?>