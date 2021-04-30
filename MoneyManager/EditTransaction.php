<?php
ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%title%","Edit Transaction",$buffer);
echo $buffer;
  include 'Layout2.php';
  $BPID = $_GET['BPID'];
  $ATID = $_GET['ATID'];
?>

<?php
include 'conn.php';
$sql = "SELECT * FROM actualtransaction WHERE TransactionID = '$ATID'  AND BudgetPlanID = '$BPID';";
$result = mysqli_query($conn,$sql);

if ($rows = mysqli_fetch_array($result)){
  $TransactionID = $rows['TransactionID'];
  $BudgetPlanID = $rows['BudgetPlanID'];
  $CategoryID = $rows['CategoryID'];
  $TransactionDate = $rows['TransactionDate'];
  $TransactionType = $rows['TransactionType'];
  $TransactionDesc = $rows['TransactionDesc'];
  $TransactionAmount = $rows['TransactionAmount'];
  $TransactionImg = $rows['TransactionDescImg'];
}
else {
  echo "<script>alert('No data from database! Technical errors!');</script>";
//  die ("<script>window.location.href='BudgetPlanHome.php?BPID=$BPID';</script>");
//var_dump($sql);
}

 ?>

<div class="h3 text-white d-flex justify-content-center mb-5">
  Edit Transaction
</div>
<div class="d-flex justify-content-center">
  <div class="form-custom w-50 p-3">
  <form action="UpdateTransaction.php?ATID=<?php echo "$ATID&BPID=$BPID";?>" class="" name="Transaction" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="Date" class="">Date: </label>

          <input type="date" class="form-control form-control-lg" name="Date"  value="<?php echo $TransactionDate;?>" required>

    </div>

    <div class="form-group">
        <label for="TransactionType" class="mb-0">Transaction Type:</label>
            <small id="TeamNameHelp" class="form-text text-muted text-white mt-0 mb-1">Please Select Transaction Type</small>
          <select class="form-control form-control-lg ml-0" name="TransactionType" required>
            <option value="Income" <?php if($TransactionType == "Income"){echo "selected";}?>  >Income</option>
            <option value="Expenses" <?php if($TransactionType == "Expenses"){echo "selected";}?> >Expenses</option>
          </select>


    </div>

    <div class="form-group">
        <label for="Category" class="mb-0">Category:</label>
        <small id="TeamNameHelp" class="form-text text-muted text-white mt-0 mb-1">Please Select Category of the transaction.</small>
          <select class="form-control form-control-lg" name="Category" required>
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

          </select>
    </div>

    <div class="form-group">
        <label for="Amount" class="mb-0">Amount (RM): </label>
        <small id="TeamNameHelp" class="form-text text-muted text-white mt-0 mb-1">Please Enter Amount of your transaction.</small>
          <input type="number" class="form-control form-control-lg" name="Amount" min="0.01" step="0.01" placeholder="Example: 25.60"  value="<?php echo $TransactionAmount;?>" required>
    </div>

    <div class="form-group">
        <label for="TransactionDescription" class="mb-0" aria-describedby="DescHelp">Description:</label>
        <small id="TeamNameHelp" class="form-text text-muted text-white mt-0 mb-1">Please provide some description of your transaction.</small>
          <textarea class="form-control form-control-lg" placeholder="Transaction Description" maxlength="40" name="TransactionDesc" rows="5"><?php echo $TransactionDesc;?></textarea>
          <small id="DescHelp" class="form-text text-muted text-white"></small>
    </div>

    <div class="form-group">
        <label for="TransactionImg" class="mb-0">Transaction Image</label>
        <small id="TeamNameHelp" class="form-text text-muted text-white mt-0 mb-1">Only accept jpeg, jpg and png file</small>
          <input type="file" class="form-control-file" id="ImgInp" name="TransactionImg" aria-describedby="ImgHelp">
    </div>
    <div class="form-group row">
      <div class="col-sm-8">
        <img src="<?php echo $TransactionImg;?>" alt="Transaction Image" id="previewimg" class="PlanImg-custom img-responsive">
      </div>
    </div>

    <center>
      <a href="FinancialStatementDetails.php?BPID=<?php echo $BPID;?>"><button type="button" class="btn btn-secondary mt-3">Back</button></a>
      <button type="submit" class="btn btn-success mt-3">Save</button>
    </center>
  </form>
  </div>
</div>
<script>
function readURL(input) {
if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function(e) {
    $('#previewimg').attr('src', e.target.result);
  }

  reader.readAsDataURL(input.files[0]);
}
}

$("#ImgInp").change(function() {
readURL(this);
});
</script>

<?php include 'footer.php'; ?>
