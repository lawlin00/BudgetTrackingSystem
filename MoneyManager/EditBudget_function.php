<?php
  //  session_start();
    include ("conn.php");

    $month = $_POST['month'];
    $budgettype = $_POST['type'];
    $description = $_POST['desc'];
    $amount = $_POST['amount'];
    $BPID = $_GET['BPID'];
    $category = $_POST['Category'];
    $BID = $_GET['BID'];

    if (!empty($category)) {
      $checkcategorytype =  "SELECT * from Category WHERE CategoryID = '$category';";
      $result2 = mysqli_query($conn,$checkcategorytype);
      if ($row = mysqli_fetch_assoc($result2)) {
          $CategoryType = $row['CategoryType'];
      }
    }else {
      echo "<script>alert('Please Select Category.');</script>";
    }

    if ($CategoryType != $budgettype) {
      echo "<script>alert('The selected category is not for $budgettype type. Please select a suitable category.');</script>";
      die ("<script>window.history.go(-1);</script>");
    }

    $sql_update = "UPDATE budget SET CategoryID = '$category', BudgetMonth = '$month', BudgetType = '$budgettype', BudgetDesc = '$description', BudgetAmount = '$amount' WHERE BudgetPlanID = '$BPID' and BudgetID = '$BID'";
    $result = mysqli_query($conn, $sql_update);

    if(mysqli_affected_rows($conn)<=0){
        echo "<script>alert('Failed to update budget. Please try again.');</script>";
        die("<script>window.history.go(-1);</script>");
    }else{
        echo "<script>alert('Update successfully!');</script>";
        echo "<script>window.location.href='BudgetPlanHome.php?BPID=$BPID';</script>";
    }
?>
