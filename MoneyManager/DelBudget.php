<?php

  include 'conn.php';
  $BID = intval($_GET['BID']); //Get contact if from delete btn , make it become integer value
  $BPID = intval($_GET['BPID']);
  $sql = "DELETE FROM budget WHERE BudgetID = $BID";
  $result = mysqli_query($conn,$sql);
  //check if the data delete or not
  if (mysqli_affected_rows($conn)<=0) {//Not delete, alert msg
    echo "<script>alert('Unable to delete data!');";
    die ("window.location.href = 'BudgetPlanHome.php?id=$BPID';</script>");
  }
else {
  echo "<script>alert('Delete Successfully!');</script>";
  echo "<script>window.location.href = 'BudgetPlanHome.php?BPID=$BPID'</script>";
}

 ?>
