<?php
// Get the ID from the query string parameter
$id = $_GET['id'];

$lotno = substr(strval($id), 2, 3);
// Construct the path to the image file
$imagePath = "img/{$lotno}.png";

// Check if the file exists
if (file_exists($imagePath)) {
  // Set the content type header to indicate that this is an image file
  header('Content-Type: image/png');

  // Read the file and output its contents
  readfile($imagePath);
} else {
  // If the file does not exist, display an error message
  echo "Invalid file request";
}
?>