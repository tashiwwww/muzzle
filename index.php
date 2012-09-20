<?php
require("config.php");
require("muscle.php");
extract($_GET);
$src = MUSIC_ROOT . '/' . $artist.'/'.$album.'/'.$title;
?>

<!DOCTYPE HTML>

<html>
	<head>
		<meta charset="utf-8">
		<title>tashi!</title>
		<link rel="stylesheet" type="text/css" href="pink.css" />

		<script type="text/javascript" src="jquery.js"> </script>
		<script type="text/javascript">
			$(document).ready(function() {
				var audio = document.getElementById('audio');
				audio.volume=.2;
				console.log(audio.volume);
				$('a').click(function() {
					var url = $(this).attr('href');
					var tags = url.split('/');
					console.log(tags);
					audio.src = url;
					$("#np").text('NP: ' + tags[1] + ' - ' + tags[3].substring(3,tags[3].search('.mp3')));
					audio.play();
					return false;
				});
			});
		</script>
	</head>
	<body>
		<div id="container">
			<div id="audionp">
				<audio id="audio" controls="controls">
				<source src="<?=$src?>" type="audio/mpeg" />
					Your browser does not support the audio element.
				</audio>
				<p id='np'></p>
			</div>
<?
	if(!is_dir(MUSIC_ROOT)) {
		print("Music Root is not a directory. Please check your configuration.");
	}	
	else {
		$music = (faf(MUSIC_ROOT));
		print(print_table($music));
	}
?>
		</div> <!-- div#container -->
	</body>
</html>
