<?php
include 'conn.php';

$TeamName = $_POST['TeamName'];
$TeamType = $_POST['TeamType'];
$TeamDesc = $_POST['TeamDesc'];
$UID = $_GET['UID'];


$CheckTeamNameSQL = "SELECT t.TeamID, t.TeamName, UserID FROM userteamroles ur Inner Join team t on t.TeamID = ur.TeamID WHERE UserID= '$UID' And TeamName = '$TeamName' order by TeamName asc;";
$TeamNameresult = mysqli_query($conn,$CheckTeamNameSQL);

if (mysqli_num_rows($TeamNameresult)>=1){
  //  while ($TeamNameRows = mysqli_fetch_array($TeamNameresult)) {
  //    $TableTeamName = $TeamNameRows['TeamName'];
  //    if ($TableTeamName = $TeamName) {
        echo "<script>alert('The Team Name is exist. Please try another team name.')</script>";
        echo "<script>window.location.href = 'NewGroup2.php';</script>";
  //    }
  //  }
}else {
  $sql = "INSERT INTO team (TeamName, TeamType, TeamDesc) VALUES ('$TeamName','$TeamType','$TeamDesc');";
  mysqli_query($conn,$sql);
  if (mysqli_affected_rows($conn)<=0) {
    var_dump($sql);
    echo "<script>alert('Unable to add Team information!Please Try again.');</script>";
  }
  else {
    echo "<script>alert('Added Successfully.</script>');";
    //echo "<script>window.location.href = 'Hall.php';</script>";
  }
  $getTeamIDsql = "SELECT TeamID, CreateDate FROM team Order By CreateDate Desc LIMIT 1;";

  $TeamIDget = mysqli_query($conn,$getTeamIDsql);
  if ($Teamrow=mysqli_fetch_array($TeamIDget)) {
    $TeamID = $Teamrow['TeamID'];
    $InsertUserAdminSQL = "INSERT INTO userteamroles (UserID,TeamID,UserRole) VALUES ('$UID', '$TeamID', '1');";
    mysqli_query($conn,$InsertUserAdminSQL);

    if (mysqli_affected_rows($conn)<=0) {
      echo "<script>alert('Unable to add admin information!Please Try again.');</script>";
      var_dump($InsertUserAdminSQL);
    }

    else {
      echo "<script>alert('Added Successfully.');</script>";
     echo "<script>window.location.href = 'ManageGroupMember.php?TeamID=$TeamID&UID=$UID';</script>";
    }
  }
  else {
    echo "<script>alert('Unable to get Team Info');</script>";
  }

}


?>
