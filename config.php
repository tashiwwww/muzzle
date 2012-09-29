<?php
define("MUSIC_ROOT","music"); //define root directory where music is stored.

if(substr(PHP_OS,0,3) == 'WIN') {
	define("OS","windows");
}
else { define("OS","notwindows"); }
?>

