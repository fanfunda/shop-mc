<?php 
// 通过GD库做验证码
// 创建画布
$width = 80;
$height = 20;
$image = imagecreatetruecolor($width,$height);
$white = imagecolorallocate($image,255,255,255);
$black = imagecolorallocate($image,0,0,0);

// 用填充矩形填充画布
imagefilledrectangle($image,1,1,$width-2,$height-2,$white);


