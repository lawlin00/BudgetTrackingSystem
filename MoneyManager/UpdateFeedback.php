<?php

  include 'conn.php';

  $uid = mysqli_real_escape_string($conn,$_POST['uid']);
  $rating = mysqli_real_escape_string($conn,$_POST['rating']);
  $comment = mysqli_real_escape_string ($conn,$_POST['comment']);
    
  $sql = "INSERT INTO  feedback (UserID, rating ,FeedbackDesc ) VALUES".
         "('$uid','$rating','$comment')";

         mysqli_query($conn,$sql);
         //var_dump($sql);
         
         if(mysqli_affected_rows($conn)<=0){
          echo"<script>alert('Error! Try Again');</script>";
         echo"<script>window.history.go(-1);</script>";
      }
  
      else{
      echo"<script>alert('Upload Successfully!)</script>";
    echo"<script>window.location.href='UserViewFeedback2.php';</script>";
      }
       
       
       ?>
