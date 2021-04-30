<?php
    session_start();
    include ("conn.php");

    $token = $_GET['token'];
    $email = $_GET['email'];
    $newpass = $_POST['npwd'];
    $cnewpass = $_POST['cnpwd'];

    if ($newpass != $cnewpass){
        echo "<script>alert('New password is not same as Confirmed New Password. Please try again.');</script>";
        die("<script>window.history.go(-1);</script>");
    }else{
        $hash = password_hash($newpass, PASSWORD_BCRYPT);
        $sql_update = "UPDATE user SET UserPassword = '$hash' WHERE UserEmail = '$email'";
        mysqli_query($conn, $sql_update);

        if(mysqli_affected_rows($conn)<=0){
            echo "<script>alert('Failed to reset password! Please try again!');</script>";
            die ("<script>window.history.go(-1);</script>");
        }else{
            echo "<script>alert('Reset successful! Please login again.');</script>";
            echo "<script>window.location.href='LoginForm.php';</script>";
            }
        }

?>
