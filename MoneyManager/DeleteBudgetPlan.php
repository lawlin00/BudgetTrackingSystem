<?php

  include 'conn.php';
  $BPID = intval($_GET['BPID']); //Get contact if from delete btn , make it become integer value
  $sql = "Update budgetplan SET BudgetPlanStatus = '1' WHERE BudgetPlanID = '$BPID';";
  $result = mysqli_query($conn,$sql);
  //check if the data delete or not
  if (mysqli_affected_rows($conn)<=0) {//Not delete, alert msg
    echo "<script>alert('Unable to delete data!');";
    die ("window.location.href = 'EditBudgetPlan.php?BPID=$BPID';</script>");
  }
else {
  echo "<script>alert('Delete Successfully!');</script>";
  echo "<script>window.location.href = 'UserHome.php';</script>";
}
//var_dump($sql);

 ?>
