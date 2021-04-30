<?php 
    ob_start();
    include ("header.php");
    $buffer=ob_get_contents();
    ob_end_clean();

    $buffer = str_replace ("%title%", "MoneyManager - Annual Report", $buffer);
    echo $buffer;
    include 'Layout2.php';
?>

  <div class="container" style="width:1000px;">
      <div class="panel panel-default" style="width:75%;">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-md-9">
                      <h3 class="panel-title">Annual Report</h3>
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
    $budgetplan = $_GET['BPID'];
    $budget_query = "SELECT c.CategoryName, SUM(b.BudgetAmount) as amount FROM budget b INNER JOIN category c ON b.CategoryID = c.CategoryID WHERE b.BudgetPlanID = '$budgetplan' and b.BudgetMonth like '$year%' GROUP BY CategoryName";
    $budgetresult = mysqli_query($conn, $budget_query);
    while($row = mysqli_fetch_array($budgetresult)){
      //$arr = array($row);
      //echo json_encode($arr);
      //echo "var data = ".json_encode($arr)."]);";
      echo "['".$row["CategoryName"]."', ".$row["amount"]."],"; 
    }
echo "]);";

  // Optional; add a title and set the width and height of the chart
  echo "var options = {'title':'Annual Budget Expenses and Income in $year', 'width':500, 'height':400};";

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

    $year = $_GET['year'];
    $budgetplan = $_GET['BPID'];
    $transaction_query = "SELECT c.CategoryName, SUM(t.TransactionAmount) as amount FROM actualtransaction t INNER JOIN category c ON t.CategoryID = c.CategoryID WHERE t.BudgetPlanID = '$budgetplan' and year(t.TransactionDate) = '$year' GROUP BY CategoryName";
    $transactionresult = mysqli_query($conn, $transaction_query);
    while($row2 = mysqli_fetch_array($transactionresult)){
      //$arr = array($row);
      //echo json_encode($arr);
      //echo "var data = ".json_encode($arr)."]);";
      echo "['".$row2["CategoryName"]."', ".$row2["amount"]."],"; 
    }
echo "]);";

  // Optional; add a title and set the width and height of the chart
  echo "var options2 = {'title':'Annual Actual Expenses and Income in $year', 'width':500, 'height':400};";

  // Display the chart inside the <div> element with id="piechart"
  echo "var chart2 = new google.visualization.PieChart(document.getElementById('actual_piechart'));";
  echo "chart2.draw(data2, options2);";
echo "}";
echo "</script>";
?>