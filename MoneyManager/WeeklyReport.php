<?php 
    ob_start();
    include ("header.php");
    $buffer=ob_get_contents();
    ob_end_clean();

    $buffer = str_replace ("%title%", "MoneyManager - Weekly Report", $buffer);
    echo $buffer;
    include 'Layout2.php';
?>

  <div class="container" style="width:1000px;">
      <div class="panel panel-default" style="width:75%;">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-md-12">
                      <h3 class="panel-title">Weekly Report</h3>
                  </div>
              </div>
          </div>

          <div class="panel-body">
              <div id="weekly_piechart"></div>
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

    $startdate = $_GET['startdate'];
    $enddate = $_GET['enddate'];
    $budgetplan = $_GET['BPID'];
    $week_query = "SELECT c.CategoryName, SUM(t.TransactionAmount) as amount FROM actualtransaction t INNER JOIN category c ON t.CategoryID = c.CategoryID WHERE t.BudgetPlanID = '$budgetplan' and t.TransactionDate BETWEEN '$startdate' and '$enddate' GROUP BY CategoryName";
    $weekresult = mysqli_query($conn, $week_query);
    while($row = mysqli_fetch_array($weekresult)){
      //$arr = array($row);
      //echo json_encode($arr);
      //echo "var data = ".json_encode($arr)."]);";
      echo "['".$row["CategoryName"]."', ".$row["amount"]."],"; 
    }
echo "]);";

  // Optional; add a title and set the width and height of the chart
  echo "var options = {'title':'Weekly Expenses and Income on $startdate to $enddate', 'width':500, 'height':400};";

  // Display the chart inside the <div> element with id="piechart"
  echo "var chart = new google.visualization.PieChart(document.getElementById('weekly_piechart'));";
  echo "chart.draw(data, options);";
  echo "}";
  echo "</script>";
?>