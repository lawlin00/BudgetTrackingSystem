<?php

  include 'conn.php';
  $UserID = intval($_GET['UserID']); //Get contact if from delete btn , make it become integer value
  $TeamID = intval($_GET['TeamID']);
  $UserRole = intval($_GET['UserRole']);
  $UID = $_GET['UID'];
  $sql = "Update userteamroles SET UserRole = '$UserRole' WHERE UserID = $UserID AND TeamID=$TeamID";
  $result = mysqli_query($conn,$sql);
  //check if the data delete or not
  if (mysqli_affected_rows($conn)<=0) {//Not delete, alert msg
    echo "<script>alert('Unable to Update data!');";
    die ("window.location.href = 'ManageGroupMember.php?TeamID=$TeamID&UID=$UID';</script>");
  }
else {
  echo "<script>alert('Update Successfully!');</script>";
  echo "<script>window.location.href = 'ManageGroupMember.php?TeamID=$TeamID&UID=$UID';</script>";
}
//var_dump($sql);

 ?>
