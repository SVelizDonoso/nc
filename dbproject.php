<?php

class MyDB2 extends SQLite3{
	function __construct($filename){
		$this->open($filename);

	}

}

function createdb($dbs){
	$dbs->query('CREATE TABLE IF NOT EXISTS "vuln" (
	    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
	    "risk" TEXT,
	    "ip" TEXT,
	    "port" INTEGER,
	    "protocol" TEXT,
	    "os" TEXT,
	    "cpe" TEXT,
	    "svc_name" TEXT,
	    "plugin_name" TEXT,
	    "cvss_base_score" REAL,
	    "ccvss_vector" TEXT,
	    "Recommendation" TEXT
	)');
}
	
function insertdb($dbs,$risk,$ip,$port,$protocol,$os,$cpe,$svc_name,$plugin_name,$cvss_base_score,$ccvss_vector,$Recommendation){

	$query = <<<EOD
		INSERT INTO vuln 
		(risk,ip,port,protocol,os,cpe,svc_name,plugin_name,cvss_base_score,ccvss_vector,Recommendation)
		VALUES
		(
		 '$risk',
		 '$ip',
		  $port,
		 '$protocol',
		 '$os',
		 '$cpe',
		 '$svc_name',
		 '$plugin_name',
		 $cvss_base_score,
		 '$ccvss_vector',
		 '$Recommendation'
		) 
EOD;

	$dbs->query($query);
	//echo '<br><br>';
	
	
	
}



?>
