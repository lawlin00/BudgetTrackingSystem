<?php 
    ob_start();
    include ("header.php");
    $buffer=ob_get_contents();
    ob_end_clean();

    $buffer = str_replace ("%title%", "MoneyManager - Monthly Report", $buffer);
    echo $buffer;
    include 'Layout2.php';
?>

        <div class="container" style="width:1000px;">
            <div class="panel panel-default" style="width:75%;">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="panel-title">Monthly Report</h3>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div id="budget_piechart"></div>
                    <div id="actual_piechart"></div>
                </div>
            </div>    
        </div>

  <?php include 'footer.php' ?>
  
<?php
  echo "<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>";
  echo "<script type='text/javascript'>";
// Load google charts
  echo "google.charts.load('current', {'packages':['corechart']});";
  echo "google.charts.setOnLoadCallback(drawChart);";

// Draw the chart and set the chart values
    echo "function drawChart() {";
    echo "var data = google.visualization.arrayToDataTable([";
    echo "['Category', 'Amount(RM)'],";

    include ("conn.php");

    $year = $_GET['year'];
    $month = $_GET['month'];
    $budgetplan = $_GET['BPID'];
    $budget_query = "SELECT c.CategoryName, b.BudgetAmount FROM budget b INNER JOIN category c ON b.CategoryID = c.CategoryID WHERE b.BudgetPlanID = '$budgetplan' and b.BudgetMonth like '$year%$month' GROUP BY CategoryName";
    $budgetresult = mysqli_query($conn, $budget_query);
    while($row = mysqli_fetch_array($budgetresult)){
      //$arr = array($row);
      //echo json_encode($arr);
      //echo "var data = ".json_encode($arr)."]);";
      echo "['".$row["CategoryName"]."', ".$row["BudgetAmount"]."],"; 
    }
echo "]);";

  // Optional; add a title and set the width and height of the chart
  echo "var options = {'title':'Monthly Budget Expenses and Income in $month - $year', 'width':500, 'height':400};";

  // Display the chart inside the <div> element with id="piechart"
  echo "var chart = new google.visualization.PieChart(document.getElementById('budget_piechart'));";
  echo "chart.draw(data, options);";
  echo "}";
  echo "</script>";

  echo "<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>";
  echo "<script type='text/javascript'>";
// Load google charts
  echo "google.charts.load('current', {'packages':['corechart']});";
  echo "google.charts.setOnLoadCallback(drawChart2);";

// Draw the chart and set the chart values
    echo "function drawChart2() {";
    echo "var data2 = google.visualization.arrayToDataTable([";
    echo "['Category', 'Amount(RM)'],";

    include ("conn.php");

    $Month = $_GET['month'];
    $Year = $_GET['year'];
    $budgetplan = $_GET['BPID'];
    $transaction_query = "SELECT c.CategoryName, SUM(t.TransactionAmount) as amount FROM actualtransaction t INNER JOIN category c ON t.CategoryID = c.CategoryID WHERE t.BudgetPlanID = '$budgetplan' and month(TransactionDate) ='$Month' and year(TransactionDate) ='$Year' GROUP BY CategoryName";
    $transactionresult = mysqli_query($conn, $transaction_query);
    while($row = mysqli_fetch_array($transactionresult)){
      //$arr = array($row);
      //echo json_encode($arr);
      //echo "var data = ".json_encode($arr)."]);";
      echo "['".$row["CategoryName"]."', ".$row["amount"]."],"; 
    }
echo "]);";

  // Optional; add a title and set the width and height of the chart
  echo "var options2 = {'title':'Monthly Actual Expenses and Income in $Month - $Year', 'width':500, 'height':400};";

  // Display the chart inside the <div> element with id="piechart"
  echo "var chart = new google.visualization.PieChart(document.getElementById('actual_piechart'));";
  echo "chart.draw(data2, options2);";
echo "}";
echo "</script>";
?>