<?php 

    session_start(); 
    header('content:image/jpeg');
    $str_rand = md5(rand());
    $str =  substr($str_rand, 0,5);
    $_SESSION["captcha_code"] = $str; 
	$height = 25; 
	$width = 65;   
    $image_p = imagecreate($width, $height); 
    imagecolorallocate($image_p, 255, 255, 255); 
    $text_black = imagecolorallocate($image_p, 0,0,0); 
    $font_size = 14; 
    for($i=1; $i<= 100; $i++)
{
    $x1 = mt_rand(0,300);
    $y1 = mt_rand(0,300);
    $x2 = mt_rand(0,300);
    $y2 = mt_rand(0,300);
    imageline($image_p,$x1,$y1,$x2,$y2, $text_black);
}    
    
    
    imagestring($image_p, $font_size, 5, 5, $str, $text_black); 
    imagejpeg($image_p, null, 80); 
?>