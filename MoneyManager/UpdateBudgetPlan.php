 <?php
 include 'conn.php';

 $BPID = $_GET['BPID'];
 $BudgetTitle = $_POST['BudgetTitle'];
 $BudgetTeam = $_POST['PlanTeam'];

 if($_FILES['PlanImg']['size'] != 0){
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
$sql = "Update budgetplan SET BudgetTitle = '$BudgetTitle' ";
if ($BudgetTeam == 'No Team') {
  $sql .= ", TeamID = NULL , BudgetPlanImg = '$target_file' WHERE BudgetPlanID = '$BPID';";
}else {
  $sql .= ",  TeamID = '$BudgetTeam' , BudgetPlanImg = '$target_file' WHERE BudgetPlanID = '$BPID';";
}
}

else {
  $sql = "Update budgetplan SET BudgetTitle = '$BudgetTitle' ";
  if ($BudgetTeam == 'No Team') {
    $sql .= ", TeamID = NULL WHERE BudgetPlanID = '$BPID';";
  }elseif ($BudgetTeam !== 'No Team') {
    $sql .= ", TeamID = '$BudgetTeam' WHERE BudgetPlanID = '$BPID';";
  }
}


 mysqli_query($conn,$sql);

 if (mysqli_affected_rows($conn)<=0){
     echo "<script>alert('Cannot Update Data!');</script>";
     //var_dump($sql);
     die ("<script>window.history.go(-1);</script>");
 }
 else {
   echo "<script>alert('Successfully update data!');</script>";
   echo "<script>window.location.href = 'EditBudgetPlan.php?BPID=$BPID';</script>";
 }

  ?>
