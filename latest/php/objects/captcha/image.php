<?php

// Generate a 4-character Captcha code (uppercase letters and numbers)
$captcha_code = '';
$characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
for ($i = 0; $i < 6; $i++) {
    $captcha_code .= $characters[rand(0, strlen($characters) - 1)];
}
$_SESSION['captcha_code'] = $captcha_code;

// Set image dimensions and colors
$width = 58;
$height = 20;
$image = imagecreate($width, $height);
$background_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);

imagestring($image, 5, 3, 2, $captcha_code, $text_color);

// Capture the image output and clean up resources
ob_start();
imagepng($image);
$image_data = ob_get_clean();
imagedestroy($image);

// Send image data as response through the framework
App::$mime = 'image/png';
Response::deliver($image_data);
