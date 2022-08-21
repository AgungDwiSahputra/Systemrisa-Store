<?php
session_start();
header("Content-type: image/png");

$_SESSION["captcha"]="";

$image = imagecreate(148, 40);
$font = __DIR__ .  '/Allura-Regular.otf';
$size = 18;
$background_color = imagecolorallocate($image, 0, 255, 255);
$color1 = imagecolorallocate($image, 0, 0, 0);
$color2 = imagecolorallocate($image, 128, 128, 128);
for($i=0; $i<=4; $i++){

    $text = rand(0,9);
    $_SESSION["captcha"] .=$text;

    $angle = rand(-30, 30);
    $x1 = 22+20*$i;
    $y1 = 30;
    $x2 = 23+20*$i;
    $y2 = 31;

    imagettftext($image, $size, $angle, $x1, $y1, $color1, $font, $text);
    imagettftext($image, $size, $angle, $x2, $y2, $color2, $font, $text);
}

imagepng($image);
imagedestroy($image);
?>