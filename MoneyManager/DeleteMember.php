<?php

  include 'conn.php';
  $UserID = intval($_GET['UserID']); //Get contact if from delete btn , make it become integer value
  $TeamID = intval($_GET['TeamID']);
  $UID = $_GET['UID'];
  $CheckNoAdmin = "SELECT count(UserID) AS AdminNumber FROM userteamroles WHERE TeamID=$TeamID AND UserRole = '1';";
  $AdminResult = mysqli_query($conn,$CheckNoAdmin);
  $CheckAdmin = "SELECT UserRole FROM userteamroles WHERE TeamID=$TeamID AND UserID = '$UID';";
  $AdminResult2 = mysqli_query($conn,$CheckAdmin);
  //var_dump($CheckNoAdmin);

  if (mysqli_num_rows($AdminResult)<=0 || mysqli_num_rows($AdminResult2)<=0 ) {
        echo "<script>alert('Technical Errors');<script>";
        echo "<script>window.history.go(-1);</script>";
  }else {
    $AdminRows = mysqli_fetch_assoc($AdminResult);
    $NumberAdmin = $AdminRows['AdminNumber'];
    $AdminRow2 = mysqli_fetch_assoc($AdminResult2);
    $AdminOrNot = $AdminRow2['UserRole'];
  }

  if ($NumberAdmin <=1 && $AdminOrNot == 1) {
    echo "<script>alert('Number of admin not enough, please make sure there is at least two admin (including yourself) before leave group!')</script>";
    //echo "<script>window.history.go(-1);</script>";
  }else {
    $sql = "DELETE FROM userteamroles WHERE UserID = $UserID AND TeamID=$TeamID";
    $result = mysqli_query($conn,$sql);
    //check if the data delete or not
    if ($UID == $UserID) {
      if (mysqli_affected_rows($conn)<=0) {//Not delete, alert msg
        var_dump($sql);
        echo "<script>alert('Unable to delete!');";
        die ("window.location.href = 'UserHome.php';</script>");
      }
    else {
      echo "<script>alert('Leave Group Successfully!');</script>";
      echo "<script>window.location.href = 'UserHome.php';</script>";
    }
    }else {
      if (mysqli_affected_rows($conn)<=0) {//Not delete, alert msg
        echo "<script>alert('Unable to delete!');";
        die ("window.location.href = 'ManageGroupMember.php?TeamID=$TeamID&UID=$UID';</script>");
      }
    else {
      echo "<script>alert('Delete Successfully!');</script>";
      echo "<script>window.location.href = 'ManageGroupMember.php?TeamID=$TeamID&UID=$UID';</script>";
    }
    }
  }




 ?>
