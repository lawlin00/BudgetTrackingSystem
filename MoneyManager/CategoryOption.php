<?php
include 'conn.php';
$BPID = "33";
if (!empty($_POST["type"])) {
  // code...
  $sql = "SELECT * FROM Category WHERE BudgetPlanID = '33' AND CategoryStatus = '0' Order BY CategoryName asc;
  $result = mysqli_query($conn,$sql);
  $output = '<option>Select Category</option>';
  while ($row = mysqli_fetch_array($result)) {
  $name = $row["CategoryName"];
    $output.= '<option value = "$name">$name</option>';
  }
}


 ?>
