<?php
  //  session_start();
    include ("conn.php");

    $month = $_POST['month'];
    $budgettype = $_POST['type'];
    $description = $_POST['desc'];
    $amount = $_POST['amount'];
    $budgetplan = $_GET['BPID'];
    $category = $_POST['category'];
    
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

    $sql_insert = "INSERT INTO budget (BudgetPlanID, CategoryID, BudgetMonth, BudgetType, BudgetDesc, BudgetAmount)".
                "VALUES ('$budgetplan', '$category', '$month', '$budgettype', '$description', '$amount')";
    $result = mysqli_query($conn, $sql_insert);

    if(mysqli_affected_rows($conn)<=0){
        echo "<script>alert('Failed to add budget. Please try again.');</script>";
        die("<script>window.history.go(-1);</script>");
    }else{
        echo "<script>alert('Added successfully!');</script>";
        echo "<script>window.location.href='BudgetPlanHome.php?BPID=$budgetplan';</script>";
    }

?>
