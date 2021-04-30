<?php
   include 'conn.php';

    $CName =$_POST['categoryname'];
$cid = $_GET['cid'];
    $BPID = $_GET['BPID'];
    $sql ="Update category SET CategoryName = '$CName' WHERE CategoryID = '$cid'";
    mysqli_query($conn,$sql);
    //var_dump($sql);
  if (mysqli_affected_rows($conn)<=0){
      echo "<script>alert('Cannot Update Data,Please Try Again!');</script>";
      die ("<script>window.history.go(-1);</script>");
  }
  else {
    echo "<script>alert('Successfully update data!');</script>";
    echo "<script>window.location.href = 'viewcategory.php?BPID=$BPID';</script>";
  }

 ?>
