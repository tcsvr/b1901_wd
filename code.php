<?php 
session_start();

function get_str($length = 4){
	$string = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
	$tmp = str_shuffle($string);//随机打乱字符串
	$str = substr($tmp,0,$length);//对打乱的字符串进行截取
	return $str;
}

//定义字体大小
$fontSize = 20;

//定义字符串长度
$length = 4;

//定义图片宽度
$width = 90;

//定义图片高度
$height = 34;

//获取一个随机字符串
$strNum = get_str($length);





$_SESSION['code']=$strNum;

//生成一张指定宽高的图片
$im = imagecreate($width,$height);


//生成背景色
$backgroundcolor = imagecolorallocate ($im, 255, 255, 255);	

//生成边框色
$frameColor = imageColorAllocate($im, 150, 150, 150);			

//提取字体文件，开始写字		
$font = 'texb.ttf';						
// $font = '../include/font/CURLZ___.TTF';

for($i = 0; $i < $length; $i++) {
	//定义字符Y坐标
	$charY = ($height+15)/2 + rand(-1,1);

	//定义字符X坐标		
	$charX = $i*15+8;											
	
	//生成字符颜色
	$text_color = imagecolorallocate($im, mt_rand(50, 200), mt_rand(50, 128), mt_rand(50, 200));
	//生成字符角度
	$angle = rand(-20,20);										
	
	//写入字符
	imageTTFText($im, $fontSize, $angle, $charX,  $charY, $text_color, $font, $strNum[$i]);
}

for($i=0; $i <= 5; $i++) {										
//循环画背景线
	$linecolor = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
	$linex = mt_rand(1, $width-1);
	$liney = mt_rand(1, $height-1);
	imageline($im, $linex, $liney, $linex + mt_rand(0, 14) - 2, $liney + mt_rand(0, 14) - 2, $linecolor);
}
for($i=0; $i <= 50; $i++) {											//循环画背景点,生成麻点效果
	$pointcolor = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
	imagesetpixel($im, mt_rand(1, $width-1), mt_rand(1, $height-1), $pointcolor);
}
//画边框
imagerectangle($im, 0, 0, $width-1 , $height-1 , $frameColor);	


header('Content-type: image/png');
imagepng($im);
imagedestroy($im);





?>