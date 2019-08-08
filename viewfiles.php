<?php

function human_filesize($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

if(isset($_POST['cod']) && !empty($_POST['cod'])){
	$cod =htmlentities($_POST['cod']);
	$dir = 'upload/'.$cod;
	foreach (scandir($dir, 1) as $file) {
		if (preg_match('/\.nessus$/i', $file)) {
		  $size = human_filesize(filesize($dir.'/'.$file));
		  $dateLast = date("F d Y H:i:s.",filemtime($dir.'/'.$file));
		  echo '<tr><td><a href="' . $dir.'/'.$file . '">' . $file . '</a></td><td>'.$size.' .</td><td>'.$dateLast.'</td></tr>' . PHP_EOL;
		}
	}


}			

?>
