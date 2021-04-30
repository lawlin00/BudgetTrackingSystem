<?php
ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%title%","View Feedback",$buffer);
echo $buffer;
include 'Noheaderlayout.php';
?>
      <div class="content">
      <div class="container-fluid container-header">
  <div class="row">
    <div class="col-sm-8"><div class="h3 text-white"></div></div>
    <div class="col-sm-4">
    <button type="button"  class="btn btn-primary-outline pull-right" >
        <span class="glyphicon glyphicon-plus plusicon mt-2" aria-hidden="true"></span>
      </button>
    </div>
  </div>
</div>



<div class="container-fluid container-content">
<div class="table-responsive-xl">
<table class="table text-white table-borderless">
<thead>
<?php
include "conn.php";
///$id = $_SESSION['Username'];
$sql ="SELECT F.FeedbackID,F.UserID,FeedbackDesc, FeedbackDate, Rating, U.Username From Feedback F Inner Join user U on F.UserID = U.UserID Order by F.FeedbackDate Desc";
//var_dump($sql);
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result)<=0){


}else{
    echo"<tr style='background-color:#cacfce;color:black'>";
            echo"<th class='text-center'>Username</th>";
            echo"<th class='text-center'>DateTime</th>";
            echo"<th class='text-center'>Rate</th>";
            echo"<th class='text-center'>Comment</th>";
            echo"<th class='text-center col-sm-4'></th>";
        echo"</tr>";
        echo"</thead>";
    while($row=mysqli_fetch_array($result)){
        $user = $row ['Username'];
        $comment = $row ['FeedbackDesc'];
        $date = $row ['FeedbackDate'];
            echo"<tr>";
            echo"<td class='text-center'>".$row['Username']."</td>";
            echo"<td class='text-center' >".$row['FeedbackDate']."</td>";
            echo"<td class='text-center' >".$row['Rating']."</td>";
            echo"<td class='text-center'>".$row['FeedbackDesc']."</td>";
            echo"<td class='text-center col-sm-4'>";
            echo"<a href='#' class='btn btn-info btn-xs' style='padding: 5px 10px'><span class='glyphicon glyphicon-edit'></span> Edit</a>
            <a href='#' class='btn btn-danger btn-xs' style='padding: 5px 10px'><span class='glyphicon glyphicon-remove'></span> Del</a></td>
            </tr>";
    }
}
?>
</table>
</div>
</div>



    <?php include 'footer.php' ?>
  </body>
</html>
