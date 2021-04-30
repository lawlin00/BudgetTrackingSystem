
<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","User Home",$buffer);
  echo $buffer;
  include 'Layout.php';

  ?>
<div class="container-fluid container-header">
<div class="h3 text-white">Personal Budget</div>
</div>
<div class="container-fluid container-content">
<div class="row-fluid">
  <div class="col-md-12">
    <?php
      include 'conn.php';
      $sql = "SELECT * FROM budgetplan WHERE TeamID IS NULL AND UserID = '$S_UserID' AND BudgetPlanStatus ='0' order by BudgetTitle asc;";
      $result = mysqli_query($conn,$sql);

      if (mysqli_num_rows($result)<=0){
      //  echo "<script>alert('No Personal Budget Plan');</script>";
      //  echo "<script>window.location.href = 'NewBudgetPlan.php';</script>";
      echo "<div class='d-flex justify-content-md-center mt-3 mb-5'><a href = 'NewBudgetPlan.php?UID=$S_UserID'><button class='btn btn-primary'>Create New Budget Plan</button></a></div>";

      }else {
        while ($rows = mysqli_fetch_array($result)) {
          echo "<figure class='col-md-4'>";
          echo "<div class='thumbnail thumbnail-custom'>";
          echo "<a class='text-white' href='BudgetPlanHome.php?BPID=".$rows['BudgetPlanID']."&UID=$S_UserID' data-size='1600*1067'>";
          if (is_null( $rows['BudgetPlanImg'])) {
            echo "<img alt=".$rows['BudgetTitle']." src='css/Image/BudgetPlanImg/Capture2.png' class='img-fluid img-responsive PlanImg-custom'>";
          }else {
            echo "<img alt=".$rows['BudgetTitle']." src=".$rows['BudgetPlanImg']." class='img-fluid img-responsive PlanImg-custom'>";
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

<?php
  $GetTeamSql = "SELECT UserID, ur.TeamID, t.TeamName FROM userteamroles ur Inner Join team t on t.TeamID = ur.TeamID WHERE UserID = '$S_UserID' ORDER BY t.TeamName asc;";
  $TeamResult = mysqli_query($conn,$GetTeamSql);

  if (mysqli_num_rows($TeamResult)<=0){
    echo "<div class='container-fluid container-header'>";
    echo "<div class='h3 text-white'>Team Budget</div>";
    echo "</div>";
    echo "<div class='container-fluid container-content'>";
    echo "<div class='d-flex justify-content-md-center mt-3 mb-5'><a href = 'NewGroup2.php?UID=$S_UserID'><button class='btn btn-primary'>Create Team</button></a></div>";
    echo "</div>";
  }else {
    while ($TeamRows = mysqli_fetch_array($TeamResult)) {
      $TeamID = $TeamRows['TeamID'];
      $TeamName =$TeamRows['TeamName'];

      $BudgetPlanSQL = "SELECT * FROM budgetplan WHERE TeamID = '$TeamID'AND BudgetPlanStatus ='0' order by BudgetTitle asc;";
      $TeamBudgetPlanResult = mysqli_query($conn,$BudgetPlanSQL);

      if (mysqli_num_rows($TeamBudgetPlanResult)>=1){
        echo "<div class='container-fluid container-header'>";
        echo "<div class='h3 text-white'>$TeamName</div>";
        echo "</div>";

        echo "<div class='container-fluid container-content'>";
        echo "<div class='row-fluid'>";
        echo "<div class='col-md-12'>";

        while ($TeamBudgetPlanRows = mysqli_fetch_array($TeamBudgetPlanResult)) {
          echo "<figure class='col-md-4'>";
          echo "<div class='thumbnail thumbnail-custom'>";
          echo "<a class='text-white' href='BudgetPlanHome.php?BPID=".$TeamBudgetPlanRows['BudgetPlanID']."' data-size='1600*1067'>";
          if (is_null( $TeamBudgetPlanRows['BudgetPlanImg'])) {
            echo "<img alt=".$TeamBudgetPlanRows['BudgetTitle']." src='css/Image/BudgetPlanImg/Capture2.png' class='img-fluid img-responsive PlanImg-custom'>";
          }else {
            echo "<img alt=".$TeamBudgetPlanRows['BudgetTitle']." src=".$TeamBudgetPlanRows['BudgetPlanImg']." class='img-fluid img-responsive PlanImg-custom'>";
          }
          echo "<div class='caption'>";
          echo "<p class='text-white text-center'>".$TeamBudgetPlanRows['BudgetTitle']."</p>";
          echo "</div>";
          echo "</a>";
          echo "</div>";
          echo "</figure>";


      }
      echo "</div>";
      echo "</div>";
      echo "</div>";
      }


    }
  }

 ?>


<?php include 'footer.php' ?>
