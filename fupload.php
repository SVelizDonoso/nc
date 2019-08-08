<?php
error_reporting(-1);
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include("dbproject.php");

$affected = '#[AffectedHosts]#' . PHP_EOL;
$stack = array();
$n = NULL;
$critical = 0;
$high = 0;
$medium = 0;
$low = 0;
$info = 0;
$os = NULL;
$cpe =NULL;


if($_FILES){
	if (!empty($_FILES['filename']) && !empty($_POST['code'])) {
	        $code = htmlentities($_POST['code']);
		$target = "upload/".$code."/". $_FILES["filename"]["name"];
		move_uploaded_file($_FILES['filename']['tmp_name'], $target);
		 
	} else {
		echo "No files found for upload."; 
		exit();
	}
	
		
	if (file_exists($target)) {
	$nessus = simplexml_load_file($target) or die(); // *.nessus
	
	$db2 = new MyDB2 ("db/$code.db");
	if(!$db2){
		echo "Error open db<BR />";
		exit();
	} 
	
	createdb($db2);
	    foreach ($nessus->Report[0]->ReportHost as $host) {
		
		foreach($host->HostProperties->tag as $tags){
			//echo $tags->attributes()->name. '<br>';
			$nametag = (string) $tags->attributes()->name;
			//var_dump($nametag == "os");
			//echo '<br>';
			if($nametag =="operating-system"){
				$os = $tags;
	       		 }
	       		if($nametag =="cpe-1"){
	       			$cpe =$tags;
	       		} 
		}
		

		foreach ($host->ReportItem as $bug) {
		        $risk = (string) $bug->risk_factor;
			$ip = (string) $host['name'];
			$port = (int) $bug->attributes()->port;
			$protocol= (string) $bug->attributes()->protocol;
			$os = (string) $os;
			$cpe =  (string) $cpe;
			$svc_name= (string) $bug->attributes()->svc_name;
			$plugin_name = (string) htmlentities($bug->plugin_name,ENT_QUOTES);
			$ccvss_vector = (string) $bug->cvss_base_score;
			$cvss_vector =  str_replace('CVSS2#', '', (string) $bug->cvss_vector);
			$Recommendation =  (string) htmlentities($bug->solution,ENT_QUOTES);
			if($ccvss_vector==''){$ccvss_vector = 0.0; }
			if($cvss_vector==''){ $cvss_vector= 'n/a'; }
			if($cpe==''){ $cpe= 'n/a'; }
		        insertdb($db2,$risk,$ip,$port,$protocol,$os,$cpe,$svc_name,$plugin_name,$ccvss_vector,$cvss_vector,$Recommendation);    

		}
	    }
	     echo 'File Upload and Parse SQL!';

	}else{
        	echo "Error Read File .nessus!";
        	exit();
	}
	
	
	

}
?>
