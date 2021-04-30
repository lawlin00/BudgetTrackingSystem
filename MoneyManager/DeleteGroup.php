<?php

  include 'conn.php';
  $TeamID = intval($_GET['TeamID']); //Get contact if from delete btn , make it become integer value
  $sql = "Update team SET TeamStatus = '1' WHERE TeamID = '$TeamID';";
  $result = mysqli_query($conn,$sql);
  //check if the data delete or not
  if (mysqli_affected_rows($conn)<=0) {//Not delete, alert msg
    echo "<script>alert('Unable to delete data!');</script>";
    var_dump($sql);
  //  die ("window.location.href = 'GroupHome.php?id=$TeamID';</script>");
  }
else {
  echo "<script>alert('Delete Successfully!');</script>";
  echo "<script>window.location.href = 'UserHome.php';</script>";
}
$sql2 = "Update budgetplan SET BudgetPlanStatus = '1' WHERE TeamID='$TeamID'";
$result = mysqli_query($conn,$sql2);
//check if the data delete or not
if (mysqli_affected_rows($conn)<=0) {//Not delete, alert msg
  echo "<script>alert('Unable to delete data!');</script>";
  var_dump($sql2);
//  die ("window.location.href = 'GroupHome.php?id=$TeamID';</script>");
}
else {
echo "<script>alert('Delete Successfully!');</script>";
echo "<script>window.location.href = 'UserHome.php';</script>";
}


 ?>
