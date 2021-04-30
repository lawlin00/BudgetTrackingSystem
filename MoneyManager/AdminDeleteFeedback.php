<?php

  include 'conn.php';
  $fid = intval($_GET['fid']); 
  //$replyId = intval($_GET['rid']); 

  
  $sql2="SELECT * FROM reply INNER JOIN feedback on reply.FeedbackID = feedback.FeedbackID WHERE reply.FeedbackID = '$fid'";
                 
                      $result2 = mysqli_query($conn,$sql2);
                      if (mysqli_num_rows($result2)>=1){
												$rows = mysqli_fetch_assoc($result2);
												$replyId= $rows['FeedbackID'];
		if($replyId == $fid){
    echo "<script>alert('Please Delete Reply Details First!')</script>";
    echo "<script>window.history.go(-1);</script>";
  } }else  {
    $sql = "DELETE FROM feedback WHERE FeedbackID = $fid ";
    var_dump($sql);
    $result = mysqli_query($conn,$sql);
   
    if (mysqli_affected_rows($conn)<=0){//Not delete, alert msg
    echo "<script>alert('Unable to delete data!');</script>";
   echo"<script>window.location.href = 'AdminManageFeedback.php';</script>";
  }
else {
  echo "<script>alert('Delete Successfully!');</script>";
  echo "<script>window.location.href = 'AdminManageFeedback.php'</script>";
}
  }
                      
                      

 ?>
