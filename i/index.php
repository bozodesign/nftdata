<?php
// Get the ID from the query string parameter
$id = $_GET['id'];


$series = substr(strval($id), 0, 2);
$lotno = substr(strval($id), 2, 3);
$number = substr(strval($id), 5, 12);

// Define Batch size for this ID
$batch = pow(10,(int)(($series/10)-1));

// Construct the path to the image file
$imagePath = "img/{$lotno}.png";

// Check if the file exists
if (file_exists($imagePath)) {
  // Load the PNG image file
$image = imagecreatefrompng($imagePath);

// Set the font size and color for the text
$font_size = 28;
$text_color = imagecolorallocate($image, 255, 255, 255);

// Set the text to be overlayed on the image
if($series<>"10"){
$text = (int)$number .' ' .($number + $batch - 1);
}else{
$text = (int)$number;
}

// Get the dimensions of the image
$image_width = imagesx($image);
$image_height = imagesy($image);
putenv('GDFONTPATH=' . realpath('.'));
// Get the dimensions of the text
$text_box = imagettfbbox($font_size, 0, 'micrenc.ttf', $text);
$text_width = $text_box[2] - $text_box[0];
$text_height = $text_box[7] - $text_box[1];

// Calculate the position of the text on the image
$x = ($image_width - $text_width) / 2;
$y = ($image_height - $text_height) / 2;

// Overlay the text onto the image
imagettftext($image, $font_size, 0, $x, $y, $text_color, 'micrenc.ttf', $text);


  // Set the content type header to indicate that this is an image file
  header('Content-Type: image/png');

  // Read the file and output its contents
  imagepng($image);
  // Clean up memory resources
  imagedestroy($image);
} else {
  // If the file does not exist, display an error message
  echo "Invalid file request";
}

?>