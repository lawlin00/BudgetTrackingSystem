<?php
ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%title%","Financial Statement Details",$buffer);
echo $buffer;
  include 'Layout2.php';
  include 'conn.php';
  $BPID = $_GET['BPID'];
  $CurrentMonth = date('Y-m');
  ?>
  <form action="SearchTransaction.php?BPID=<?php echo $BPID;?>" method="post">
<div class="container-fluid container-header pl-0">
<div class="form-group col-md-4">
  <select class="browser-default custom-select custom-select-lg mt-4" name="TransactionType">
    <option value="All" selected>Income and Expenses</option>
    <option value="Expenses">Expenses</option>
    <option value="Income">Income</option>
  </select>
</div>
</div>
<div class="container-fluid container-content">

  <div class="form-row">
      <div class="form-group col-md-12">
        <input type="text" class="form-control" name="searchkey" placeholder="Search Keyword">
      </div>

    <!--     <small id="TeamNameHelp" class="form-text text-white mt-0 mb-1">Month</small>
        <select class="browser-default custom-select custom-select-lg mb-3" name="Month">
          <?php
          /*  $MonthYearSQL = "SELECT BudgetMonth From budget GROUP by BudgetMonth Order By BudgetMonth asc;";
            $MonthYearResult = mysqli_query($conn,$MonthYearSQL);
          if (mysqli_num_rows($MonthYearResult)<=0){
            echo "<script>alert('No Budget Information. Please Add Budget Information.')</script>";
          }else {
            echo "<option value='Not Stated'>Not Stated</option>";
              while ($MonthYearRows = mysqli_fetch_array($MonthYearResult)) {
                $MonthYear = $MonthYearRows['BudgetMonth'];
                if ($MonthYear == $CurrentMonth) {
                  echo "<option value='$MonthYear' selected>$MonthYear</option>";
                }else {
                    echo "<option value='$MonthYear'>$MonthYear</option>";
                }

            }
          }
*/


           ?>-->


      <div class="form-group col-md-4">
        <small id="TeamNameHelp" class="form-text text-white mt-0 mb-1">From</small>
        <input type="date" class="form-control" name="From" placeholder="From Date">
      </div>
      <div class="form-group col-md-4">
        <small id="TeamNameHelp" class="form-text text-white mt-0 mb-1">Until</small>
        <input type="date" class="form-control" name="until" placeholder="Until Date">
      </div>
      <div class="form-group col-md-3">
          <small id="TeamNameHelp" class="form-text text-white mt-0 mb-1">Category</small>
        <select class="browser-default custom-select custom-select-lg mb-3" name="category">
          <?php
          $CategoryIncomeSQL = "SELECT * FROM Category WHERE BudgetPlanID = '$BPID' AND CategoryType = 'Income' AND CategoryStatus = '0' Order BY CategoryName asc;";
          $CategoryIncomeResult = mysqli_query($conn,$CategoryIncomeSQL);
          $CategoryExpensesSQL = "SELECT * FROM Category WHERE BudgetPlanID = '$BPID' AND CategoryType = 'Expenses' AND CategoryStatus = '0' Order BY CategoryName asc;";
          $CategoryExpensesResult = mysqli_query($conn,$CategoryExpensesSQL);
          if (mysqli_num_rows($CategoryIncomeResult)<=0 && mysqli_num_rows($CategoryExpensesResult)<=0 ){
            echo "<script>alert('No Category Data, Please Add Category.')</script>";
          }else {
            echo "<option value='Not Stated'>Not Stated</option>";
            echo "<optgroup label='Income' >";
              while ($CategoryIncomeRows = mysqli_fetch_array($CategoryIncomeResult)) {
              $DBInCategoryID =  $CategoryIncomeRows['CategoryID'];
              $DBInCategoryType =  $CategoryIncomeRows['CategoryType'];
              $DBInCategoryName =  $CategoryIncomeRows['CategoryName'];
              if ($DBInCategoryID != $CategoryID ) {
                echo "<option value='$DBInCategoryID'>$DBInCategoryName</option>";
              }else{
                echo "<option value='$DBInCategoryID' selected>$DBInCategoryName</option>";
              }
            }
            echo "<optgroup label='Expenses' >";
            while ($CategoryExpensesRows = mysqli_fetch_array($CategoryExpensesResult)) {
            $DBExCategoryID =  $CategoryExpensesRows['CategoryID'];
            $DBExCategoryType =  $CategoryExpensesRows['CategoryType'];
            $DBExCategoryName =  $CategoryExpensesRows['CategoryName'];
            if ($DBExCategoryID != $CategoryID ) {
              echo "<option value='$DBExCategoryID'>$DBExCategoryName</option>";
            }else{
              echo "<option value='$DBExCategoryID' selected>$DBExCategoryName</option>";
            }
          }
          }


           ?>
        </select>
      </div>
      <div class="form-group col-md-1">
        <small id="TeamNameHelp" class="form-text text-white mt-0 mb-1"> </small>
        <button type="submit"  class="btn btn-primary-outline mt-4 pull-right border-white">
          <span class="text-white">Search</span>
        </button>
      </div>
  </div>
</form>
</div>

<div class="container-fluid container-content rounded pl-0 pr-0 pb-0 col-12">
<div class="container-fluid float-left rounded col-4 ">
<div class="table-responsive-xl ">
<table class="table text-white border">
  <?php



if (is_null($CurrentMonth)) {
  echo "<script>alert('Not stated Month and year, Technical Error!');</script>";
  //var_dump($$TotalBudgetIncomeSQL);
//echo "<script>window.location.href = 'NewTransaction2.php?BPID=$BPID';</script>";
}else {
  $TotalBudgetIncomeSQL = "SELECT SUM(BudgetAmount) AS TotalBudgetIncome, BudgetMonth FROM budget WHERE BudgetPlanID = '$BPID' AND BudgetType = 'Income' AND BudgetMonth = '$CurrentMonth'";
  $TotalBudgetIncomeResult = mysqli_query($conn,$TotalBudgetIncomeSQL);

      $TotalBudgetIncomeRows = mysqli_fetch_array($TotalBudgetIncomeResult);
      $TotalBudgetIncome = $TotalBudgetIncomeRows['TotalBudgetIncome'];
      $BudgetMonth = $TotalBudgetIncomeRows['BudgetMonth'];
      if (is_null($TotalBudgetIncome) || is_null($BudgetMonth)) {
        $TotalBudgetIncome = 0;
      // echo "<script>alert('Not budget income information of the Month and year./n Please check is income and expenses budget are set.');</script>";
      //  echo "<script>window.location.href = 'InsertNewBudget.php?BPID=$BPID';</script>";
        //die
      }


        $TotalBudgetExpensesSQL = "SELECT SUM(BudgetAmount) AS TotalBudgetExpenses, BudgetMonth FROM budget WHERE BudgetPlanID = '$BPID' AND BudgetType = 'Expenses' AND BudgetMonth = '$CurrentMonth'";
        $TotalBudgetExpensesResult = mysqli_query($conn,$TotalBudgetExpensesSQL);

        if (mysqli_num_rows($TotalBudgetExpensesResult)<=0){
          echo "<script>alert('No Budget Expenses Information of the month and year');</script>";
          echo "<script>window.location.href = 'InsertNewBudget.php?BPID=$BPID';</script>";
        //echo "<script>window.location.href = 'NewTransaction2.php?BPID=$BPID';</script>";
        }else {
            $TotalBudgetExpensesRows = mysqli_fetch_array($TotalBudgetExpensesResult);
            $TotalBudgetExpenses = $TotalBudgetExpensesRows['TotalBudgetExpenses'];
            $BudgetMonth = $TotalBudgetExpensesRows['BudgetMonth'];
            if (is_null($TotalBudgetExpenses) || is_null($BudgetMonth)) {
              $TotalBudgetExpenses = 0;
              //echo "<script>alert('Not budget expenses information of the month and year');</script>";
              //die
            }
          //  var_dump($CurrentMonth);


      }


}

//echo Date('Y','m');

  ?>
  <thead>
    <tr>
      <td scope="col" class="text-left font-weight-bold border-right">Total Budget Income</th>
      <td scope="col" class="text-right ">RM</th>
      <td class='text-center'><?php echo  number_format($TotalBudgetIncome,2);?></td>

    </tr>
  </thead>
  <tbody>
    <td scope="col" class="text-left font-weight-bold border-right">Total Budget Expenses</th>
    <td scope="col" class="text-right">RM</th>
    <td class='text-center'><?php echo number_format($TotalBudgetExpenses,2);?></td>

  </tbody>
</table>
</div>
</div>
</div>

<div class="container-fluid">
  <a href="NewTransaction2.php?BPID=<?php echo $BPID;?>"><button type="button"  class="btn btn-dark mb-3 pull-right border-white">
    <span class="text-white">New Transaction</span>
  </button></a>
</div>

<div class="container-fluid container-content rounded">
<div class="table-responsive-xl">
<table class="table text-white table-borderless">
  <thead>
    <tr>
      <th scope="col" class="text-center">Date</th>
      <th scope="col" class="text-center">Description</th>
      <th scope="col" class="text-center">Category</th>
      <th scope="col" class="text-center">Amount (RM)</th>
      <th scope="col" class="text-center col-md-2">  Budget Expenses Running Balance (RM)</th>
      <th scope="col" class="text-center col-md-2"> Budget Income Target Miles (RM)</th>
      <th scope="col" class="text-center"></th>
    </tr>
  </thead>
  <tbody>
    <?php
  //    include 'conn.php';
  //    $BPID = $_GET['BPID'];
  $BudgetMY = explode("-",$CurrentMonth);
  $Year = $BudgetMY[0];
  $Month = $BudgetMY[1];

      $sql = "SELECT TransactionID, T.BudgetPlanID, T.CategoryID, TransactionDate, TransactionType, TransactionDesc, TransactionAmount, TransactionDescImg, C.CategoryName FROM actualtransaction T INNER JOIN Category C on C.CategoryID = T.CategoryID WHERE T.BudgetPlanID = '$BPID' AND month(TransactionDate) ='$Month' and year(TransactionDate) ='$Year' order by TransactionDate asc;";
      $result = mysqli_query($conn,$sql);

      if (mysqli_num_rows($result)<=0){

      //echo "<script>window.location.href = 'NewTransaction2.php?BPID=$BPID';</script>";
        if (is_null($TotalBudgetIncome)||is_null($TotalBudgetExpenses)) {
          echo "<script>alert('No Transaction and Budget Information. Please Add information.');</script>";
          //echo "<script>window.location.href = 'NewTransaction2.php?BPID=$BPID';</script>";
        }
      //var_dump($sql);
      }else {
        $BudgetIncome = floatval($TotalBudgetIncome);
        $BudgetExpenses = floatval($TotalBudgetExpenses);
        $TransactionTotalExpenses = number_format(floatval(0),2);
        $TransactionTotalIncome = number_format(floatval(0),2);

        while ($rows = mysqli_fetch_array($result)) {
          $TransactionID = $rows['TransactionID'];
          $BudgetPlanID = $rows['BudgetPlanID'];
          $CategoryID = $rows['CategoryID'];
          $CategoryName = $rows['CategoryName'];
          $TransactionDate = $rows['TransactionDate'];
          $TransactionType = $rows['TransactionType'];
          $TransactionDesc = $rows['TransactionDesc'];
          $TransactionAmountDB = floatval($rows['TransactionAmount']);
          $TransactionAmount = number_format(floatval($TransactionAmountDB),2);
          $TransactionImg = $rows['TransactionDescImg'];
          if ($TransactionType == 'Income') {
            $TransactionTotalIncome += $TransactionAmountDB;
          //  $TransactionTotalIncome = number_format(floatval($TransactionTIncome),2);
            $RunningIncomeBalance =  bcsub($BudgetIncome,$TransactionTotalIncome,2) ;
           // var_dump($TransactionAmountDB);
          }else{
            $TransactionTotalExpenses += $TransactionAmountDB;
            $RunningExpensesBalance = bcsub($BudgetExpenses,$TransactionTotalExpenses,2);
          //  var_dump($BudgetExpenses);
          }

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
            echo "<td class='text-center'>$RunningIncomeBalance</td>";
          }else {
            echo "<td class='text-center'> <span class='glyphicon glyphicon-minus  text-white mr-4' aria-hidden='true'></span> $TransactionAmount</td>";
            echo "<td class='text-center'>$RunningExpensesBalance</td>";
            echo "<td class='text-center'></td>";
          }

          //echo "<td class='text-center'>#Depends</td>";
          if ($CurrentMonth >= $CurrentMonth) {

          }
          echo "<td class='text-center'>";
          echo "<a href='DeleteTransaction.php?ATID=$TransactionID&BPID=$BudgetPlanID' onclick =\"return confirm('Do you really want to delete the budget plan?');\"><button type='button'  class='btn btn-primary-outline border-white ml-3 pull-right'>";
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
  </tbody>
</table>
</div>
</div>
<?php include 'footer.php';?>
