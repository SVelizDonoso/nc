<?php

class MyDB extends SQLite3{
	function __construct($filename){
		$this->open($filename);
	}
}
$filename ="project.db";
$db = new MyDB($filename);
if(!$db){
	echo "The database could not be opened!<BR />";
} 

// Create a table.
$db->query('CREATE TABLE IF NOT EXISTS "proj" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "name" TEXT,
    "desc" TEXT,
    "idproj" TEXT,
    "db" TEXT
)');

?>

