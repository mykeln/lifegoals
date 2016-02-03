<?php
function create_image($goal){
	// saves the file in the covers directory for posterity
	$file = "covers/".md5($goal[0]['goal']).".png";

	$img_height = $goal[0]['width'];
	$img_width = $goal[0]['height'];

	// FIXME: get resolution from submitted form
	$img = imagecreatetruecolor($img_width, $img_height);

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
	$rawtext = strtoupper($goal[0]['goal']);

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

	// if form was actually submitted, generate and create the cover image
	if(isset($_POST['submit'])){
		imagepng($img, $file);
	}

	return $file;
} // end image create function


// setting default entry for goal
$goal = array(array('goal'=>'NO SUGAR', 'width'=>'1080', 'height'=>'1920'));

// if form was submitted
if(isset($_POST['submit'])){
	$error = array();

	// checking to see if goal was entered. if not, throw an error
	if(strlen($_POST['goal'])==0){
		$error[] = 'No goal? No background.';
	}

	// if no errors, reset the definition of goal to be the one that was submitted, rather than the default
	if(count($error)==0){
		$goal = array(array('goal'=> $_POST['goal']));
	}
}

// run the script to create the image
$filename = create_image($goal);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>

<!-- Standard -->
<title>Lock your #lifegoals</title>
<meta name="description" content="Make a background for your lock screen to maintain good habits.">
<meta name="keywords" content="lifegoals, life, goals, resolution">
<meta name="author" content="Waker, LLC">
<link rel="canonical" href="http://wakerlabs.com/lifegoals">

<!-- Schema.org -->
<meta itemprop="name" content="#lifegoals">
<meta name="description" content="Make a background for your lock screen to maintain good habits.">
<meta itemprop="url" content="http://wakerlabs.com/lifegoals">
<meta itemprop="keywords" content="send, sign, store, clickthrough, clickwrap, agreement, subscription, saas">
<meta itemprop="image" content="/path/to/228x228.png">
<meta itemprop="sourceOrganization" content="Waker, LLC">
<meta itemprop="inLanguage" content="en-US">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@wakerlabs">

<!-- OpenGraph -->
<meta property="og:title" content="#lifegoals">
<meta property="og:site_name" content="#lifegoals">
<meta property="og:url" content="http://wakerlabs.com/lifegoals">
<meta property="description" content="Make a background for your lock screen to maintain good habits.">
<meta property="og:type" content="website">
<meta property="og:locale" content="en_US">
<meta property="og:image" content="/path/to/228x228.png">

<!-- Favicons -->
<!-- Standard -->
<meta name="theme-color" content="#FFFFFF">
<meta name="mobile-web-app-capable" content="yes">
<link rel="icon" type="image/png" href="/path/to/16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="/path/to/32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/path/to/48x48.png" sizes="48x48">
<link rel="icon" type="image/png" href="/path/to/64x64.png" sizes="64x64">
<link rel="icon" type="image/png" href="/path/to/96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="/path/to/128x128.png" sizes="128x128">
<link rel="icon" type="image/png" href="/path/to/160x160.png" sizes="160x160">
<link rel="icon" type="image/png" href="/path/to/196x196.png" sizes="196x196">
<link rel="icon" type="image/png" href="/path/to/228x228.png" sizes="228x228">
<link rel="icon" type="image/png" href="/path/to/256x256.png" sizes="256x256">
<link rel="shortcut icon" href="/path/to/favicon.ico">

<!-- Apple -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="apple-touch-startup-image" href="path/to/320x480-startup-image.png">
<meta name="apple-mobile-web-app-title" content="#lifegoals">
<link rel="apple-touch-icon" sizes="57x57" href="/path/to/57x57.png">
<link rel="apple-touch-icon" sizes="114x114" href="/path/to/114x114.png">
<link rel="apple-touch-icon" sizes="60x60" href="/path/to/60x60.png">
<link rel="apple-touch-icon" sizes="120x120" href="/path/to/120x120.png">
<link rel="apple-touch-icon" sizes="72x72" href="/path/to/72x72.png">
<link rel="apple-touch-icon" sizes="144x144" href="/path/to/144x144.png">
<link rel="apple-touch-icon" sizes="76x76" href="/path/to/76x76.png">
<link rel="apple-touch-icon" sizes="152x152" href="/path/to/152x152.png">

<!-- Microsoft -->
<meta name="application-name" content="#lifegoals">
<meta name="msapplication-tooltip" content="#lifegoals">
<meta name="msapplication-window" content="width=1024;height=768">
<meta name="msapplication-navbutton-color" content="#CC0400">
<meta name="msapplication-starturl" content="http://wakerlabs.com/lifegoals">
<meta name="msapplication-TileColor" content="#FFFFFF">
<meta name="msapplication-TileImage" content="/path/to/144x144.png">
<meta name="msapplication-config" content="browserconfig.xml">
<!-- Favicons -->

<link rel="icon" type="image/png" href="/path/to/logo.png" />

	<style type="text/css">
		body {
			font: normal 14px/17px "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
		}
	 #hero {
	 	margin: 20px;
	 	background: url(icon.png) top center no-repeat;
	 	height: 145px;
	 	width: 87px;
	 	text-indent: -9999px;
	 	margin: 0px auto;
	 }

	 /* retina */
	 @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
	 #hero {
	 	background: url(icon@2x.png) top center no-repeat;
	 	background-size: 100%;
		}

	h1 {
		margin: 20px;
	}

	h2 {
		margin: 20px;
		line-height: 23px;
		color: #ccc;
	}

	input {
		margin: 20px;
		box-sizing: border-box;
		width: 90%;
		font-size: 20px;
		line-height: 30px;
	}

	input[type=submit] {
		cursor:pointer;
		background: #1485E0;
		border: 4px solid #106AB3;
		border-radius: 8px;
		-webkit-border-radius: 8px;
		color: #fff;
		line-height: 40px;
	}

	.footer {
		text-align: center;
	}

	.footer a {
		text-decoration: none;
		color: #ddd;
	}
	</style>


</head>
<body>

<?php
	// if there were errors, list them
	if(isset($error)){
		foreach($error as $errors){
			echo '<p>'.$errors.'</p>';
		}
	}
?>

<?php
	if(isset($_POST['submit'])){
?>
	<!-- this should show the submitted image on line 79 -->
	<img src="<?=$filename;?>?id=<?=rand(0,1292938);?>" />

	Share your goals to hold yourself accountable
	<a href="#">Tweet my life goal</a>
<?php
}
?>

<div id="hero">#lifegoals</div>

<h1>#lifegoals</h1>
<h2>Having trouble staying on track? Make a background to remind you whenever you pull out your phone.</h2>

<div class="dynamic-form">
	<form action="" method="post">
		<input type="hidden" value="1080" name="width" />
		<input type="hidden" value="1920" name="height" />
		<input type="text" value="<?php if(isset($_POST['goal'])){echo $_POST['goal'];}?>" name="goal" maxlength="15" placeholder="No added sugar"><br/>
		<input name="submit" type="submit" class="" value="Make a reminder background" />
	</form>
</div>

<div class="footer">
	<a href="http://wakerlabs.com">© 2015 Waker, LLC.</a>
</div>
</body>
</html>
