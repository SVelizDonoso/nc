<?php

function human_filesize($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

if(isset($_GET['cod']) && !empty($_GET['cod'])){
   $code = htmlentities($_GET["cod"]);
   include("db.php");
   $result =$db->query("SELECT * FROM proj WHERE idproj='$code'");
   while ($row = $result->fetchArray()){
  	  $namep = $row[1];
  	  $desc = $row[2];
  	  $codep = $row[3];
	  $database = $row[4];
	  $size = human_filesize('db/'.$database);
	}

 }else{
 	exit();
 }
 
?>

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
  <style>
	#drop_file_zone {
	    background-color: #EEE; 
	    border: #999 5px dashed;
	    width: 290px; 
	    height: 200px;
	    padding: 8px;
	    font-size: 18px;
	}
	#drag_upload_file {
	  width:50%;
	  margin:0 auto;
	}
	#drag_upload_file p {
	  text-align: center;
	}
	#drag_upload_file #selectfile {
	  display: none;
	}
	.centerloading {
	   height: 200px;
	   left: 50%;
	   margin-top: -50px;
	   margin-left: -125px;
	   position: absolute;
	   top: 50%;
	   width: 200px;
	}
  </style>
    <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery-3.4.1.js"></script>

  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>

$(document).ready(function () {
    $("#msj").hide();
    $("#loading").hide();
    getproject(); 
});
function getproject(){
html ="";
code = $('#code').val();
	$.ajax({
            type: "POST",
            url: "viewfiles.php",
            data:"cod="+code,
            success: function (data) {
                $('#viewtbl').html(data);
            }
        })
}


var fileobj;
  function upload_file(e) {
    e.preventDefault();
    fileobj = e.dataTransfer.files[0];
    ajax_file_upload(fileobj);
  }
 
  function file_explorer() {
    document.getElementById('selectfile').click();
    document.getElementById('selectfile').onchange = function() {
        fileobj = document.getElementById('selectfile').files[0];
      ajax_file_upload(fileobj);
    };
  }
 
  function ajax_file_upload(file_obj) {
  code = $('#code').val();
   $("#loading").show();
    if(file_obj != undefined) {
        var form_data = new FormData();                  
        form_data.append('filename', file_obj);
        form_data.append('code',code);
      $.ajax({
        type: 'POST',
        url: 'fupload.php',
        contentType: false,
        processData: false,
        data:form_data,
        success:function(response) {
          $("#loading").delay(1000).hide(100);
          $("#msj").html(response).show(100).delay(2500).hide(150);
          $('#selectfile').val('');
          getproject();
        }
      });
    }
  }
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

  <!-- Page Content -->
  <div class="container">
   
        <div class="row">
		<div class="col-lg-12 "><br>
		<table class='table table-bordered' id="proyect">
			<tr>
			<td>Name: <?php echo $namep; ?></td><td>Description: <?php echo $desc; ?></td>
			</tr>
			<tr>
			<td>Code: <?php echo $codep; ?></td>
			<td>
				<a href='<?php echo $database; ?>'>
					<button type="button" class="btn btn-primary">Download SQLite <?php echo human_filesize(filesize($database)); ?></button>
				</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="viewdb.php?code=<?php echo $codep; ?>">
					<button type="button" class="btn btn-success">View SQL</button>
				</a>
			</td>
			</tr>
		</table>
		</div>
        </div>
        
        <div class="row">
		<div class="col-lg-12 "><br>
			<img src='vendor/loading.gif' id='loading' style="display: none;" class="centerloading">
			
		</div>
        </div>
        <div class="row">
	  <div class="col-4">
	  		 
			 <div class="jumbotron">
			  <h2>Import Nessus File</h2>
			  
			  
			  
				<div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false" class="d-flex justify-content-center">
				  <div id="drag_upload_file">
				    <p>Drop file here</p>
				    <p>or</p>
				    <p><input type="button" value="Select File" onclick="file_explorer();"></p>
				    <p><input type='text' name='code' id='code' value="<?php echo $codep; ?>" hidden></p>
				    <input type="file" id="selectfile">
				  </div>
				</div>	  
			  
			  

			 </div>
	  </div>
	  <div class="col-8">
	  			<h2>File Uploads</h2>
	     			<table class='table table-bordered' id="viewtbl"></table>
	  </div>
	</div>
        
        <div class="row">
		<div class="col-lg-12 "><br>
			
			<br><div class="alert alert-success" role="alert" id='msj' style="display: none;"> </div>
		</div>
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

  </div>
  



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
