<?php
include 'conn.php';

$TeamID = $_GET['TeamID'];
$UID = $_GET['UID'];
$TeamName = $_POST['TeamName'];
$TeamType = $_POST['TeamType'];
$TeamDesc = $_POST['TeamDesc'];

$SQL ="Update team SET TeamName = '$TeamName', TeamType='$TeamType', TeamDesc = '$TeamDesc' WHERE TeamID = '$TeamID';";

mysqli_query($conn,$SQL);

if (mysqli_affected_rows($conn)<=0){
    echo "<script>alert('Cannot Update Data!');</script>";
    die ("<script>window.history.go(-1);</script>");
}
else {
  echo "<script>alert('Successfully update data!');</script>";
  echo "<script>window.location.href = 'EditGroup.php?TeamID=$TeamID&UID=$UID';</script>";
}

 ?>
