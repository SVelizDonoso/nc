<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="NessusParser">
  <meta name="author" content="svelizd">

  <title>Nessus Consolidator</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
  
    <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery-3.4.1.js"></script>
  <script src="vendor/jquery.dataTables.min.js"></script>
  <script src="vendor/dataTables.bootstrap4.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
<script>
$(document).ready(function() {
    var table = $('#example').DataTable( {   
    	"lengthMenu": [[5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "All"]],    
        scrollX:        true,
        scrollCollapse: true,
        autoWidth:      false,  
        paging:         true,
        columnDefs: [{
                orderable: false
            }],
        order: [[9, 'desc']]    
        
    } );
} );
</script>

</head>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="#">Nessus Consolidator</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">   
            <a class="nav-link" href="#" data-toggle="modal" data-target=".bd-example-modal-lg">About</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<div class="container-fluid">
  	<div class="col-md-12">
<?php

if ((isset($_GET['code']) && !empty($_GET['code'])) ){

		$code = htmlentities($_GET['code']);
		$table = "vuln";
		$filename ="db/".$code.".db";

		class MyDB extends SQLite3
		{
			function __construct($filename)
			{
				$this->open($filename);
			}
		}

		$db = new MyDB($filename);
		if(!$db){
			echo "The database could not be opened!<BR />";
			exit();
		} 
	

		$tablesquery = $db->query("PRAGMA table_info(" . $table . ");");
		$numCol = 0;
		while($column = $tablesquery->fetchArray(SQLITE3_ASSOC)){
			$numCol = $numCol+1;
		};
		
		
		echo "<div class='container table-responsive '>";
		echo "<br><br>";
		
       	        echo '<table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">' . PHP_EOL;
       	       
       	        echo '<thead><tr>' . PHP_EOL;
        	

		while ($nomCol = $tablesquery->fetchArray(SQLITE3_ASSOC)) {
			echo '<th>' . $nomCol['name'] . '</th>';
			
		}
		echo '</tr></thead>' . PHP_EOL;
		
		echo "<tbody style='color:#FFFFFF;'>";

		$querycon ="SELECT * FROM vuln ORDER BY cvss_base_score desc;";
		$ret = $db->query($querycon);
		while($row = $ret->fetchArray(SQLITE3_ASSOC)){
			echo "<TR>";
			while ($nmeCol = $tablesquery->fetchArray(SQLITE3_ASSOC)){
				$risk = $row['risk'];
				
				$riesgo = "";
			
				    if($risk=="Critical"){
				    	$riesgo = "#D43F3A";
				    }
				    if($risk =="High"){
				    	$riesgo = "#EE9336";
				    }
				    if($risk =="Medium"){
				    	$riesgo = "#FDC431";
				    }
				    if($risk =="Low"){
				   	 $riesgo = "#3FAE49";
				    }
				    if($risk =="None"){
				   	 $riesgo = "#0071B9";
				    }
			
			
				echo '<TD bgcolor="'.$riesgo .'">' . $row[$nmeCol['name']] . '</TD>';
			}
			echo "</TR>";
		}
	echo '</tbody>';
	
	echo '<tfoot><tr>' . PHP_EOL;
	while ($nomCol = $tablesquery->fetchArray(SQLITE3_ASSOC)) {
		echo '<th>' . $nomCol['name'] . '</th>';
			
	}
	echo '</tr></tfoot>' . PHP_EOL;

        echo '</table>' . PHP_EOL;
        echo "</div>";
        echo "<br><br>";
	
	$db->close();


}
?>    
	</div>
</div>

	<br><br><br><br><br><br><br><br><br><br>
	<footer class="page-footer font-small mdb-color darken-3 pt-4">

	  <!-- Copyright -->
	  <div class="footer-copyright text-center py-3">© 2019 Copyright:
		<a href="https://github.com/SVelizDonoso"> Developer svelizdonoso</a>
	  </div>
	  <!-- Copyright -->

	</footer>
	<!-- Footer -->
	

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     	 <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">About</h5>
      	 </div>
	  <div class="modal-body">
	      <table class='table table-bordered ' >
		      <tr><td>Version:</td><td>Nessus Consolidator 1.0</td></tr>
		      <tr><td>Year:</td><td>2019</td></tr>
		      <tr><td>Developer:</td><td><a href="https://github.com/SVelizDonoso">svelizdonodo</a></td></tr>
		      <tr><td>LICENSE</td><td>GNU General Public License v3.0</td></tr>
	      </table>
          </div>
      <br><br>
    </div>
  </div>
</div>	


</body>

</html>









