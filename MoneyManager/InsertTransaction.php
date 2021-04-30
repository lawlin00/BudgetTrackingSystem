<?php
$BPID = $_GET['BPID'];
$Date = $_POST['Date'];
$TransactionType = $_POST['TransactionType'];
$Category = $_POST['Category'];
$Amount = $_POST['Amount'];
$TransactionDesc = $_POST['TransactionDesc'];

include 'conn.php';
if (!empty($Category)) {
  $checkcategorytype =  "SELECT * from Category WHERE CategoryID = '$Category';";
  $result2 = mysqli_query($conn,$checkcategorytype);
  if ($row = mysqli_fetch_assoc($result2)) {
      $CategoryType = $row['CategoryType'];
  }
}else {
  echo "<script>alert('Please Select Category.');</script>";
}

if ($CategoryType != $TransactionType) {
  echo "<script>alert('The selected category is not for $TransactionType type. Please select a suitable category.');</script>";
  die ("<script>window.history.go(-1);</script>");
}else {


if($_FILES['TransactionImg']['size'] != 0) {
  $target_dir = "css/Image/TransactionImg/"; //specifies the directory where the file is going to be placed
  $target_file = $target_dir .basename($_FILES["TransactionImg"]["name"]); //specific path of the file to be uploaded
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); //set extention to lower case
//check if image file is a actual img
$check = getimagesize($_FILES["TransactionImg"]["tmp_name"]);
if($check !== false){
//  echo "<script>alert('File is an image -". $check["mime"]."');</script>";
  $uploadOk =1;
}
else {
  echo "<script>alert('File is not an image. Please try again!');</script>";
  //die ("<script>window.history.go(-1);</script>");
  $uploadOk =0;
}

//check is the file repeat
if (file_exists($target_file)){
  echo "<script>alert('file already exists.');</script>";
  //die ("<script>window.history.go(-1);</script>");
  $uploadOk = 0;
}
//check file type
if($imageFileType !="jpg" && $imageFileType !="jpeg" && $imageFileType !="png" & $imageFileType !="gif"){
  echo "<script>alert('Sorry, only allowed JPG, JPEG, PNG and GIF files.');</script>";
  $uploadOk=0;
}

If ($uploadOk == 0){
  echo "<script>alert('Sorry, your files was not uploaded.');</script>";
//  die ("<script>window.history.go(-1);</script>");
}
else {
  if(move_uploaded_file($_FILES["TransactionImg"]["tmp_name"],$target_file)){
    echo "<script>alert('The file". basename($_FILES["TransactionImg"]["name"])."has been uploaded.');</script>'";
  }
  else {
    echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
    //die ("<script>window.history.go(-1);</script>");
  }
}

}
// No file was selected for upload, your (re)action goes here


$sql="INSERT INTO actualtransaction (BudgetPlanID, CategoryID, TransactionDate, TransactionType, TransactionDesc, TransactionAmount, TransactionDescImg) VALUES ";


if (!strlen(trim($TransactionDesc)) &&  $_FILES['TransactionImg']['size'] == 0) {
  $sql .= "('$BPID', '$Category', '$Date', '$TransactionType', NULL,'$Amount', NULL);";
}elseif (!strlen(trim($TransactionDesc))  &&   $_FILES['TransactionImg']['size'] != 0) {
  $sql .= "('$BPID', '$Category', '$Date', '$TransactionType', NULL,'$Amount', '$target_file');";
}elseif (strlen(trim($TransactionDesc))  &&   $_FILES['TransactionImg']['size'] == 0) {
  $sql .= "('$BPID', '$Category', '$Date', '$TransactionType', '$TransactionDesc','$Amount',NULL );";
}else {
  $sql .= "('$BPID', '$Category', '$Date', '$TransactionType', '$TransactionDesc','$Amount', '$target_file');";
}


mysqli_query($conn,$sql);

if (mysqli_affected_rows($conn)<=0){
  //var_dump($sql);
  echo "<script>alert('Unable to add information! Please try again.');</script>";
      die("window.history.go(-1);</script>");
}
else {
//  var_dump($sql);
  echo "<script>alert('Added Successfully.');</script>";
  echo "<script>window.location.href = 'BudgetPlanHome.php?BPID=$BPID';</script>";
}
}


 ?>
