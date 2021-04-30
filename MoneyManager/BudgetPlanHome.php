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

  $BudgetMonthTitle = date('F Y');
  $CurrentMonth = date('Y-m');
  $BudgetMY = explode("-",$CurrentMonth);
  $Year = $BudgetMY[0];
  $Month = $BudgetMY[1];
?>
<div class="container-fluid  mb-5">
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
    <div class="col-sm-8"><div class="h3 text-white">Budget on <?php echo $BudgetMonthTitle;?></div></div>
    <div class="col-sm-4">
      <a href="InsertNewBudget.php?BPID=<?php echo $BPID;?>"><button type="button"  class="btn btn-primary-outline pull-right">
        <span class="glyphicon glyphicon-plus plusicon mt-2" aria-hidden="true"></span>
      </button></a>
      <a href="ViewPreviousBudget.php?BPID=<?php echo $BPID;?>"><button type="button"  class="btn btn-primary-outline pull-right  mt-3">
      <span class="text-white Detailbtn-custom">View Previous Budget</span>
      </button></a>

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

          //echo "<td class='text-center'>#Depends</td>";
          echo "<td class='text-center'>";
          echo "<a href='DelBudget.php?BID=$BudgetID&BPID=$BPID' onclick =\"return confirm('Do you really want to delete the budget?');\"><button type='button'  class='btn btn-primary-outline border-white ml-3 pull-right'>";
          echo "<span class='glyphicon glyphicon-trash  text-white' aria-hidden='true'></span>";
          echo "</button></a>";
          echo "<a href='EditBudget.php?BID=$BudgetID&BPID=$BPID'><button type='button'  class='btn btn-primary-outline border-white ml-3 pull-right'>";
          echo "<span class='glyphicon glyphicon-pencil  text-white' aria-hidden='true'></span>";
          echo "</button></a>";
          echo "</td>";
          echo "</tr>";
      }
    }
//  var_dump($Budgetsql);
     ?>
</table>
</div>
</div>

<div class="container-fluid container-header mt-5">
  <div class="row">
    <div class="col-sm-8"><div class="h3 text-white">Actual Financial Statement on <?php echo $BudgetMonthTitle;?></div></div>
    <div class="col-sm-4">
    <a href="FinancialStatementDetails.php?BPID=<?php echo $BPID;?>"><button type="button"  class="btn btn-primary-outline pull-right mt-4">
        <span class="text-white Detailbtn-custom">Details</span>
      </button></a>
    <a href="NewTransaction2.php?BPID=<?php echo $BPID;?>"><button type="button"  class="btn btn-primary-outline pull-right">
        <span class="glyphicon glyphicon-plus plusicon mt-2" aria-hidden="true"></span>
      </button></a>
    </div>
  </div>

</div>

<div class="container-fluid container-content">
<div class="table-responsive-xl">
<table class="table text-white table-borderless">
  <thead>
    <tr>
      <th scope="col" class="text-center">Date</th>
      <th scope="col" class="text-center">Description</th>
      <th scope="col" class="text-center">Category</th>
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

      $sql = "SELECT TransactionID, T.BudgetPlanID, T.CategoryID, TransactionDate, TransactionType, TransactionDesc, TransactionAmount, C.CategoryName FROM actualtransaction T INNER JOIN Category C on C.CategoryID = T.CategoryID WHERE T.BudgetPlanID = '$BPID' AND month(TransactionDate) ='$Month' and year(TransactionDate) ='$Year' order by TransactionDate asc LIMIT 15;";
      $result = mysqli_query($conn,$sql);

      if (mysqli_num_rows($result)<=0){

      //echo "<script>window.location.href = 'NewTransaction2.php?BPID=$BPID';</script>";
      //  if (is_null($TotalBudgetIncome)||is_null($TotalBudgetExpenses)) {
          //echo "<script>alert('No Transaction and Budget Information.');</script>";
          echo "<tr>";
          echo "<td colspan='6' class='text-center'>";
          echo "<a href='NewTransaction2.php?BPID=$BPID'><button type='button'  class='btn btn-primary border-white mt-3'>Add Transaction";
          echo "</button></a>";
          echo "</td>";
          echo "</tr>";
          //echo "<script>window.location.href = 'NewTransaction2.php?BPID=$BPID';</script>";
      //  }
    //  var_dump($sql);
      }else {


        while ($rows = mysqli_fetch_array($result)) {
          $TransactionID = $rows['TransactionID'];
          $BudgetPlanID = $rows['BudgetPlanID'];
          $CategoryID = $rows['CategoryID'];
          $CategoryName = $rows['CategoryName'];
          $TransactionDate = $rows['TransactionDate'];
          $TransactionType = $rows['TransactionType'];
          $TransactionDesc = $rows['TransactionDesc'];
          $TransactionAmount = number_format($rows['TransactionAmount'],2);

          if ($TransactionType == 'Income') {
            echo "<tr class='-success'>";
          }else {
            echo "<tr class='bg-danger'>";
          }

          echo "<td class='text-center'>$TransactionDate</td>";
          if (is_null($TransactionDesc)) {
            echo "<td class='text-center'>No Stated</td>";
          }else {
            echo "<td class='text-center'>$TransactionDesc</td>";
          }
          echo "<td class='text-center'>$CategoryName</td>";
          if ($TransactionType == 'Income') {
            echo "<td class='text-center'><span class='glyphicon glyphicon-plus  text-white mr-3' aria-hidden='true'></span> $TransactionAmount</td>";
            echo "<td class='text-center'></td>";
            echo "<td class='text-center'></td>";
          }else {
            echo "<td class='text-center'></td>";
            echo "<td class='text-center'> <span class='glyphicon glyphicon-minus  text-white mr-4' aria-hidden='true'></span> $TransactionAmount</td>";
            echo "<td class='text-center'></td>";
          }

          //echo "<td class='text-center'>#Depends</td>";
          echo "<td class='text-center'>";
          echo "<a href='DeleteTransaction.php?ATID=$TransactionID&BPID=$BudgetPlanID' onclick =\"return confirm('Do you really want to delete the budget?');\"><button type='button'  class='btn btn-primary-outline border-white ml-3 pull-right'>";
          echo "<span class='glyphicon glyphicon-trash  text-white' aria-hidden='true'></span>";
          echo "</button></a>";
          echo "<a href='EditTransaction.php?ATID=$TransactionID&BPID=$BudgetPlanID'><button type='button'  class='btn btn-primary-outline border-white ml-3 pull-right'>";
          echo "<span class='glyphicon glyphicon-pencil  text-white' aria-hidden='true'></span>";
          echo "</button></a>";
          echo "</td>";
          echo "</tr>";
      }
    }

     ?>
</table>
</div>
</div>
<?php include 'footer.php'; ?>
