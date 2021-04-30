<?php
include 'conn.php';
$TeamID = $_GET['TeamID'];
$UID = $_GET['UID'];
$MemberEmail = $_POST['MemberEmail'];


$CheckUsersql = "SELECT UserEmail, UserID FROM user WHERE UserEmail = '$MemberEmail' AND UserStatus='0';";
$UserIDGet = mysqli_query($conn,$CheckUsersql);
if ($UserRow = mysqli_fetch_array($UserIDGet)) {
  $UserID = $UserRow['UserID'];
  $InsertUserMemberSQL = "INSERT INTO userteamroles (UserID,TeamID,UserRole) VALUES ('$UserID', '$TeamID', '0');";
  mysqli_query($conn,$InsertUserMemberSQL);

  if (mysqli_affected_rows($conn)<=0) {
    echo "<script>alert('Unable to add member! The user may join the group. Please Try again.');</script>";
    echo "<script>window.location.href = 'ManageGroupMember.php?TeamID=$TeamID&UID=$UID';</script>";
  }

  else {
    echo "<script>alert('Added Successfully.');</script>";
   echo "<script>window.location.href = 'ManageGroupMember.php?TeamID=$TeamID&UID=$UID';</script>";
  }
}
else {
  echo "<script>alert('Unable to get User Info');</script>";
  echo "<script>window.location.href = 'ManageGroupMember.php?TeamID=$TeamID&UID=$UID';</script>";
}





?>
