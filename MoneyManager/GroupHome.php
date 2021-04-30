<?php
ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%title%","Team Home",$buffer);
echo $buffer;
include 'Noheaderlayout.php';
$TeamID = $_GET['TeamID'];
$UID =$_GET['UID'];
?>
<div class="container-fluid  mb-5">
<div class="float-right">
  <a href="EditGroup.php?TeamID=<?php echo $TeamID."&UID=$UID";?>"><button type="button"  class="btn btn-primary-outline">
    <span class="text-white Detailbtn-custom">Team Information</span> <!--Go to edit group form-->
  </button></a>
  <a href="ManageGroupMember.php?TeamID=<?php echo $TeamID."&UID=$UID";?>"><button type="button"  class="btn btn-primary-outline">
    <span class="text-white Detailbtn-custom">Team Members</span> <!--Go to edit group form-->
  </button></a>
</div>
</div>
<div class="container-fluid container-header">
<div class="h3 text-white">Your Team Budget</div>
</div>
<div class="container-fluid container-content">
<div class="row-fluid">
  <div class="col-md-12">


    <?php

      include 'conn.php';
      $sql = "SELECT * FROM budgetplan WHERE TeamID = '$TeamID' AND BudgetPlanStatus = '0' order by BudgetTitle Asc;";
      $result = mysqli_query($conn,$sql);
      if (mysqli_num_rows($result)<=0){
        echo "<div class='d-flex justify-content-md-center mt-3 mb-5'><a href = 'NewBudgetPlan.php?UID=$UID'><button class='btn btn-primary'>Create New Budget Plan</button></a></div>";

      //  echo "<script>window.location.href = 'NewBudgetPlan.php';</script>";
      }else {
        while ($rows = mysqli_fetch_array($result)) {
          echo "<figure class='col-md-4'>";
          echo "<div class='thumbnail thumbnail-custom'>";
          echo "<a class='text-white' href='BudgetPlanHome.php?BPID=".$rows['BudgetPlanID']."' data-size='1600*1067'>";
          if (is_null( $rows['BudgetPlanImg'])) {
            echo "<img alt=".$rows['BudgetTitle']." src='css/Image/BudgetPlanImg/Capture2.png' class='img-fluid img-responsive PlanImg-custom'>";
          }else {
            echo "<img alt=".$rows['BudgetTitle']." src='".$rows['BudgetPlanImg']."' class='img-fluid img-responsive PlanImg-custom'>";
          }
          echo "<div class='caption'>";
          echo "<p class='text-white text-center'>".$rows['BudgetTitle']."</p>";
          echo "</div>";
          echo "</a>";
          echo "</div>";
          echo "</figure>";
        }
      }

     ?>
<!--input better limt 35 character for budget title-->

  </div>
</div>
</div>
<?php include 'footer.php' ?>
