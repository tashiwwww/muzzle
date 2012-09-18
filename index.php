<!DOCTYPE HTML>

<html>
	<head>
		<meta charset="utf-8">
		<title>tashi!</title>
	</head>
	<body>
		<audio controls="controls">
		  <source src="horse.mp3" type="audio/mpeg" />
		  Your browser does not support the audio element.
		</audio>
	<?php
		$root = array_slice(scandir('music'),2);
		foreach($root as $artist) {
			print_r($artist);
		}	
?>
	</body>
</html>
