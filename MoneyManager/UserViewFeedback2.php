<?php
ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%title%","Manage Feedback",$buffer);
echo $buffer;
include 'FeedbackLayout2.php';

$uid = $_SESSION['userid'];
?>
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="css/ratingstar.css">
<div class="container">
  <div class="row">
    <div class="col-sm-10 col-sm-offset-1" id="logout">
    <div class="container-fluid container-header" style="background-color: transparent; border:none">
  <div class="row">
    <div class="col-sm-8"><div class="h3 text-white"></div></div>
    <div class="col-sm-4" style="background-color:transparent">
    <button type="button" class="btn btn-primary-outline pull-right" onclick="location.href='UserAddFeedback.php?uid=<?php echo $uid;?>'">
        <span class="glyphicon glyphicon-plus plusicon mt-2" aria-hidden="true"></span>
      </button>
    </div>
  </div>
</div>
        <div class="comment-tabs" style="margin-top: 30px">

     <?php
include "conn.php";
///$id = $_SESSION['Username'];
$sql ="SELECT F.FeedbackID,F.UserID,FeedbackDesc, FeedbackDate, Rating, U.Username From Feedback F Inner Join user U on F.UserID = U.UserID Order by F.FeedbackDate Desc ";
//var_dump($sql);
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)<=0){
}else{


                    echo"<ul class='comment-list'>";
                    echo"<li class='comment'>";
                    while($row=mysqli_fetch_array($result)){
                      $fid = $row ['FeedbackID'];
                      $user = $row ['Username'];
                      $comment = $row ['FeedbackDesc'];
                      $rating = $row ['Rating'];
                      $date = $row ['FeedbackDate'];
                      //$uid =  $row ['UserID'];

                      $sql2="SELECT * FROM reply INNER JOIN feedback on reply.FeedbackID = feedback.FeedbackID WHERE reply.FeedbackID = '$fid' ;";
                      $result2 = mysqli_query($conn,$sql2);

                      //var_dump($sql2);


                    echo"<div class='comment-body'>";
                          echo"<div class='well well-lg'>";
                              echo"<h4 class='comment-heading text-uppercase reviews'>".$row['Username']."";
                              echo"<br>";
                              if($row['Rating']==1){ echo "<td><i class='fa fa-star' style='color:gold'></i></td>"; }
                              if($row['Rating']==2){ echo "<td><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'></i></td>"; }
                             if($row['Rating']==3){ echo "<td><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'</i></td>"; }
                             if($row['Rating']==4){ echo "<td><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'></i></td>"; }
                             if($row['Rating']==5){ echo "<td><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'></i></td>"; }
                             echo"</h4>";
                              echo"<ul class='comment-date text-uppercase reviews list-inline'>";
                             
                                echo"<li class='date'>".$row['FeedbackDate']."</li>";
                             echo"</ul>";
                         
                             echo" <p class='comment-comment'>".$row['FeedbackDesc']."";
                            

                             echo"</p>";
                             if (mysqli_num_rows($result2)>=1){
                               $rows = mysqli_fetch_assoc($result2);
                               $replyId= $rows['FeedbackID'];


                             if($replyId == $fid){

                              echo"<a class='btn btn-info btn-circle text-uppercase' href='ReplyForm.php?fid=$fid&uid=$uid' ><span class='glyphicon glyphicon-share-alt'></span> Reply</a>
                              <a class='btn btn-warning btn-circle text-uppercase'  href='UserViewReply.php?fid=$fid' ><span class='glyphicon glyphicon-comment'></span> View Comments</a>";

                             }else{
                              echo"<a class='btn btn-info btn-circle text-uppercase' href='ReplyForm.php?fid=$fid&uid=$uid'  ><span class='glyphicon glyphicon-share-alt'></span> Reply</a>";
                             }
                              echo"</div>";
                            }else {
                            echo"<a class='btn btn-info btn-circle text-uppercase' href='ReplyForm.php?fid=$fid&uid=$uid'  ><span class='glyphicon glyphicon-share-alt'></span> Reply</a>";
                              echo"</div>";
                            }


                        echo"</div>";



                  }}
            ?>
