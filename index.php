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
		<link rel="stylesheet" type="text/css" href="main.css" />
		<script type="text/javascript" src="jquery.js"> </script>
		<script type="text/javascript">
function hms(d) {
	d = Number(d);
	var h = Math.floor(d / 3600);
	var m = Math.floor(d % 3600 / 60);
	var s = Math.floor(d % 3600 % 60);
	return ((h > 0 ? h + ":" : "") + (m > 0 ? (h > 0 && m < 10 ? "0" : "") + m + ":" : "0:") + (s < 10 ? "0" : "") + s); }

			function movetimer($ele) {
				var prog = audio.currentTime/audio.duration*100;
				prog = prog * .97;
				if(prog > 97) {
					prog = 97;
				}
					$ele.css("margin-left",prog + "%");
			}
			$(document).ready(function() {
				var audio = document.getElementById('audio');
				var $audio = $('#audio');
				var seekbar = document.getElementById('seeker');
				audio.volume=.2;
				//console.log(audio.volume);
				$('table a').click(function() {
					var url = $(this).attr('href');
					var tags = url.split('/');
					var canmp3 = !!audio.canPlayType && "" != audio.canPlayType('audio/mpeg');
					var canogg = !!audio.canPlayType && "" != audio.canPlayType('audio/ogg; codecs="vorbis"');
					if(canmp3) { var ext = '.mp3'; }
					else if(canogg) { var ext = '.ogg'; }
					url = url.replace('.mp3',ext);
					
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
					$("#timer").text(hms(audio.currentTime));
					movetimer($("#timer"));
				},false);

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
					stop();
				});
			});
		function stop() {
			var $timer = $("#timer");
			$("#np").text('Nothing playing.');
			audio.src = '';
			$timer.text('0:00');
			$timer.css('margin-left','0');
			$("#seeker").val(0);
		}
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
					<p id="timer">0:00</p>
				</div>
				<audio id="audio">
				<source src="<?=$src?>" type="audio/mpeg" />
				<source src="<?=$oggsrc?>" type="audio/ogg" />
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
