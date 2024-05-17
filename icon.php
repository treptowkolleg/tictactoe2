<?php

$icon = $_GET['icon'] ?? '';

$image = imagecreatetruecolor(100, 100);

$alpha = imagecolorallocatealpha($image,0,0,0,127);
$red = imagecolorallocate($image,255,0,0);
$pink = imagecolorallocate($image,255,0,128);
$blue = imagecolorallocate($image,0,0,255);
$green = imagecolorallocate($image,0,255,0);

imagealphablending($image,false);
imagefill($image, 0, 0, $alpha);
imagesavealpha($image, true);

switch ($icon) {
    case "kreis":
        imageellipse($image,50,50,90,90,$red);
        break;
    case "kreuz":
        imageline($image,10,10,90,90,$blue);
        imageline($image,10,90,90,10,$blue);
        break;
    case "dreieck":
        imageline($image,5,90,50,10,$green);
        imageline($image,95,90,50,10,$green);
        imageline($image,5,90,95,90,$green);
        break;
    default:
        imagerectangle($image,10,10,90,90,$pink);
        break;
}

header('Content-type: image/png');
imagepng($image);
imagedestroy($image);