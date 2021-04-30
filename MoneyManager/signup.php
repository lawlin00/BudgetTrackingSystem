<?php

include "conn.php";

//retreive data from signupform.php
;
$username = mysqli_real_escape_string($conn,$_POST['username']);
$gender = mysqli_real_escape_string($conn,$_POST['gender']);
$dob = mysqli_real_escape_string($conn,$_POST['dob']);
$em = mysqli_real_escape_string($conn,$_POST['email']);
$psw = mysqli_real_escape_string($conn,$_POST['password']);
$repsw = mysqli_real_escape_string($conn,$_POST['confirmpsw']);

if ($psw !== $repsw){
    echo"<script>alert('Please Check Your Password!');";
    die("window.history.go(-1);</script>");
}

$passwordhash = password_hash($psw, PASSWORD_BCRYPT);

  $sql = "INSERT INTO user ( Username, UserEmail, User_Birthday, UserPassword, UserGender) VALUES".
            "('$username','$em','$dob','$passwordhash','$gender');";

  mysqli_query($conn,$sql);
 // var_dump($sql);

    if(mysqli_affected_rows($conn)<=0){
        echo"<script>alert('Unable to Sign Up!Your Email Has Been Used!');</script>";
        die("<script>window.history.go(-1);</script>");
    }

    else{
    echo"<script>alert('Sign Up Successfully! Please Login Now !')</script>";
    echo "<script>window.location.href='LoginForm.php';</script>";
    }


?>
