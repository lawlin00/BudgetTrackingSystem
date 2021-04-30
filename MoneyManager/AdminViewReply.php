<?php
ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%title%","View Reply",$buffer);
echo $buffer;

include 'FeedbackLayout2.php';
include 'conn.php';
$fid = $_GET['fid'];


$sql2="SELECT F.FeedbackID,F.UserID,FeedbackDesc, FeedbackDate, Rating, U.Username From Feedback F Inner Join user U on F.UserID = U.UserID WHERE FeedbackID='$fid'";
$result2 = mysqli_query($conn,$sql2);
if ($row2 = mysqli_fetch_array($result2)){
    $fid = $row2 ['FeedbackID'];
    $user = $row2 ['Username'];
    $comment = $row2 ['FeedbackDesc'];
    $date = $row2 ['FeedbackDate'];
}
else {
    echo "<script>alert('No Data From Database! Technical Errors!');</script>";
    //die ("<script>window.location.href='Hall.php';</script>");
  }
  echo"<div class='container' style='margin-top: 30px'>";
  echo"<div class='comment-body' >";
  echo"<div class='well well-lg' style='background-color:#fff7d9'>";
      echo"<h4 class='comment-heading text-uppercase reviews'>".$row2['Username']."</h4>";
      echo"<ul class='comment-date text-uppercase reviews list-inline'>";
        echo"<li class='date'>".$row2['FeedbackDate']."</li>";
     echo"</ul>";

     echo" <p class='comment-comment'>".$row2['FeedbackDesc']."";
     echo"</p>";
     echo"</div>";
     echo"</div>";
     echo"</div>";


$sql = "SELECT ReplyID ,ReplyDate, ReplyDesc, FeedbackID, Username From reply INNER JOIN user on user.UserID = reply.UserID Where FeedbackID = '$fid' ";
$result = mysqli_query($conn,$sql);
//var_dump($sql);
if (mysqli_num_rows($result)<=0){

}else{
    while($row=mysqli_fetch_array($result)){
    $user = $row ['Username'];
   $comment = $row ['ReplyDesc'];
    $date = $row ['ReplyDate'];
    $fid =$row ['FeedbackID'];
    $ReplyID = $row ['ReplyID'];

    echo"<div class='container' style='margin-top: 30px'>";
    echo"<div class='col-sm-8' ><div class='h3 text-white'></div></div>";
    echo"<div class='comment-body'>";
                          echo"<div class='well well-lg'>";
                                          echo"<h4 class='comment-heading text-uppercase reviews'><span></span>".$row['Username']."</h4>";
                                          echo"<ul class='comment-date text-uppercase reviews list-inline'>";
                                          echo"<li class='date'>".$row['ReplyDate']."</li>";
                                          echo"</ul>";
                                          echo"<p class='comment-comment'>
                                          ".$row['ReplyDesc']."
                                          </p>";
                                          echo"<a class='btn btn-info btn-circle text-uppercase'  onclick='history.go(-1)'  style='margin-right:1em' ><span class='glyphicon glyphicon-share-alt'></span> BACK</a>";
                                          echo"<a class='btn btn-danger btn-circle text-uppercase' href='AdminDeleteReply.php?rid=$ReplyID' ><span class='glyphicon glyphicon-share-alt'></span> DELETE</a>";
                                      echo"</div>";
                                    echo"</div>";
                                echo"</li>";
                                echo"</div>";
    }
}
                                ?>
 <?php include 'footer.php' ?>
