<?php

$BudgetTitle = $_POST['BudgetName'];
$BudgetTeam = $_POST['BudgetTeam'];
$UID =$_GET['UID'];

include 'conn.php';

if($_FILES['PlanImg']['size'] != 0) {
  $target_dir = "css/Image/BudgetPlanImg/"; //specifies the directory where the file is going to be placed
  $target_file = $target_dir .basename($_FILES["PlanImg"]["name"]); //specific path of the file to be uploaded
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); //set extention to lower case
//check if image file is a actual img
$check = getimagesize($_FILES["PlanImg"]["tmp_name"]);
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
  if(move_uploaded_file($_FILES["PlanImg"]["tmp_name"],$target_file)){
    echo "<script>alert('The file". basename($_FILES["PlanImg"]["name"])."has been uploaded.');</script>'";
  }
  else {
    echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
    //die ("<script>window.history.go(-1);</script>");
  }
}
}
// No file was selected for upload, your (re)action goes here



$sql = "INSERT INTO budgetplan (UserID,TeamID,BudgetTitle,BudgetPlanImg) VALUES ";

if ($BudgetTeam == 'No Team' &&  $_FILES['PlanImg']['size'] == 0) {
  $sql .= "('$UID',NULL,'$BudgetTitle',NULL);";
}elseif ($BudgetTeam !== 'No Team' &&   $_FILES['PlanImg']['size'] == 0) {
  $sql .= "('$UID',$BudgetTeam,'$BudgetTitle',NULL);";
}elseif ($BudgetTeam == 'No Team' &&  $_FILES['PlanImg']['size'] != 0) {
  $sql .= "('$UID',NULL,'$BudgetTitle','$target_file');";
}else {
  $sql .= "('$UID','$BudgetTeam','$BudgetTitle','$target_file');";
}


mysqli_query($conn,$sql);

if (mysqli_affected_rows($conn)<=0){
 // var_dump($sql);
  echo "<script>alert('Unable to add budgetplan information! Please try again.');</script>";
      die("window.history.go(-1);</script>");
}
else {
  //var_dump($sql);
//  echo "<script>alert('Added Successfully.');</script>";
  $BPsql = "SELECT BudgetPlanID From budgetplan Order By BudgetPlanCreatedDate desc LIMIT 1;";
  $BPresult = mysqli_query($conn,$BPsql);
  If (mysqli_num_rows($BPresult)<=0){
    echo "<script>alert('Technical Errors.');</script>";
    //echo "<script>window.location.href = 'UserHome.php';</script>";
  }else{
    if ($BudgetPlanRows = mysqli_fetch_array($BPresult)){
      $BPID = $BudgetPlanRows['BudgetPlanID'];
    }
      $csql = "Insert Into category (CategoryName, CategoryType, BudgetPlanID) VALUES ('Food', 'Expenses', '$BPID'), ('Full Time', 'Income', '$BPID');";
      $cresult=  mysqli_query($conn,$csql);
      if (mysqli_affected_rows($conn)<=0) {
        echo "<script>alert('Unable to add budgetplan information! Please try again.');</script>";
      }else {
      echo "<script>alert('Added Successfully.');</script>";
        echo "<script>window.location.href = 'UserHome.php';</script>";
      }

}
}


 ?>
