<?php
session_start();
$random=rand(1,9).rand(1,9).rand(1,9).rand(1,9);
$_SESSION['captcha']=$random;
$captcah=imagecreatefromjpeg("images/captcha.jpg");
$color=imagecolorallocate($captcah,0,0,1);
$font=realpath('fonts/code.otf');
imagettftext($captcah,20,0,rand(30,180),rand(20,70),$color,$font,$random);
imagepng($captcah);
imagedestroy($captcah);
?>