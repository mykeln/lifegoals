<?php include('_application.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>

<script src="assets/javascript/lib/tinycolorpicker.min.js"></script>

<!-- Standard -->
<title>Lock in your #nosugar</title>
<meta name="description" content="Make a lock screen reminder for all your devices.">
<meta name="keywords" content="no sugar, lifegoals, life, goals, resolution">
<meta name="author" content="Waker, LLC">
<link rel="canonical" href="http://nosugar.co">

<!-- Schema.org -->
<meta itemprop="name" content="#nosugar">
<meta name="description" content="Make a lock screen reminder for all your devices.">
<meta itemprop="url" content="http://nosugar.co">
<meta itemprop="keywords" content="send, sign, store, clickthrough, clickwrap, agreement, subscription, saas">
<meta itemprop="image" content="assets/images/228x228.png">
<meta itemprop="sourceOrganization" content="Waker, LLC">
<meta itemprop="inLanguage" content="en-US">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@wakerlabs">

<!-- OpenGraph -->
<meta property="og:title" content="#nosugar">
<meta property="og:site_name" content="#nosugar">
<meta property="og:url" content="http://nosugar.co">
<meta property="description" content="Make a lock screen reminder for all your devices.">
<meta property="og:type" content="website">
<meta property="og:locale" content="en_US">
<meta property="og:image" content="assets/images/228x228.png">

<!-- Favicons -->
<!-- Standard -->
<meta name="theme-color" content="#FFFFFF">
<meta name="mobile-web-app-capable" content="yes">
<link rel="icon" type="image/png" href="assets/images/16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="assets/images/32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="assets/images/48x48.png" sizes="48x48">
<link rel="icon" type="image/png" href="assets/images/64x64.png" sizes="64x64">
<link rel="icon" type="image/png" href="assets/images/96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="assets/images/128x128.png" sizes="128x128">
<link rel="icon" type="image/png" href="assets/images/160x160.png" sizes="160x160">
<link rel="icon" type="image/png" href="assets/images/196x196.png" sizes="196x196">
<link rel="icon" type="image/png" href="assets/images/228x228.png" sizes="228x228">
<link rel="icon" type="image/png" href="assets/images/256x256.png" sizes="256x256">
<link rel="shortcut icon" href="favicon.ico">

<!-- Apple -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="apple-touch-startup-image" href="assets/images/320x480-startup-image.png">
<meta name="apple-mobile-web-app-title" content="#nosugar">
<link rel="apple-touch-icon" sizes="57x57" href="assets/images/57x57.png">
<link rel="apple-touch-icon" sizes="114x114" href="assets/images/114x114.png">
<link rel="apple-touch-icon" sizes="60x60" href="assets/images/60x60.png">
<link rel="apple-touch-icon" sizes="120x120" href="assets/images/120x120.png">
<link rel="apple-touch-icon" sizes="72x72" href="assets/images/72x72.png">
<link rel="apple-touch-icon" sizes="144x144" href="assets/images/144x144.png">
<link rel="apple-touch-icon" sizes="76x76" href="assets/images/76x76.png">
<link rel="apple-touch-icon" sizes="152x152" href="assets/images/152x152.png">

<!-- Microsoft -->
<meta name="application-name" content="#nosugar">
<meta name="msapplication-tooltip" content="#nosugar">
<meta name="msapplication-window" content="width=1024;height=768">
<meta name="msapplication-navbutton-color" content="#CC0400">
<meta name="msapplication-starturl" content="http://nosugar.co">
<meta name="msapplication-TileColor" content="#FFFFFF">
<meta name="msapplication-TileImage" content="assets/images/144x144.png">
<meta name="msapplication-config" content="browserconfig.xml">
<!-- Favicons -->

<link rel="icon" type="image/png" href="assets/images/logo.png" />
<link rel="stylesheet" href="assets/css/application.css" />
	<script type="text/javascript">
		var ratio = window.devicePixelRatio || 1;
		// FIXME: not quite getting the correct size to fit as a background
		var w = screen.width * ratio;
		var h = screen.height * ratio;

		// shrinking the size of the image for display, but still able to press and hold
		var trunc_w = w / 4;
		var trunc_h = h / 4;

		window.onload = function () {
			document.getElementById("img_height").value = h;
			document.getElementById("img_width").value = w;

			var $picker = document.getElementById("colorPicker"),   picker  = tinycolorpicker($picker);
			picker.setColor("#444444");
		}

	</script>

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
		$image_file = $filename."?id=".rand(0,1292938);
?>
	<!-- the image -->
	<img id="result_image" height="100" width="100" src="<?= $image_file; ?>" />

	<!-- the link -->
	<p>Press and hold the circle to save to your photos, then assign it as your lock screen.</p>
	<a href="http://twitter.com/home?status=<?php $goal ?> #nosugar">Share with friends to hold yourself accountable</a>
<?php
} else {
?>

<div id="hero">#nosugar</div>

<h1>#nosugar</h1>
<h2>Having trouble keeping a habit? Make a lock screen photo to remind you whenever you pull out your phone.</h2>

<div class="dynamic-form">
	<form action="" method="post">
		<input type="hidden" value="1080" id="img_height" name="img_width" />
		<input type="hidden" value="1920" id="img_width" name="img_height" />
		<input type="text" value="<?php if(isset($_POST['goal'])){echo $_POST['goal'];}?>" name="goal" maxlength="15" placeholder="No added sugar">

    <div id="colorPicker">
      <a class="color"><div class="colorInner"></div></a>
      <div class="track"></div>
      <ul class="dropdown"><li></li></ul>
      <input name="bg_color" type="hidden" class="colorInput"/>
    </div>

		<input name="submit" type="submit" class="" value="Make a reminder background" />
	</form>
</div>

<div class="footer">
	<a href="http://wakerlabs.com">© Waker, LLC.</a>
</div>

<?php
}
?>
</body>
</html>
