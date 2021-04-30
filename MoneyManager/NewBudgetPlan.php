<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","New Budget Plan",$buffer);
  echo $buffer;
  include 'Noheaderlayout.php';?>



<div class="h3 text-white d-flex justify-content-center mb-5">
  New Budget Plan
</div>

<div class="d-flex justify-content-center">
  <div class="form-custom w-50 p-3">
  <form action="InsertBudgetPlan.php?UID=<?php echo $_GET['UID'];?>" class="" name="NewBudgetPlan" method="post"  enctype="multipart/form-data">

    <div class="form-group">
        <label for="PlanName" class="">Budget Name: </label>
          <input type="text" class="form-control form-control-lg" name="BudgetName" aria-describedby="TeamNameHelp" required>
          <small id="TeamNameHelp" class="form-text text-muted text-white">This is the name of your budget plan</small>
    </div>

    <div class="form-group">
      <label for="PlanTeam" class="">Team:</label>
        <select class="form-control form-control-lg" name="BudgetTeam" required>
          <?php
          include 'conn.php';

          $getTeamNamesql = "SELECT t.TeamID, t.TeamName, t.TeamStatus,UserID FROM userteamroles ur Inner Join team t on t.TeamID = ur.TeamID WHERE UserID= '$S_UserID' AND TeamStatus = '0' order by TeamName asc;";
          $TeamNameresult = mysqli_query($conn,$getTeamNamesql);

          if (mysqli_num_rows($TeamNameresult)<=0){
              echo "<option value='No Team' selected>No Team</option>";
          }else {
            echo "<option value='No Team' selected>No Team</option>";
            while ($TeamNameRows = mysqli_fetch_array($TeamNameresult)) {
            $TeamName =  $TeamNameRows['TeamName'];
            $TeamID =$TeamNameRows['TeamID'];
              echo "<option value='$TeamID'>$TeamName</option>";
            }
          }

           ?>
        </select>
    </div>

    <div class="form-group row">
        <label for="PlanImg" class="col-sm-4 col-form-label">Budget Plan Image<small class="form-text text-muted">Optional</small></label>
        <div class="col-sm-8">
          <input type="file" class="form-control-file" name="PlanImg" id="BudgetPlanImg" aria-describedby="ImgHelp">
          <small class="form-text text-muted text-white">Only accept jpeg, jpg and png file. If no selected image, there will have a default image.</small>
        </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-4"></div>
      <div class="col-sm-8">
        <img src="css/Image/BudgetPlanImg/Capture2.png" alt="previewimg" id="previewimg" class="PlanImg-custom img-responsive">
      </div>
    </div>

    <div class="float-right">
      <a href="UserHome.php"><button type="button" class="btn btn-secondary">Back</button></a>
      <button type="reset" class="btn btn-info">Reset</button>
      <button type="submit" class="btn btn-success">Add</button>
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
