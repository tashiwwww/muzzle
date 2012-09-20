<?php
function rscan($dir) {
	$path = $dir;
	$files = array();
	$root = array_slice(scandir($dir),2);
	foreach($root AS $child) {
		$path .= "/";
		$path .= $child;
		if(is_dir($path)) {

		}
		else {
			$files[] = $child;
		}
	}
	return $files;
}

function faf($dir) 
{ 
    $root = scandir($dir); 
    foreach($root as $value) 
    { 
        if($value === '.' || $value === '..') {continue;} 
        if(is_file("$dir/$value")) {$result[]="$dir/$value";continue;} 
        foreach(faf("$dir/$value") as $value) 
        { 
			if(substr($value,-4) == ".mp3") {
				$result[]=$value; 
			}
        } 
    } 
    return $result; 
} 

function fromsjis($str) {
	//convert string from sjis to utf8
	$str = iconv('shift-jis','utf-8',$str);
	return $str;
}

function print_table($arr) {
	$html = "<table>";
	$html .= "<tr>";
	$html .= "<th>Artist</th>";
	$html .= "<th>Title</th>";
	$html .= "</tr>";
	foreach($arr AS $song) {
		$tags = explode("/",$song);
		if(substr(PHP_OS,0,3) == 'WIN') {
			$tags = array_map(fromsjis,$tags);
		}
		$artist = $tags[1];	
		$album = $tags[2];
		$file = $tags[3];
		$title = substr($tags[3],2,-4);	
		$url = MUSIC_ROOT . '/' . $artist .'/'. $album .'/'. $file;	


		$html .= "<tr>";
		$html .= "<td class='artist'>$artist</td>";
		$html .= "<td><a href='$url'>$title</a></td>";
		$html .= "</tr>";
	}
	$html .= "</table>";
	return($html);
}
?>
