<?php
//include 'header.php';
ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%title%","View Category",$buffer);
echo $buffer;
include 'Layout4.php';?>

<div class="container-fluid container-header">
  <div class="row">
    <div class="col-sm-8"><div class="h3 text-white"><caption>Income</caption></div></div>
    <div class="col-sm-4">
    <button type="button" id="myForm"  class="btn btn-primary-outline pull-right" onclick="openForm()">
        <span class="glyphicon glyphicon-plus plusicon mt-2" aria-hidden="true"></span>
      </button>
    </div>
  </div>
</div>


<div class="container-fluid container-content">
<div class="table-responsive-xl">
<table class="table text-white table-borderless">
<thead>
  <?php
$BPID = $_GET['BPID'];
  include 'conn.php';
  $sql = "SELECT * From category Where BudgetPlanID = '$BPID' and CategoryStatus = '0'";
  $result=mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)<=0){


        echo"<tr>";
        echo"<th class='col-sm-4'>NAME</th>";
        echo"<th class='text-centercol-sm-4'></th>";
        echo"</tr>";
    echo"</thead>";
  }else{

   while($rows = mysqli_fetch_array($result)){
    $Type = $rows['CategoryType'];
    $cid= $rows['CategoryID'];
        if($Type == 'Income'){
            echo "<tr>";
            echo "<td class='col-sm-4'>".$rows['CategoryName']."</td>";
            echo"<td class='text-center col-sm-4'>
            <a href='EditCategory.php?cid=$cid&BPID=$BPID' class='btn btn-info btn-xs' style='padding: 5px 10px'  ><span class='glyphicon glyphicon-edit'></span> Edit</a>
            <a href='DeleteCategory.php?cid=$cid' class='btn btn-danger btn-xs'style='padding: 5px 10px' onclick =\"return confirm('Do you really want to remove the category?');\"><span class='glyphicon glyphicon-remove'></span> Del</a></td>";
            echo "</tr>";
 }
 }
}
     ?>

</table>
</div>
</div>
<div class="container-fluid container-header">
  <div class="row">
    <div class="col-sm-8"><div class="h3 text-white"><caption>Expenses</caption></div></div>
    <div class="col-sm-4">
      <button type="button"  class="btn btn-primary-outline pull-right" id="myForm2" onclick="openForm2()">
        <span class="glyphicon glyphicon-plus plusicon mt-2" aria-hidden="true"></span>
      </button>
    </div>
  </div>
</div>

<div class="container-fluid container-content">
<div class="table-responsive-xl">
<table class="table text-white table-borderless">
<thead>
<?php
  include 'conn.php';
  $sql2 = "SELECT * From category Where BudgetPlanID = '$BPID' and CategoryStatus = '0'";
  $result2=mysqli_query($conn,$sql2);
  if(mysqli_num_rows($result2)<=0){


        echo"<tr>";
        echo"<th class='col-sm-4'>NAME</th>";
        echo"<th class='text-centercol-sm-4'></th>";
        echo"</tr>";
    echo"</thead>";
  }else{

   while($rows2 = mysqli_fetch_array($result2)){
    $Type = $rows2['CategoryType'];
    $cid= $rows2['CategoryID'];
        if($Type == 'Expenses'){
            echo "<tr>";
            echo "<td class='col-sm-4'>".$rows2['CategoryName']."</td>";
            echo"<td class='text-center col-sm-4'>
            <a href='EditCategory.php?cid=$cid&BPID=$BPID' class='btn btn-info btn-xs' style='padding: 5px 10px' ><span class='glyphicon glyphicon-edit'></span> Edit</a>
            <a href='DeleteCategory.php?cid=$cid' class='btn btn-danger btn-xs'style='padding: 5px 10px' onclick =\"return confirm('Do you really want to remove the category?');\"><span class='glyphicon glyphicon-remove'></span> Del</a></td>";
            echo "</tr>";
 }
 }
  }
     ?>
</table>
</div>
</div>



<?php include 'footer.php' ?>
