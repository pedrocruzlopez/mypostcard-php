<?php
/**
 * Created by PhpStorm.
 * User: pedrocruzdev
 * Date: 11/17/19
 * Time: 13:34
 */

$filename = $_POST['original'];
$new_width = $_POST['width'];


// Get new dimensions
list($width, $height) = getimagesize($filename);
$new_height = ($new_width * $height) / $width;

// Resample
$image_p = imagecreatetruecolor($new_width, $new_height);
$image = imagecreatefromjpeg($filename);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);


ob_start();

// generate the byte stream
imagejpeg($image_p, null, 100);
imagedestroy($image_p);

// and finally retrieve the byte stream
$rawImageBytes = ob_get_clean();

echo "<a href='/includes/pdf-generation.php?url=".$filename."' target=\"_blank\"><img src='data:image/jpeg;base64," . base64_encode( $rawImageBytes ) . "' /></a>";




