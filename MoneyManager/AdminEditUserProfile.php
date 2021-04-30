<?php

  include 'conn.php';

    $UID = $_POST['id'];

    $Email = $_POST['email'];
    $Dob =$_POST['dob'];
    $Gender =$_POST['Gender'];
    $password = $_POST['password'];
    $passwordhash = password_hash($password, PASSWORD_BCRYPT);
    $Role = $_POST['role'];
    $Username = $_POST['username'];
    // File upload path
//$targetDir = "Image/";
//$fileName = basename($_FILES['img']['name']);
//$targetFilePath = $targetDir . $fileName;
//$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

//if(!empty($_FILES["img"]["name"])){
    // Allow certain file formats
  //  $allowTypes = array('jpg','png','jpeg','gif','pdf');
    //if(in_array($fileType, $allowTypes)){
        // Upload file to server
      //  if(move_uploaded_file($_FILES["img"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
          //  $insert = $db->query("INSERT into user (User_Profile) VALUES ('".$fileName."'");
        //    if($insert){
              //  echo "<script>alert('Succeessful Uploaded.');</script>";
            //}else{
                //echo "<script>alert('Unsuccessful Uploaded. Please try again!');</script>";
            //}
        //}
   // }
//}
  //  $sql ="Update user SET User_Name = '$Name', User_Email = '$Email', User_DOB = '$Dob' , User_Gender = '$Gender' , User_Username = '$Username', User_Role = '$Role' , User_Password = '$Psw' WHERE User_ID = $UID;";


//  mysqli_query($conn,$sql);

//  if (mysqli_affected_rows($conn)<=0){
//      echo "<script>alert('Cannot Update Data!');</script>";
//      //die ("<script>window.history.go(-1);</script>");
//  }
//  else {
//    echo "<script>alert('Successfully update data!');</script>";
//    echo "<script>window.location.href = 'UserProfile.php';</script>";
//  }


  if($_FILES['fileimg']['size'] != 0){
    $target_dir = "css/Image/UserProfile/"; //specifies the directory where the file is going to be placed
    $target_file = $target_dir .basename($_FILES["fileimg"]["name"]); //specific path of the file to be uploaded
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); //set extention to lower case
  //check if image file is a actual img
  $check = getimagesize($_FILES["fileimg"]["tmp_name"]);
  if($check !== false){
 echo "<script>alert('File is an image -". $check["mime"]."');</script>";
    $uploadOk =1;
  }
  else {
    echo "<script>alert('File is not an image. Please try again!');</script>";
    die ("<script>window.history.go(-1);</script>");
    $uploadOk =0;
  }

  //check is the file repeat
  if (file_exists($target_file)){
    echo "<script>alert('file already exists.');</script>";
    die ("<script>window.history.go(-1);</script>");
    $uploadOk = 0;
  }
  //check file type
  if($imageFileType !="jpg" && $imageFileType !="jpeg" && $imageFileType !="png" & $imageFileType !="gif"){
    echo "<script>alert('Sorry, only allowed JPG, JPEG, PNG and GIF files.');</script>";
    $uploadOk=0;
  }

  If ($uploadOk == 0){
    echo "<script>alert('Sorry, your files was not uploaded.');</script>";
   die ("<script>window.history.go(-1);</script>");
  }
  else {
    if(move_uploaded_file($_FILES["fileimg"]["tmp_name"],$target_file)){
      echo "<script>alert('The file". basename($_FILES["fileimg"]["name"])."has been uploaded.');</script>'";
    }
    else {
      echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
      die ("<script>window.history.go(-1);</script>");
    }
  }
 $sql = "Update user SET UserEmail = '$Email', User_Birthday = '$Dob' , UserGender = '$Gender' , UserRole = '$Role', UserImg = '$target_file', Username = '$Username' ";

     if (!empty($password)) {
       $sql .= ", UserPassword = '$passwordhash' WHERE UserID = $UID; ";
     }else {
       $sql .=" WHERE UserID = $UID;";
     }

 }
 else {
   $sql = "Update user SET UserEmail = '$Email', User_Birthday = '$Dob' , UserGender = '$Gender', UserRole = '$Role', Username = '$Username'  ";

       if (!empty($password)) {
         $sql .= ", UserPassword = '$passwordhash' WHERE UserID = '$UID'; ";
       }else {
         $sql .=" WHERE UserID = '$UID';";
       }
 }


  mysqli_query($conn,$sql);

  if (mysqli_affected_rows($conn)<=0){
      echo "<script>alert('Cannot Update Data!');</script>";
      var_dump($sql);
  //   die ("<script>window.history.go(-1);</script>");
  }
  else {
    echo "<script>alert('Successfully update data!');</script>";
    //var_dump($sql);
    echo "<script>window.location.href = 'AdminManageUser.php';</script>";
  }

 ?>
