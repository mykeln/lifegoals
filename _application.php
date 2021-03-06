<?php
function hexColorAllocate($img,$hex){
    $hex = ltrim($hex,'#');
    $a = hexdec(substr($hex,0,2));
    $b = hexdec(substr($hex,2,2));
    $c = hexdec(substr($hex,4,2));

    return imagecolorallocate($img, $a, $b, $c);
}

function create_image($goal,$bg_color,$img_height,$img_width){
  // saves the file in the covers directory for posterity
  $random_name = $goal.rand(0,1292938);
  $file = "covers/".md5($random_name).".png";

  // sets image resolution to screen size
  $img = imagecreatetruecolor($img_height,$img_width);

  $imageX = imagesx($img);
  $imageY = imagesy($img);

  imagealphablending($img, false);
  imagesavealpha($img, true);

  // FIXME: get colors from submitted form
  $fg_color = hexColorAllocate($img, '#ffffff');
  //$bg_color = imagecolorallocate($img, 0,0,0);
  $bg_color = hexColorAllocate($img,$bg_color);

  //$bg_color = imagecolorallocate($img, $raw_color);

  // create a rectangle with the defined background color
  imagefilledrectangle($img, 0, 0, $imageX, $imageY, $bg_color);

  // setting the font family and size
  $font = "./font/Gotham-Rounded.ttf";
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
//  $text_posY = ($imageY / 2) - ($textY / 2);

$text_posY = 600;

  // make fonts transparent
  imagealphablending($img, true);

  // place the text inside the image according to fg_color
  // y position currently hardcoded to 200. it should be fixed.
  imagettftext($img, $fontSize, 0, $text_posX, $text_posY, $fg_color, $font, $text);

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
    $bg_color = $_POST['bg_color'];
  }
}

// run the script to create the image
$filename = create_image($goal,$bg_color,$img_height,$img_width);

?>
