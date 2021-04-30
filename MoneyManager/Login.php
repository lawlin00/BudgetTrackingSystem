<?php
/*    session_start ();
    include "conn.php"; //connection

    //get the username,password
    $username = mysqli_real_escape_string ($conn,$_POST ['username'] );
    $password = mysqli_real_escape_string ($conn,$_POST ['password'] );

    //sql for checking user
    $sql = "Select * from user where Username = '".$username."'";
    $result = mysqli_query ($conn, $sql);
    //var_dump($sql);
    if (mysqli_num_rows($result)<=0)
    {
        echo"<script>alert('Wrong Username! Please Try Again!');";
        die("window.history.go(-1); </script>");
        //If valid

    }else{
      $row = mysqli_fetch_array($result);


        if (password_verify($password,$row['UserPassword'])) {
          if ($row['UserRole']==="0"){
            $_SESSION['userid'] = $row['UserID'];
            $_SESSION['username'] = $row['Username'];
            $_SESSION['password'] = $row['UserPassword'];
            $_SESSION['role'] = $row['UserRole'];
            echo "<script>alert('Successfully Login. Welcome back!".$_SESSION['username']."');window.location.href ='UserProfile.php';</script>";
          }
          elseif ($row['UserRole']==="1") {
            $_SESSION['userid'] = $row['UserID'];
            $_SESSION['username'] = $row['Username'];
            $_SESSION['password'] = $row['UserPassword'];
            $_SESSION['role'] = $row['UserRole'];
            echo "<script>alert('Welcome back! Admin');</script>";
            echo "<script>window.location.href = 'managefeedback.php';</script>";
          }
        }else {
          echo "<script>alert('Wrong Password! Please Try Again.');</script>";
        //  die ("window.history.go(-1);</script>");
    }
  }
*/

?>
<?php

  session_start();
  include "conn.php";

  $username = mysqli_real_escape_string($conn,$_POST['username']);
  $password = mysqli_real_escape_string($conn,$_POST['password']);

  //Check normal user
  $sql = "SELECT * FROM user where Username = '".$username."' and UserStatus = 0;";

  $result = mysqli_query($conn,$sql);


  if (mysqli_num_rows($result) >0) {
    $rows = mysqli_fetch_array($result);
    $_SESSION['userid'] = $rows['UserID'];
    $_SESSION['username'] = $rows['Username'];
    $_SESSION['password'] = $rows['UserPassword'];
    $_SESSION['role'] = $rows['UserRole'];

    if (password_verify($password,$rows['UserPassword'])) {
      if ($_SESSION['role']==="0"){
        echo "<script>alert('Successfully Login. Welcome!".$_SESSION['username']."');window.location.href ='userHome.php';</script>";
      }
      elseif ($_SESSION['role']==="1") {
        echo "<script>alert('Welcome back! admin');</script>";
        echo "<script>window.location.href = 'Adminmanageuser.php';</script>";
      }
    }
    else {
      echo "<script>alert('Wrong Username or Password! Please Try Again.');</script>";
      var_dump($sql);
        session_destroy();
      echo "<script>window.history.go(-1);</script>";
    //  die ("window.history.go(-1);</script>");
  }
  }  else {
      echo "<script>alert('Wrong Username or Password! Please Try Again.');</script>";
        session_destroy();
      echo "<script>window.history.go(-1);</script>";
      var_dump($sql);}

//use session to record variable







 ?>
