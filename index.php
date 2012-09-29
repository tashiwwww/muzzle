<?php
require("config.php");
require("muscle.php");
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
				var $audio = $('#audio');
				var seekbar = document.getElementById('seeker');
				audio.volume=.2;
				//console.log(audio.volume);
				$('table a').click(function() {
					var url = $(this).attr('href');
					var tags = url.split('/');
		//			console.log(tags);
					audio.src = url;
					$("#np").text('NP: ' + tags[1] + ' - ' + tags[3].substring(3,tags[3].search('.mp3')));
					audio.play();

					$.post('lyrics.php',{ file: url },function(lyrics) {
						if(lyrics.length > 7) {
							$("#lyrics").text(lyrics);
						}
						else { $("#lyrics").text(''); }
					});
					return false;
				});
				audio.addEventListener("canplay",function() {
					seekbar.max = audio.duration;
				},false);
				audio.addEventListener("timeupdate",function() {
					seekbar.value = audio.currentTime;
				},false);
				function seekVideo() {
				  video.currentTime = seekbar.value;
				}
				function updateUI() {
				  seekbar.value = video.currentTime;
				}
				$("#seeker").change(function() {
					audio.currentTime = seekbar.value;
				});	
				$('#pause').click(function() {
					audio.pause();	
				});
				$('#play').click(function() {
					audio.play();
				});
				$('#loop').click(function() {
					var $looper = $(this);
					if($audio.attr('loop')) {
						$audio.removeAttr('loop');
						$looper.removeClass('loopon');
						$looper.addClass('loopoff');
					}
					else {
						$audio.attr('loop','loop');
						$looper.removeClass('loopoff');
						$looper.addClass('loopon');
					}
				});
				$('#volume').change(function() {
					audio.volume = $(this).val();
				});
				$('#stop').click(function() {
					$("#np").text('Nothing playing.');
					audio.src = '';
				});

			});
		</script>
	</head>
	<body>
		<div id="container">
			<div id="audionp">
				<div id="player">
					<div id="buttons">
						<div id="play"></div>
						<div id="pause"></div>
						<div id="stop"></div>
						<div id="loop" class="loopoff"></div>
					</div>
					<div id="volumecontainer">
						<input id="volume" type="range" min="0" max="1" step="0.1" value="0.2"/>
					</div>
					<div id="npcontainer">
						<p id='np'>Nothing playing.</p>
					</div>
					<div id="seekercontainer">
						<input id="seeker" type="range" step="any" value="0">
					</div>
				</div>
				<audio id="audio">
				<source src="<?=$src?>" type="audio/mpeg" />
					Your browser does not support the audio element.
				</audio>
			</div>
			<div id="lyricscontainer">
				<p id="lyrics"></p>
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
