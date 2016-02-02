<?php
ob_start();
ob_get_clean();

function create_image($user){
	// FIXME: currently not working
	// saves the file in the covers directory for posterity
	$file = "covers/".md5($user[0]['goal']).".png";

	// FIXME: get resolution from submitted form
	$img = imagecreatetruecolor(1080, 1920);

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

	// FIXME: get text from submitted form
	$rawtext = "DINO BESLAGIC SHOULD BUILD A UTILITY SINK OUT OF CONCRETE";

	// wrap the text after 10 characters
	$text = wordwrap($rawtext, 10, "\n");

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

	header("Content-Type: image/png");
	imagepng($img);

	return $file;
}

// from old script
$user = array(

	array(
		'goal'=> 'NO SUGAR'));


// error checking
if(isset($_POST['submit'])){

	$error = array();
	if(strlen($_POST['goal'])==0){
		$error[] = 'Please enter a goal';
	}

	if(count($error)==0){
		$user = array(
			array(
				'goal'=> $_POST['goal'],
				'font-size'=>'27',
				'color'=>'grey'));
	}
}

// run the script to create the image
$filename = create_image($user);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css">

	<style type="text/css">
	 #hero {
	 	background: url(icon.png) top center no-repeat;
	 	height: 145px;
	 	width: 87px;
	 	text-indent: -9999px;
	 	margin: 0px auto;
	 }

	 @media
(-webkit-min-device-pixel-ratio: 2),
(min-resolution: 192dpi) {
	 #hero {
	 	background: url(icon@2x.png) top center no-repeat;
	 	background-size: 100%;
}

	h1 {
		text-align: center;
	}
	</style>
</head>
<body>

<!-- this should show the submitted image on line 79 -->
<img src="<?=$filename;?>?id=<?=rand(0,1292938);?>" />

<ul>
	<?php
		if(isset($error)){
			foreach($error as $errors){
				echo '<li>'.$errors.'</li>';
			}
		}
	?>
</ul>

<div id="hero">#lifegoals</div>

<h1>#lifegoals</h1>

<div class="dynamic-form">
	<form action="" method="post">
		<label>Goal</label>
		<input type="text" value="<?php if(isset($_POST['goal'])){echo $_POST['goal'];}?>" name="goal" maxlength="15" placeholder="Life Goal"><br/>
		<input name="submit" type="submit" class="btn btn-primary" value="Make a background" />
	</form>
</div>

</body>
</html>