<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("db.php");
$result =$db->query("SELECT * FROM proj");

while ($row = $result->fetchArray()){
  $codep = $row[3];
  echo "<tr>";
  echo "<td><b>Name:</b> ".$row[1]."</td>";
  echo "<td><a href='project.php?cod=$codep' >Go To Project</a></td>";
  echo '<td><a href="#" id="'.$codep.'" onclick="delproject(this)" >Delete Project</a></td>';
  echo "</tr>";
}


?>

