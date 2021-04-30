<?php
    session_start();
    include ("conn.php");

    $email = $_GET['email'];
    $oldpass = $_POST['cpwd'];
    $newpass = $_POST['npwd'];
    $cnewpass = $_POST['cnpwd'];

    if ($newpass != $cnewpass){
        echo "<script>alert('New password is not same as Confirmed New Password. Please try again.');</script>";
        die("<script>window.history.go(-1);</script>");
    }else{
        if (password_verify($oldpass,$_SESSION['password'])) {
            $hash = password_hash($newpass, PASSWORD_BCRYPT);
            $sql_update = "UPDATE user SET UserPassword = '$hash' WHERE UserEmail = '$email'";
            mysqli_query($conn, $sql_update);

            if(mysqli_affected_rows($conn)<=0){
                echo "<script>alert('Failed to update password! Please try again!');</script>";
               die ("<script>window.history.go(-1);</script>");
            }else{
                echo "<script>alert('Update successful! Please remember your new password ^_^');</script>";
                echo "<script>window.location.href='UserHome.php';</script>";
            }
        }else{
          echo "<script>alert('Current Password not correct. Please try again!');</script>";
            die ("<script>window.history.go(-1);</script>");
        }
    }
?>
