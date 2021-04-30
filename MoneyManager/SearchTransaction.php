<?php
ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%title%","Transaction Result",$buffer);
echo $buffer;
  include 'Layout2.php';
  include 'conn.php';
  $BPID = $_GET['BPID'];
  $searchkey= $_POST['searchkey'];
  $From = $_POST['From'];
  $Until = $_POST['until'];
  $TransactionType = $_POST['TransactionType'];
  //$Month = $_POST['Month'];
  /*if ($Month !='Not Stated') {
    $BudgetMY = explode("-",$Month);
    $Year1 = $BudgetMY[0];
    $Month1 = $BudgetMY[1];
  }
*/
  $CategoryID = $_POST['category'];

  ?>
  <form action="SearchTransaction.php?BPID=<?php echo $BPID;?>" method="post">
<div class="container-fluid container-header pl-0">
<div class="form-group col-md-4">
  <select class="browser-default custom-select custom-select-lg mt-4" name="TransactionType">
    <option value="All" <?php if ($TransactionType == 'All') {echo "selected";}?>>Income and Expenses</option>
    <option value="Expenses" <?php if ($TransactionType == 'Expenses') {echo "selected";}?>>Expenses</option>
    <option value="Income" <?php if ($TransactionType == 'Income') {echo "selected";}?>>Income</option>
  </select>

</div>
</div>
<div class="container-fluid container-content">

  <div class="form-row">
      <div class="form-group col-md-12">
        <input type="text" class="form-control" name="searchkey" placeholder="Search Description Keyword" value="<?php echo "$searchkey";?>">
      </div>
  <!--    <div class="form-group col-md-3">
            <small id="TeamNameHelp" class="form-text text-white mt-0 mb-1">Month</small>
      <select class="browser-default custom-select custom-select-lg mb-3" name="Month">
          <?php
      /*      $MonthYearSQL = "SELECT BudgetMonth From budget GROUP by BudgetMonth Order By BudgetMonth asc;";
            $MonthYearResult = mysqli_query($conn,$MonthYearSQL);
          if (mysqli_num_rows($MonthYearResult)<=0){
            echo "<script>alert('No Budget Information. Please Add Budget Information.')</script>";
          }else {
            echo "<option value='Not Stated'>Not Stated</option>";
              while ($MonthYearRows = mysqli_fetch_array($MonthYearResult)) {
                $MonthYear = $MonthYearRows['BudgetMonth'];
                if ($MonthYear == $Month) {
                  echo "<option value='$MonthYear' selected>$MonthYear</option>";
                }else {
                    echo "<option value='$MonthYear'>$MonthYear</option>";
                }

            }
          }*/

           ?>
        </select
      </div>>-->
      <div class="form-group col-md-4">
        <small id="TeamNameHelp" class="form-text text-white mt-0 mb-1">From</small>
        <input type="date" class="form-control" name="From" placeholder="From Date" value="<?php echo "$From";?>">
      </div>
      <div class="form-group col-md-4">
        <small id="TeamNameHelp" class="form-text text-white mt-0 mb-1">Until</small>
        <input type="date" class="form-control" name="until" placeholder="Until Date" value="<?php echo "$Until";?>">
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
            echo "<script>window.location.href = 'FinancialStatementDetails.php?BPID=$BPID';</script>";
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

<div class="container-fluid">
  <a href="NewTransaction2.php?BPID=<?php echo $BPID;?>"><button type="button"  class="btn btn-primary-outline mb-3 pull-right border-white">
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
      <th scope="col" class="text-center">Income / Funds (RM)</th>
      <th scope="col" class="text-center">Expenses (RM)</th>
      <th scope="col" class="text-center"></th>
    </tr>
  </thead>
  <tbody>
    <?php
  //    include 'conn.php';
  //    $BPID = $_GET['BPID'];

      $sql = "SELECT TransactionID, T.BudgetPlanID, T.CategoryID, TransactionDate, TransactionType, TransactionDesc, TransactionAmount, C.CategoryName FROM actualtransaction T INNER JOIN Category C on C.CategoryID = T.CategoryID WHERE T.BudgetPlanID = '$BPID'  ";
      $result = mysqli_query($conn,$sql);
      if (empty($From) && !empty($Until)) {
        echo "<script>alert('Please provide true date range.')</script>";
        echo "<script>window.location.href = 'FinancialStatementDetails.php?BPID=$BPID';</script>";
      }elseif (!empty($From) && empty($Until)) {
        echo "<script>alert('Please provide true date range.')</script>";
        echo "<script>window.location.href = 'FinancialStatementDetails.php?BPID=$BPID';</script>";
      }elseif(empty($From) && empty($Until)) {
        echo "<script>alert('Please enter date range.')</script>";
        echo "<script>window.location.href = 'FinancialStatementDetails.php?BPID=$BPID';</script>";
      }elseif(!empty($From) && !empty($Until)) {
        $sql.= " AND TransactionDate between '$From' AND '$Until' ";
      }

      if (!empty($searchkey)) {
        $sql.=" AND TransactionDesc Like '%$searchkey%' ";
      }

      if ($TransactionType == 'Income') {
        $sql.=" AND TransactionType = 'Income' ";
      }elseif ($TransactionType == 'Expenses') {
        $sql.=" AND TransactionType = 'Expenses' ";
      }

      if ($CategoryID != 'Not Stated') {
        $sql.=" AND C.CategoryID = '$CategoryID' order by TransactionDate asc;";
      }else {
        $sql.=" order by TransactionDate desc;";
      }

      $result = mysqli_query($conn,$sql);

      if (mysqli_num_rows($result)<=0){
        echo "<script>alert('No Transaction Data')</script>";
       // var_dump($sql);
      echo "<script>window.location.href = 'FinancialStatementDetails.php?BPID=$BPID';</script>";
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
          if ($TransactionDate >= date('Y-m')){
            echo "<td class='text-center'>";
            echo "<a href='DeleteTransaction.php?ATID=$TransactionID&BPID=$BudgetPlanID'><button type='button'  class='btn btn-primary-outline border-white ml-3 pull-right'>";
            echo "<span class='glyphicon glyphicon-trash  text-white' aria-hidden='true'></span>";
            echo "</button></a>";
            echo "<a href='EditTransaction.php?ATID=$TransactionID&BPID=$BudgetPlanID'><button type='button'  class='btn btn-primary-outline border-white ml-3 pull-right'>";
            echo "<span class='glyphicon glyphicon-pencil  text-white' aria-hidden='true'></span>";
            echo "</button></a>";
            echo "</td>";

          }else {
            echo "<td class='text-center' 'style='display: flex;'>";

            echo "</td>";
          }

          echo "</tr>";
      }
    //    var_dump($TransactionType);
      //  var_dump($sql);
    }

     ?>
  </tbody>
</table>
</div>
</div>
<?php include 'footer.php';?>
