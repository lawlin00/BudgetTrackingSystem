<?php

  include 'conn.php';

  $ReplyID = intval($_GET['rid']); 

    $sql = "DELETE FROM reply WHERE ReplyID = $ReplyID ";
    //var_dump($sql);
    $result = mysqli_query($conn,$sql);
   
    if (mysqli_affected_rows($conn)<=0){//Not delete, alert msg
        echo "<script>alert('Unable to delete data!');</script>";
       echo"<script>window.location.href = 'AdminManageFeedback.php';</script>";
  }
else {
  echo "<script>alert('Delete Successfully!');</script>";
  echo "<script>window.location.href = 'AdminManageFeedback.php'</script>";
}
  


 ?>
