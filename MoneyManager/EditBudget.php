<?php
    ob_start();
    include ("header.php");
    $buffer=ob_get_contents();
    ob_end_clean();

    $buffer = str_replace ("%title%", "MoneyManager - Edit Budget", $buffer);
    echo $buffer;
    include 'Layout2.php';

    include "conn.php";
    $BPID = $_GET['BPID'];
    $bid = $_GET['BID'];
    $sql = "SELECT * from budget where BudgetPlanID = '$BPID' and BudgetID = '$bid'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_array($result)){
        $month = $row['BudgetMonth'];
        $desc = $row['BudgetDesc'];
        $amount = $row['BudgetAmount'];
        $CategoryID = $row['CategoryID'];
        $type = $row['BudgetType'];
      }
    else{
        echo "<script>alert('No data from database! Technical errors!');</script>";
    }
?>

<div class="h3 text-white d-flex justify-content-center mb-5">
  Edit Budget
</div>
<div class="d-flex justify-content-center">
  <div class="form-custom w-50 p-3">
  <form action="EditBudget_function.php?BID=<?php echo $bid; ?>&BPID=<?php echo $BPID; ?>" id="insert_form" method="post" name="newbudgetform">

    <div class="form-group row">
        <div class="col-md-12"><label for="month">Month</label></div>
        <div class="col-md-12"><input type="month" class="form-control form-control-lg" name="month" id="month" value="<?php echo $month; ?>" required></div>
    </div>

    <div class="form-group row">
        <div class="col-md-12"><label for="type">Type</label></div>
        <div class="col-md-12"><select class="form-control form-control-lg" id="type" name="type" required>
        <option <?php if($type == 'Income'){echo"selected='selected'";}?>>Income</option>
        <option <?php if($type == 'Expenses'){echo"selected='selected'";}?>>Expenses</option>
        </select></div>
    </div>

    <div class="form-group row">
        <div class="col-md-12"><label for="category">Category</label></div>
        <div class="col-md-12"><select class="form-control form-control-lg" name="Category" required>
            <?php
            $CategoryIncomeSQL = "SELECT * FROM Category WHERE BudgetPlanID = '$BPID' AND CategoryType = 'Income' AND CategoryStatus = '0' Order BY CategoryName asc;";
            $CategoryIncomeResult = mysqli_query($conn,$CategoryIncomeSQL);
            $CategoryExpensesSQL = "SELECT * FROM Category WHERE BudgetPlanID = '$BPID' AND CategoryType = 'Expenses' AND CategoryStatus = '0' Order BY CategoryName asc;";
            $CategoryExpensesResult = mysqli_query($conn,$CategoryExpensesSQL);
            if (mysqli_num_rows($CategoryIncomeResult)<=0 && mysqli_num_rows($CategoryExpensesResult)<=0 ){
              echo "<script>alert('No Category Data, Please Add Category.')</script>";
            }else {
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
        </select></div>
    </div>

    <div class="form-group row">
        <div class="col-md-12"><label for="amount">Amount</label></div>
        <div class="col-md-12"><input type="number" class="form-control form-control-lg" name="amount" id="amount" value="<?php echo $amount; ?>" required></div>
    </div>

    <div class="form-group row">
        <div class="col-md-12"><label for="desc">Description</label></div>
        <div class="col-md-12"><input type="text" class="form-control form-control-lg" name="desc" id="desc" value="<?php echo $desc;?>"></div>
    </div>

    <div class="form-group row">
        <div class="col-md-12 text-center"><button type="submit" name="save" id="save" class="btn btn-primary">Save</button></div>
    </div>

    </form>
  </div>
</div>
