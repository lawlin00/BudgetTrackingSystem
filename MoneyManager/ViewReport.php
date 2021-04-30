<?php 
    ob_start();
    include ("header.php");
    $buffer=ob_get_contents();
    ob_end_clean();

    $buffer = str_replace ("%title%", "MoneyManager - View Report", $buffer);
    echo $buffer;
    include 'Layout2.php';
    $BPID = $_GET['BPID'];   
?>

<div class="h3 text-white d-flex justify-content-center mb-5">
  View Report
</div>

<div class="d-flex justify-content-center">
<div class="form-custom w-50 p-3">
  <form action="ViewReport_function.php?BPID=<?php echo $BPID;?>" method="post" name="newbudgetform">

    <div class="form-group row">
        <div class="col-md-12"><label for="report">Report Type</label></div>
        <div class="col-md-12"><select class="form-control form-control-lg" id="report" name="report" onchange="DisplayOptions();" required>
        <option value="">Select Report Type</option>
        <option value="daily">Daily</option>
        <option value="weekly">Weekly</option>
        <option value="monthly">Monthly</option>
        <option value="annual">Annual</option>
        </select></div>
    </div>

    <!--daily-->
    <div class="form-group row" id="daily" style="display:none;">
        <div class="col-md-12"><label for="date">Please select date</label></div>
        <div class="col-md-6">
            <select name="date" class="form-control" id="date">
                <option value="">Select Date</option>
                <?php 
                include 'conn.php';
                $budgetplan = $_GET['BPID'];
                $dateSQL = "SELECT TransactionDate FROM actualtransaction WHERE BudgetPlanID = '$budgetplan' GROUP BY TransactionDate";
                $dateRESULT = mysqli_query($conn, $dateSQL);
               
                while($row = mysqli_fetch_array($dateRESULT)){
                    $DateRow = $row['TransactionDate'];
                    //var_dump($DateRow);
                    echo "<option value='$DateRow'>$DateRow</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <!--weekly-->
    <div class="form-group row" id="weekly" style="display:none;">
        <div class="col-md-12"><label for="date">Please select date</label></div>
        <div class="col-md-6">
            <select name="startdate" class="form-control" id="startdate">
                <option value="">Select Start Date</option>
                <?php 
                include 'conn.php';
                $budgetplan = $_GET['BPID'];
                $sdateSQL = "SELECT TransactionDate FROM actualtransaction WHERE BudgetPlanID = '$budgetplan' GROUP BY TransactionDate";
                $sdateRESULT = mysqli_query($conn, $sdateSQL);

                while($row = mysqli_fetch_array($sdateRESULT)){
                    $sDateRow = $row['TransactionDate'];
                    //var_dump($DateRow);
                    echo "<option value='$sDateRow'>$sDateRow</option>";
                }
                ?>
            </select>
        </div>

        <div class="col-md-6">
            <select name="enddate" class="form-control" id="enddate">
                <option value="">Select End Date</option>
                <?php 
                include 'conn.php';
                $budgetplan = $_GET['BPID'];
                $edateSQL = "SELECT TransactionDate FROM actualtransaction WHERE BudgetPlanID = '$budgetplan' GROUP BY TransactionDate";
                $edateRESULT = mysqli_query($conn, $edateSQL);

                while($row2 = mysqli_fetch_array($edateRESULT)){
                    $EdateRow = $row2['TransactionDate'];
                    //var_dump($DateRow);
                    echo "<option value='$EdateRow'>$EdateRow</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <!--monthly-->
    <div class="form-group row" id="monthly" style="display:none;">
        <div class="col-md-12"><label for="date">Please select date</label></div>   
        <div class="col-md-6">
            <select name="m_month" class="form-control" id="m_month">
                <option value="">Select Month</option>
                <?php 
                include 'conn.php';
                $budgetplan = $_GET['BPID'];
                $monthSQL = "SELECT month(TransactionDate) as DateMonth FROM actualtransaction WHERE BudgetPlanID = '$budgetplan' GROUP BY DateMonth";
                $monthRESULT = mysqli_query($conn, $monthSQL);

                while($row = mysqli_fetch_array($monthRESULT)){
                    $monthRow = $row['DateMonth'];
                    //var_dump($DateRow);
                    echo "<option value='$monthRow'>$monthRow</option>";
                }
                ?>
            </select>
        </div>

        <div class="col-md-6">
            <select name="m_year" class="form-control" id="m_year">
                <option value="">Select Year</option>
                <?php 
                include 'conn.php';
                $budgetplan = $_GET['BPID'];
                $yearSQL = "SELECT year(TransactionDate) as DateYear FROM actualtransaction WHERE BudgetPlanID = '$budgetplan' GROUP BY DateYear";
                $yearRESULT = mysqli_query($conn, $yearSQL);

                while($row = mysqli_fetch_array($yearRESULT)){
                    $YearRow = $row['DateYear'];
                    //var_dump($DateRow);
                    echo "<option value='$YearRow'>$YearRow</option>";
                }
                ?>
            </select>
        </div>
    </div>
    
    <!--annual-->
    <div class="form-group row" id="annual" style="display:none;">
        <div class="col-md-12"><label for="date">Please select date</label></div>
        <div class="col-md-6">
            <select name="a_year" class="form-control" id="a_year">
                <option value="">Select Year</option>
                <?php 
                include 'conn.php';
                $budgetplan = $_GET['BPID'];
                $yearSQL = "SELECT year(TransactionDate) as DateYear FROM actualtransaction WHERE BudgetPlanID = '$budgetplan' GROUP BY DateYear";
                $yearRESULT = mysqli_query($conn, $yearSQL);
                
                while($row = mysqli_fetch_array($yearRESULT)){
                    $DateRow = $row['DateYear'];
                    //var_dump($DateRow);
                    echo "<option value='$DateRow'>$DateRow</option>";
                }
                ?>
            </select>
        </div>
    </div>
    
    <div class="form-group row">
        <div class="col-md-12 text-center"><button type="submit" name="view" id="view" class="btn btn-primary">View</button></div>
    </div>

    </form>
  </div>
</div>

<?php include 'footer.php' ?>
<?php
   
    echo "<script type='text/javascript'>";
    echo "function DisplayOptions(){";
        echo "if(document.getElementById('report').selectedIndex == '0'){";
            echo "document.getElementById('daily').style.display = 'none';";
            echo "document.getElementById('weekly').style.display = 'none';";
            echo "document.getElementById('monthly').style.display = 'none';";
            echo "document.getElementById('annual').style.display = 'none';}";
        echo "if(document.getElementById('report').selectedIndex == '1'){";
            echo "document.getElementById('daily').style.display = 'inline';";
            echo "document.getElementById('weekly').style.display = 'none';";
            echo "document.getElementById('monthly').style.display = 'none';";
            echo "document.getElementById('annual').style.display = 'none';}";
        echo "else if(document.getElementById('report').selectedIndex == '2'){";
            echo "document.getElementById('daily').style.display = 'none';";
            echo "document.getElementById('weekly').style.display = 'inline';";
            echo "document.getElementById('monthly').style.display = 'none';";
            echo "document.getElementById('annual').style.display = 'none';}";
        echo "else if(document.getElementById('report').selectedIndex == '3'){";
            echo "document.getElementById('daily').style.display = 'none';";
            echo "document.getElementById('weekly').style.display = 'none';";
            echo "document.getElementById('monthly').style.display = 'inline';";
            echo "document.getElementById('annual').style.display = 'none';}";
        echo "else if(document.getElementById('report').selectedIndex == '4'){";
            echo "document.getElementById('daily').style.display = 'none';";
            echo "document.getElementById('weekly').style.display = 'none';";
            echo "document.getElementById('monthly').style.display = 'none';";
            echo "document.getElementById('annual').style.display = 'inline';}";
        echo "}";
    echo "</script>";

?>