<?php
ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%title%","Budget Plan Details",$buffer);
echo $buffer;
include 'Noheaderlayout.php';
?>
<?php
include 'conn.php';
$BPID = $_GET['BPID'];

$sql = "SELECT * FROM budgetplan WHERE BudgetPlanID = $BPID";
$result = mysqli_query($conn,$sql);

if ($rows = mysqli_fetch_array($result)){
  $BudgetPlanID = $rows['BudgetPlanID'];
  $TeamBPID = $rows['TeamID'];
  $BudgetTitle = $rows['BudgetTitle'];
  $BudgetPlanImg = $rows['BudgetPlanImg'];
  //var_dump($TeamBPID);
}
else {
  echo "<script>alert('No data from database! Technical errors!');</script>";
  die ("<script>window.location.href='BudgetPlanHome.php?BPID=$BPID';</script>");
}

 ?>

<div class="h3 text-white d-flex justify-content-center mb-5">
  Edit Budget Plan
</div>

<div class="d-flex justify-content-center">
  <div class="form-custom w-50 p-3">
  <form action="UpdateBudgetPlan.php?BPID=<?php echo $BPID;?>" class="" name="BudgetPlan" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="PlanName" class="">Budget Name: </label>
          <input type="text" class="form-control form-control-lg" name="BudgetTitle" value="<?php echo $BudgetTitle;?>" aria-describedby="TeamNameHelp" required>
          <small id="TeamNameHelp" class="form-text text-muted text-white">This is the name of your budget plan</small>
    </div>

    <div class="form-group">
      <label for="PlanTeam" class="">Team:</label>
        <select class="form-control form-control-lg" name="PlanTeam" required>
          <?php
          //include 'conn.php';

          $getTeamNamesql = "SELECT t.TeamID, t.TeamName, t.TeamStatus,UserID FROM userteamroles ur Inner Join team t on t.TeamID = ur.TeamID WHERE UserID= '$S_UserID' AND TeamStatus = '0' order by TeamName asc;";
          $TeamNameresult = mysqli_query($conn,$getTeamNamesql);
          var_dump($getTeamNamesql);
          if (mysqli_num_rows($TeamNameresult)<=0){
            if (is_null($TeamBPID)) {
              echo "<option value='No Team' selected>No Team</option>";
            }
          }else {
            if (is_null($TeamBPID)) {
              echo "<option value='No Team' selected>No Team</option>";
              while ($TeamNameRows = mysqli_fetch_array($TeamNameresult)) {
              $TeamName =  $TeamNameRows['TeamName'];
              $TeamID =$TeamNameRows['TeamID'];

              if ($TeamBPID == $TeamID) {
                echo "<option value='$TeamID' selected>$TeamName</option>";
              }else {
                echo "<option value='$TeamID'>$TeamName</option>";
              }
              }
            }else {

              echo "<option value='No Team'>No Team</option>";
              while ($TeamNameRows = mysqli_fetch_array($TeamNameresult)) {
              $TeamName =  $TeamNameRows['TeamName'];
              $TeamID =$TeamNameRows['TeamID'];
              //var_dump($TeamID);
              if ($TeamBPID == $TeamID) {
                echo "<option value='$TeamID' selected>$TeamName</option>";
              }else {
                echo "<option value='$TeamID'>$TeamName</option>";
              }
              }
            }

          }
           ?>
        </select>
    </div>

    <div class="form-group row">
        <label for="PlanImg" class="col-sm-4 col-form-label">Budget Plan Image<small class="form-text text-muted">Optional</small></label>
        <div class="col-sm-8">
          <input type="file" class="form-control-file" name="PlanImg" id="BudgetPlanImg" aria-describedby="ImgHelp">
          <small class="form-text text-muted text-white">Only accept jpeg, jpg and png file.</small>
        </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-4"></div>
      <div class="col-sm-8">
        <img src="<?php if (is_null($BudgetPlanImg)) {echo "css/Image/BudgetPlanImg/Capture2.png";}else {echo $BudgetPlanImg;}?>" alt="previewimg" id="previewimg" class="PlanImg-custom img-responsive">
      </div>
    </div>

    <div class="container-fluid ml-0 mr-0 pl-0 pr-0 mt-3">
      <?php
      $CheckIsTeamOrNot ="SELECT * From budgetplan where BudgetPlanID = '$BPID';";
      $CheckIsTeamOrNotResult = mysqli_query($conn,$CheckIsTeamOrNot);
      if (mysqli_num_rows($CheckIsTeamOrNotResult)>=1) {
        $CheckIsTeamOrNotRows = mysqli_fetch_array($CheckIsTeamOrNotResult);
        $TeamID = $CheckIsTeamOrNotRows['TeamID'];
        if (!is_null($TeamID)) {
          // code...
        $SessionUser = $S_UserID;
        $CheckSessionUserRoleSQL = "SELECT u.UserID,ur.TeamID,ur.UserRole,u.Username FROM userteamroles ur Inner Join user u on u.UserID = ur.UserID WHERE TeamID = '$TeamID' AND ur.UserID='$SessionUser' ;";
        $SessionUserResult = mysqli_query($conn,$CheckSessionUserRoleSQL);
        if ($SessionUserRoleRows = mysqli_fetch_array($SessionUserResult)) {
          $SessionUserRole = $SessionUserRoleRows['UserRole'];


        if ( !is_null($TeamID) && $SessionUserRole == '1') {
          echo "<a href='DeleteBudgetPlan.php?BPID=$BPID;' onclick =\"return confirm('Do you really want to delete the budget plan?');\"><button type='button' class='btn btn-danger pull-left'>Delete Budget Plan</button></a>";
          echo '<div class="float-right">';

          echo '<button type="submit" class="btn btn-success">Edit</button>';

        }
      }

      }
      else {
        echo "<a href='DeleteBudgetPlan.php?BPID=$BPID;' onclick =\"return confirm('Do you really want to delete the budget plan?');\"><button type='button' class='btn btn-danger pull-left'>Delete Budget Plan</button></a>";
        echo '<div class="float-right">';
        echo '<button type="submit" class="btn btn-success">Edit</button>';


      }}
//var_dump($CheckSessionUserRoleSQL);


       ?>
       <div class="float-right">
             <a href="BudgetPlanHome.php?BPID=<?php echo $BPID;?>"><button type="button" class="btn btn-secondary ml-2">Back</button>

           </div>
               </div>



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

$("#BudgetPlanImg").change(function() {
readURL(this);
});
</script>



<?php include 'footer.php';?>
