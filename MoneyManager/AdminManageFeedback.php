<?php
ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%title%","Manage Feedback",$buffer);
echo $buffer;

include 'FeedbackLayout2.php'; ?>
<!DOCTYPE html>
<html>
<head>
<style>
	tr:nth-child(even){background-color: #9a9c91;}

</style>
	<title></title>
	<!-- Latest compiled and minified CSS -->

	<!-- jQuery library -->

	<!-- font awesome -->
  	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
	<!-- rating star css -->
    <link rel="stylesheet" href="css/ratingstar.css">
</head>

<body >
<div class="container-fluid container-header mt-5">

<div class="container-fluid container-header">
  <div class="row">
    <div class="col-sm-8"><div class="h3 text-white"><caption>Feedback Details</caption></div></div>
	</div>
</div>
  <div class="container-fluid container-content">
<div class="table-responsive-xl">
<table class="table text-white table-borderless" >
  <thead>
	  <tr>
	    <th class="col-sm-2">Username</th>
	    <th class="col-sm-2">Comment</th>
		<th class="col-sm-2">Rating</th>
		<th class='text-right col-sm-2'></th>
	  </tr>
	</thead>
	<tbody>
	<?php

	  include 'conn.php';
		$sql = "SELECT F.FeedbackID,F.UserID,FeedbackDesc, FeedbackDate, Rating, U.Username From Feedback F Inner Join user U on F.UserID = U.UserID Order by F.FeedbackDate Desc ";
		//var_dump($sql);
        if ($result = mysqli_query($conn,$sql)){
            while($row=mysqli_fetch_assoc($result)){
				$fid = $row ['FeedbackID'];
				$uid = $row['UserID'];


				echo "<tr>";
					echo "<td class='col-sm-2'>".$row['Username']."</td>";
					echo "<td class='col-sm-2'>".$row['FeedbackDesc']."</td>";

				    if($row['Rating']==1){ echo "<td><i class='fa fa-star' style='color:gold'></i></td>"; }
                             if($row['Rating']==2){ echo "<td><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'></i></td>"; }
                            if($row['Rating']==3){ echo "<td><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'</i></td>"; }
                            if($row['Rating']==4){ echo "<td><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'></i></td>"; }
                            if($row['Rating']==5){ echo "<td><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'></i><i class='fa fa-star' style='color:gold'></i></td>"; }

					$sql2="SELECT * FROM reply INNER JOIN feedback on reply.FeedbackID = feedback.FeedbackID WHERE reply.FeedbackID = '$fid';";
                     // var_dump($sql2);
                      $result2 = mysqli_query($conn,$sql2);
                      if (mysqli_num_rows($result2)>=1){
												$rows = mysqli_fetch_assoc($result2);
												$replyId= $rows['FeedbackID'];
												if($replyId == $fid){
												echo"<td class='text-right col-sm-2'>
												<a href='AdminViewReply.php?fid=$fid' class='btn btn-success btn-xs' style='padding: 5px 10px'  ><span class='glyphicon glyphicon-edit'></span> View Reply</a>
												<a href='AdminReplyForm.php?fid=$fid&uid=$uid' class='btn btn-info btn-xs' style='padding: 5px 10px'  ><span class='glyphicon glyphicon-edit'></span> Reply</a>
												<a href='AdminDeleteFeedback.php?fid=$fid&rid=$replyId' class='btn btn-danger btn-xs'style='padding: 5px 10px'><span class='glyphicon glyphicon-remove'></span> Del</a></td>";
												}else{
												echo"<td class='text-right col-sm-2'>
												<a href='AdminReplyForm.php?fid=$fid&uid=$uid' class='btn btn-info btn-xs' style='padding: 5px 10px'  ><span class='glyphicon glyphicon-edit'></span> Reply</a>
												<a href='AdminDeleteFeedback.php?fid=$fid' class='btn btn-danger btn-xs'style='padding: 5px 10px'><span class='glyphicon glyphicon-remove'></span> Del</a></td>";
												}
											echo "</tr>";
                      }else{
												echo"<td class='text-right col-sm-2'>
												<a href='AdminReplyForm.php?fid=$fid&uid=$uid' class='btn btn-info btn-xs' style='padding: 5px 10px'  ><span class='glyphicon glyphicon-edit'></span> Reply</a>
												<a href='AdminDeleteFeedback.php?fid=$fid' class='btn btn-danger btn-xs'style='padding: 5px 10px'><span class='glyphicon glyphicon-remove'></span> Del</a></td>";
			echo "</tr>";
                      }

			}
		}
	?>
	</tbody>
</table>
</div>
</div>
</div>




</body>
</html>
<?php include 'footer.php' ?>
