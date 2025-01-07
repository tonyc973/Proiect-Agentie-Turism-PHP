<?php
session_start();

// Generate random CAPTCHA code
$captcha_code = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 6);
$_SESSION['captcha'] = $captcha_code;

// Create the CAPTCHA image
header('Content-Type: image/png');
$image = imagecreatetruecolor(120, 40);
$background_color = imagecolorallocate($image, 240, 240, 240);
$text_color = imagecolorallocate($image, 50, 50, 50);
$line_color = imagecolorallocate($image, 200, 200, 200);

// Fill the background
imagefilledrectangle($image, 0, 0, 120, 40, $background_color);

// Add some noise
for ($i = 0; $i < 5; $i++) {
    imageline($image, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $line_color);
}

// Add the CAPTCHA text
$font = __DIR__ . '/fonts/arial.ttf'; // Ensure this font file exists or update the path
imagettftext($image, 18, rand(-10, 10), 10, 30, $text_color, $font, $captcha_code);

// Output the image
imagepng($image);
imagedestroy($image);
?>
