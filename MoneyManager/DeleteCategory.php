<?php
include "conn.php";
$cid = intval($_GET['cid']);
$sql = "Update category SET CategoryStatus = '1' Where  CategoryID = '$cid'"; 
$result = mysqli_query($conn,$sql); 

//var_dump($sql);
 

//if unsuccefully..then
if (mysqli_affected_rows($conn)<=0)
{
    echo"<script>alert('Unable to delete data!');";
    die("window.history.go(-1);</script>"); 
}
else{
//success fully deteted then;
echo "<script>alert('Data deteted!');";
die("window.history.go(-1);</script>"); 
}
?>