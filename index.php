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
    <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery-3.4.1.js"></script>

  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>

$(document).ready(function () {
    $("#msj").hide();
    getproject();
    $("#btnsub").click(function(event){
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "createproj.php",
            data: $('#cproj').serialize(),
            success: function (data) {
                $('#cproj')[0].reset();
                getproject();
                $('#msj').html(data).show(200).delay(2500).hide(200);
            }
        })
    });
});
function getproject(){
html ="";
	$.ajax({
            type: "GET",
            url: "viewproj.php",
            success: function (data) {
                $('#viewtbl').html(data);
            }
        })
}


function delproject(idcod){
ID = $(idcod).attr("id");
html ="";
var r = confirm("Are you sure to delete this project?");
	if (r == true) {
	  	$.ajax({
		    type: "POST",
		    url: "delproject.php",
		    data:"cod="+ID,
		    success: function (data) {
			$('#msj').html(data).show(200).delay(2500).hide(200);
		        getproject();
		    }
		})
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
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
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
      <div class="col-lg-12">
	  <br><br>
	    <div class="jumbotron">
               <h1>Creation of Projects </h1>
		<form id='cproj' action='createproj.php' method='POST'>
		  <div class="form-group"> 
			<label for="formGroupExampleInput" class="bmd-label-floating">Name Project:</label>
			<input type="text" class="form-control" name="nom" placeholder="Name">
		  </div>
		  <div class="form-group bmd-form-group">
			<label for="formGroupExampleInput2" class="bmd-label-floating">Description:</label>
			<textarea class="form-control" name="desc" placeholder="Project Description"></textarea>
		  </div>
		  <button class="btn btn-primary btn-lg" type="submit" id='btnsub'>Create Project</button>
		</form>
	   </div>
      </div>
    </div>
    
    <br><div class="alert alert-success" role="alert" id='msj' style="display: none;"> </div>
    
    <div class="row">
	      <div class="col-lg-12 ">
	      		
			<h1>Projects</h1>
			<table class='table table-bordered' id="viewtbl"></table>
	      </div>
    </div>
	
	<br><br><br>
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









