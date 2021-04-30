<?php
    session_start();
    include "conn.php";
    require_once('PHPMailer/PHPMailerAutoload.php');

    $email = $_POST['email'];
    $CheckUsersql = "SELECT UserEmail, UserID FROM user WHERE UserEmail = '$email' AND UserStatus='0';";
    $UserEmail = mysqli_query($conn,$CheckUsersql);
    if ($UserRow = mysqli_fetch_array($UserEmail)) {
      $UserEmail = $UserRow['UserEmail'];
    }
    if ($UserEmail != $email) {
      //var_dump($CheckUsersql);
      echo "<script>alert('No user is found with this email! Please check again!');</script>";
      die ("<script>window.history.go(-1);</script>");
    }
    //$sel_sql = "SELECT * FROM user WHERE UserEmail = '$email'";
    //$sel_result = mysqli_query($conn, $sql);

   // if ($row = mysqli_num_rows($sel_result)){
       // $rows = mysqli_fetch_array($sel_result);
        //$name = $rows['Username'];
    //}else{
        //echo "<script>alert('No user is found with this email! Please check again!');</script>";
        //die ("<script>window.history.go(-1);</script>");
    //}

    $token = bin2hex(random_bytes(50));

    $output='<p>Dear user,</p>';
    $output.='<p>Please click on the following link to reset your password.</p>';
    $output.='<p>-------------------------------------------------------------</p>';
    $output.='<p><a href="localhost/MoneyManager/ResetPassword.php?token='.$token.'&email='.$email.'">Click here to reset your password</a></p>';
    $output.='<p>-------------------------------------------------------------</p>';
    $output.='<p>If you did not request this forgotten password email, no action
    is needed, your password will not be reset. However, you may want to log into
    your account and change your security password as someone may have guessed it.</p>';
    $output.='<p>Thanks,</p>';
    $output.='<p>Money Manager Admin Team</p>';
    $body = $output;
    $subject = "Password Recovery - Money Manager";

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='ssl';
    $mail->Host='smtp.gmail.com';
    $mail->Port='465';
    $mail->isHTML();
    $mail->Username='money.manager0320@gmail.com';
    $mail->Password='moneymanager2020';
    $mail->SetFrom('money.manager0320@gmail.com');
    $mail->Subject= $subject;
    $mail->Body= $body;
    $mail->AddAddress($email);

    if(!$mail->Send()){
        echo "Mailer Error: " . $mail->ErrorInfo;
    }else{
        $sql = "UPDATE user SET ResetToken = '$token' WHERE UserEmail = '$email'";
        $sql_result = mysqli_query($conn, $sql);
        echo "<script>alert('Message sent! Please check your mailbox.')</script>";
        echo "<script>window.location.href='LoginForm.php';</script>";
        }
?>
