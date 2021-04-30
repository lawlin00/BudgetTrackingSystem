<?php
ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%title%","Budget Plan Home",$buffer);
echo $buffer;
include 'Layout2.php'
?>
<?php
  $BPID = $_GET['BPID'];
  if (isset($_POST['Month'])) {
    $CurrentMonth = $_POST['Month'];
    $Month = strtotime($CurrentMonth);
    $BudgetMonthTitle = date('F Y' , $Month);
    var_dump($BudgetMonthTitle);
  }else {
    $BudgetMonthTitle = date('F Y');
    $CurrentMonth = date('Y-m');
    $BudgetMY = explode("-",$CurrentMonth);
    $Year = $BudgetMY[0];
    $Month = $BudgetMY[1];
  }

?>
<div class="container-fluid  mb-5">
  <a href="BudgetPlanHome.php?BPID=<?php echo $BPID;?>"><button type="button"  class="btn btn-primary-outline">
    <span class="text-white Detailbtn-custom">View budget on current month</span>
  </button></a>

<div class="float-right">

  <a href="ViewCategory.php?BPID=<?php echo $BPID;?>"><button type="button"  class="btn btn-primary-outline">
    <span class="text-white Detailbtn-custom">Manage Category</span>
  </button></a>
  <a href="ViewReport.php?BPID=<?php echo $BPID;?>"><button type="button"  class="btn btn-primary-outline">
    <span class="text-white Detailbtn-custom">View Report</span>
  </button></a>
  <a href="EditBudgetPlan.php?BPID=<?php echo $BPID;?>"><button type="button"  class="btn btn-primary-outline">
    <span class="glyphicon glyphicon-cog plusicon mb-1" aria-hidden="true"></span>
  </button></a>
</div>
</div>

<div class="container-fluid container-header mt-5">
  <div class="row">
    <div class="col-sm-8"><div class="h3 text-white">Budget on <?php echo $BudgetMonthTitle;?></div>
    </div>

    <div class="col-sm-4 p-0 mt-1">
      <form action="ViewPreviousBudget.php?BPID=<?php echo $BPID;?>" method="post">
      <button type="submit"  class="btn btn-primary-outline pull-right  mt-3">
      <span class="text-white Detailbtn-custom">Search</span>
      </button>
      <div class="form-group col-md-6 float-right mt-4">

      <select class="browser-default custom-select custom-select-lg mb-3" name="Month">
        <?php
          $MonthYearSQL = "SELECT BudgetMonth From budget GROUP by BudgetMonth Order By BudgetMonth asc;";
          $MonthYearResult = mysqli_query($conn,$MonthYearSQL);
        if (mysqli_num_rows($MonthYearResult)<=0){
          echo "<script>alert('No Budget Information. Please Add Budget Information.')</script>";
        }else {

            while ($MonthYearRows = mysqli_fetch_array($MonthYearResult)) {
              $MonthYear = $MonthYearRows['BudgetMonth'];
              if ($MonthYear == $CurrentMonth) {
                echo "<option value='$MonthYear' selected>$MonthYear</option>";
              }else {
                  echo "<option value='$MonthYear'>$MonthYear</option>";
              }

          }
        }



         ?>
      </select>
    </div>

    </div>
  </div>

</div>

<div class="container-fluid container-content">
<div class="table-responsive-xl">
<table class="table text-white table-borderless">
  <thead>
    <tr>
      <th scope="col" class="text-center">Category</th>
      <th scope="col" class="text-center">Description</th>
      <th scope="col" class="text-center">Income / Funds (RM)</th>
      <th scope="col" class="text-center">Expenses (RM)</th>
      <th scope="col" class="text-center"></th>

    </tr>
  </thead>
  <tbody>
    <?php
    //    include 'conn.php';
    //    $BPID = $_GET['BPID'];

      //var_dump($Month);

      $Budgetsql = "SELECT BudgetID, B.BudgetPlanID, B.CategoryID, BudgetType, BudgetDesc, BudgetAmount, C.CategoryName FROM budget B INNER JOIN category C on C.CategoryID = B.CategoryID WHERE B.BudgetPlanID = '$BPID' AND BudgetMonth = '$CurrentMonth' Order By BudgetType Desc";
      $Budgetresult = mysqli_query($conn,$Budgetsql);

      if (mysqli_num_rows($Budgetresult)<=0){

      //echo "<script>window.location.href = 'NewTransaction2.php?BPID=$BPID';</script>";
      //  if (is_null($TotalBudgetIncome)||is_null($TotalBudgetExpenses)) {
          //echo "<script>alert('No Transaction and Budget Information.');</script>";
          echo "<tr>";
          echo "<td colspan='6' class='text-center'>";
          echo "<a href='InsertNewBudget.php?BPID=$BPID'><button type='button'  class='btn btn-primary border-white mt-3'>Add Budget";
          echo "</button></a>";
          echo "</td>";
          echo "</tr>";
          //echo "<script>window.location.href = 'NewTransaction2.php?BPID=$BPID';</script>";
      //  }

      }else {

        while ($Budgetrows = mysqli_fetch_array($Budgetresult)) {
          $BudgetID = $Budgetrows['BudgetID'];
          $BudgetPlanID1 = $Budgetrows['BudgetPlanID'];
          $CategoryID = $Budgetrows['CategoryID'];
          $CategoryName = $Budgetrows['CategoryName'];
        //$BudgetMonth = $rows['BudgetMonth'];
          $BudgetType = $Budgetrows['BudgetType'];
          $BudgetDesc = $Budgetrows['BudgetDesc'];
          $BudgetAmount = number_format($Budgetrows['BudgetAmount'],2);

        //  echo "<td class='text-center'>$TransactionDate</td>";
          echo "<td class='text-center'>$CategoryName</td>";
          if (is_null($BudgetDesc)) {
            echo "<td class='text-center p-4'>No Stated</td>";
          }else {
            echo "<td class='text-center p-4'>$BudgetDesc</td>";
          }

          if ($BudgetType == 'Income') {
            echo "<td class='text-center p-4'><span class='glyphicon glyphicon-plus  text-white mr-3' aria-hidden='true'></span> $BudgetAmount</td>";
            echo "<td class='text-center p-4'></td>";
            echo "<td class='text-center p-4'></td>";
          }else {
            echo "<td class='text-center p-4'></td>";
            echo "<td class='text-center p-4'> <span class='glyphicon glyphicon-minus  text-white mr-4' aria-hidden='true'></span> $BudgetAmount</td>";
            echo "<td class='text-center p-4'></td>";
          }

          if ($CurrentMonth >= date('Y-m')) {
            echo "<td class='text-center'>";
            echo "<a href='DelBudget.php?BID=$BudgetID&BPID=$BPID' onclick =\"return confirm('Do you really want to delete the budget?');\"><button type='button'  class='btn btn-primary-outline border-white ml-3 pull-right'>";
            echo "<span class='glyphicon glyphicon-trash  text-white' aria-hidden='true'></span>";
            echo "</button></a>";
            echo "<a href='EditBudget.php?BID=$BudgetID&BPID=$BPID'><button type='button'  class='btn btn-primary-outline border-white ml-3 pull-right'>";
            echo "<span class='glyphicon glyphicon-pencil  text-white' aria-hidden='true'></span>";
            echo "</button></a>";
            echo "</td>";
          }


          //echo "<td class='text-center'>#Depends</td>";


          echo "</tr>";
      }
    }
//  var_dump($Budgetsql);
     ?>
</table>
</div>
</div>
<?php include 'footer.php'; ?>
