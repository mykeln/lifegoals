<?php
function create_image($goal,$img_height,$img_width){
  // saves the file in the covers directory for posterity
  $file = "covers/".md5($goal).".png";

  // sets image resolution to screen size
  $img = imagecreatetruecolor($img_height,$img_width);

  $imageX = imagesx($img);
  $imageY = imagesy($img);

  imagealphablending($img, false);
  imagesavealpha($img, true);

  // FIXME: get colors from submitted form
  $fg_color = imagecolorallocate($img, 255,255,255);
  $bg_color = imagecolorallocate($img, 0,0,0);

  // create a rectangle with the defined background color
  imagefilledrectangle($img, 0, 0, $imageX, $imageY, $bg_color);

  // setting the font family and size
  $font = "./font/Capriola-Regular.ttf";
  $fontSize = 120;

  // get text from submitted form
  $rawtext = strtoupper($goal);

  // wrap the text after 10 characters
  $text = wordwrap($rawtext, 6, "\n");


  $textDim = imagettfbbox($fontSize, 0, $font, $text);
  $textX = $textDim[2] - $textDim[0];
  $textY = $textDim[7] - $textDim[1];

  $text_posX = ($imageX / 2) - ($textX / 2);

  // FIXME: fix this to center it vertically
  $text_posY = ($imageY / 2) - ($textY / 2);

  // make fonts transparent
  imagealphablending($img, true);

  // place the text inside the image according to fg_color
  // y position currently hardcoded to 200. it should be fixed.
  imagettftext($img, $fontSize, 0, $text_posX, 200, $fg_color, $font, $text);

  // if form was actually submitted, generate and create the cover image
  if(isset($_POST['submit'])){
    imagepng($img, $file);
  }

  return $file;
} // end image create function


// setting default entry for goal
$goal = 'NO SUGAR';
$img_width = 320;
$img_height = 640;

// if form was submitted
if(isset($_POST['submit'])){
  $error = array();

  // checking to see if goal was entered. if not, throw an error
  if(strlen($_POST['goal'])==0){
    $error[] = 'No goal? No background.';
  }

  // if no errors, reset the definition of goal to be the one that was submitted, rather than the default
  if(count($error)==0){
    $goal = $_POST['goal'];
    $img_height = (int) $_POST['img_height'];
    $img_width = (int) $_POST['img_width'];
  }
}

// run the script to create the image
$filename = create_image($goal,$img_height,$img_width);

?>