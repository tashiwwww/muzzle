<?php
require("config.php");
if(isset($_POST['file'])) {
	$file = $_POST['file'];
	$file = str_replace('mp3','txt',$file);
	$file = str_replace('ogg','txt',$file);
	if(OS == 'windows') {
		$file = iconv('utf-8','shift-jis',$file);
	}
	if(file_exists($file)) {
		echo file_get_contents($file);
	}
	else {
		//silently fail
	}
}

?>
