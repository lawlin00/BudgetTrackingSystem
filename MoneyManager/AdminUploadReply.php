<?php include 'conn.php';


$Rcomment = mysqli_real_escape_string($conn,$_POST['Rcomment']);
$fid = mysqli_real_escape_string($conn,$_POST['fid']);
$uid = mysqli_real_escape_string($conn,$_POST['uid']);


$sql = "INSERT INTO reply (UserID, FeedbackID, ReplyDesc) VALUES".
"('$uid','$fid','$Rcomment');";

mysqli_query($conn,$sql);
//var_dump($sql);
if (mysqli_affected_rows($conn)<=0){
echo "<script>alert('Reply failed,Please Try Again!');</script>";
die ("<script>window.history.go(-1);</script>");
}
else {
echo "<script>alert('Successfully reply!');</script>";
echo "<script>window.location.href = 'AdminManageFeedback.php';</script>";
}

?>
