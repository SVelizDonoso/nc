<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("db.php");

function delTree($dir) { 
   $files = array_diff(scandir($dir), array('.','..')); 
    foreach ($files as $file) { 
      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
    } 
    return rmdir($dir); 
} 

if($_POST){
	$code = $db->escapeString($_POST['cod']);
	if ($db->query("DELETE FROM proj WHERE idproj='$code'")) {
	    delTree('upload/'.$code);
	    unlink('db/'.$code.'.db');
	    echo "Delete Poject successfully";
	} else {
	    echo "Error to Delete Poject!";
	}

}

?>

