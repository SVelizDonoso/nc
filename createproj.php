<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("db.php");

if($_POST){
	$salt = "saltASDGFTTDDEEggssga6366772362###@*()";
	$nom = $db->escapeString ($_POST['nom']);
	$desc = $db->escapeString ($_POST['desc']);
	$code = sha1(time().''.$salt);

	if ($db->query("INSERT INTO proj (name,desc,idproj,db) VALUES ('$nom','$desc','$code','db/$code.db')")) {
	    echo "New record created successfully";
	    if(!is_dir("upload/")){
                mkdir("upload/",0777);
              
            }
	    if(!is_dir("upload/".$code)){
                mkdir("upload/".$code, 0777);
              
            }
            if(!is_dir("db/")){
                mkdir("db/", 0777);
              
            }

	} else {
	    echo "Error to Create Poject!";
	}
	
}

?>
