<?php
include "conn.php";
$userid = intval($_GET['userid']);
$sql = "Update user SET UserStatus = '1' Where  UserID = '$userid'"; 
$result = mysqli_query($conn,$sql); 

//var_dump($sql);
 

//if unsuccefully..then
if (mysqli_affected_rows($conn)<=0)
{
    echo"<script>alert('Unable to delete data!');<script>";
    die("window.history.go(-1);</script>"); 
}
else{
//success fully deteted then;
echo "<script>alert('Data deteted!');</script>";
echo "<script>window.location.href = 'AdminManageUser.php';</script>";
}
?>