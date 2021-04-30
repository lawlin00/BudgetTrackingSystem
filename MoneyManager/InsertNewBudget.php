<?php
    ob_start();
    include ("header.php");
    $buffer=ob_get_contents();
    ob_end_clean();

    $buffer = str_replace ("%title%", "MoneyManager - Insert New Budget", $buffer);
    echo $buffer;
    include 'Layout2.php';

    function callcategory(){
        include "conn.php";
        $budgetplan = $_GET['BPID'];
        $CategoryIncomeSQL = "SELECT * FROM Category WHERE BudgetPlanID = '$budgetplan' AND CategoryType = 'Income' AND CategoryStatus = '0' Order BY CategoryName asc;";
        $CategoryIncomeResult = mysqli_query($conn,$CategoryIncomeSQL);
        $CategoryExpensesSQL = "SELECT * FROM Category WHERE BudgetPlanID = '$budgetplan' AND CategoryType = 'Expenses' AND CategoryStatus = '0' Order BY CategoryName asc;";
        $CategoryExpensesResult = mysqli_query($conn,$CategoryExpensesSQL);
        if (mysqli_num_rows($CategoryIncomeResult)<=0 && mysqli_num_rows($CategoryExpensesResult)<=0 ){
            echo "<script>alert('No Category Data, Please Add Category.')</script>";
        }else {
            echo "<optgroup label='Income' >";
            while ($CategoryIncomeRows = mysqli_fetch_array($CategoryIncomeResult)) {
            $DBInCategoryID =  $CategoryIncomeRows['CategoryID'];
            $DBInCategoryType =  $CategoryIncomeRows['CategoryType'];
            $DBInCategoryName =  $CategoryIncomeRows['CategoryName'];
            echo "<option value='$DBInCategoryID'>$DBInCategoryName</option>";
            }
            echo "<optgroup label='Expenses' >";
            while ($CategoryExpensesRows = mysqli_fetch_array($CategoryExpensesResult)) {
            $DBExCategoryID =  $CategoryExpensesRows['CategoryID'];
            $DBExCategoryType =  $CategoryExpensesRows['CategoryType'];
            $DBExCategoryName =  $CategoryExpensesRows['CategoryName'];
            echo "<option value='$DBExCategoryID'>$DBExCategoryName</option>";
            }
        }
    }
?>

<div class="h3 text-white d-flex justify-content-center mb-5">
  Insert New Budget
</div>

<div class="d-flex justify-content-center">
  <div class="form-custom w-50 p-3">
  <form action="InsertNewBudget_function.php?BPID=<?php echo $BPID;?>" id="insert_form" method="post" name="newbudgetform">

    <div class="form-group row">
        <div class="col-md-12"><label for="month">Month</label></div>
        <div class="col-md-12"><input type="month" class="form-control form-control-lg" name="month" id="month" placeholder="Date" required></div>
    </div>

    <div class="form-group row">
        <div class="col-md-12"><label for="type">Type</label></div>
        <div class="col-md-12"><select class="form-control form-control-lg" id="type" name="type" required>
        <option>Income</option>
        <option>Expenses</option>
        </select></div>
    </div>

    <div class="form-group row">
        <div class="col-md-12"><label for="category">Category</label></div>
        <div class="col-md-12"><select class="form-control form-control-lg" id="category" name="category" required>
        <?php callcategory(); ?>
        </select></div>
    </div>

    <div class="form-group row">
        <div class="col-md-12"><label for="amount">Amount</label></div>
        <div class="col-md-12"><input type="number" class="form-control form-control-lg" name="amount" id="amount" placeholder="Amount" required></div>
    </div>

    <div class="form-group row">
        <div class="col-md-12"><label for="desc">Description</label></div>
        <div class="col-md-12"><input type="text" class="form-control form-control-lg" name="desc" id="desc" placeholder="Description"></div>
    </div>

    <div class="form-group row">
        <div class="col-md-12 text-center"><button type="submit" name="add" id="add" class="btn btn-primary">Add</button></div>
    </div>

    </form>
  </div>
</div>

<?php include 'footer.php' ?>
