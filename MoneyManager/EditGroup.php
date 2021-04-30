<?php
ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%title%","Team Information",$buffer);
echo $buffer;
include 'Noheaderlayout.php';
?>
<?php
include 'conn.php';
$TeamID = $_GET['TeamID'];
$UID = $_GET['UID'];
$sql = "SELECT * FROM team WHERE TeamID = $TeamID";
$result = mysqli_query($conn,$sql);

if ($rows = mysqli_fetch_array($result)){
  $TeamName = $rows['TeamName'];
  $TeamType = $rows['TeamType'];
  $TeamDesc = $rows['TeamDesc'];
}
else {
  echo "<script>alert('No data from database! Technical errors!');</script>";
  die ("<script>window.location.href='GroupHome.php';</script>");
}

 ?>

<div class="h3 text-white d-flex justify-content-center mb-5">
  <?php
  $SessionUser = $UID;
  $CheckSessionUserRoleSQL = "SELECT u.UserID,ur.TeamID,ur.UserRole,u.Username FROM userteamroles ur Inner Join user u on u.UserID = ur.UserID WHERE TeamID = '$TeamID' AND ur.UserID='$SessionUser' ;";
  $SessionUserResult = mysqli_query($conn,$CheckSessionUserRoleSQL);
  if ($SessionUserRoleRows = mysqli_fetch_array($SessionUserResult)) {
    $SessionUserRole = $SessionUserRoleRows['UserRole'];
    $SessionUserid = $SessionUserRoleRows['UserID'];
    if ($SessionUserRole == '1') {
      echo "Edit Team";
    }elseif ($SessionUserRole =='0'){
      echo "Team Information";
    }
  }
  else {
    echo"<script>alert('No Session user role data from db!Technical errors!');</script>";
  }
//  $checkTeamCreatorSQL = "SELECT * FROM Team WHERE TeamID = '$TeamID';";
//  $TeamCreatorResult = mysqli_query($conn,$checkTeamCreatorSQL);
//  if ($CreatorRows = mysqli_fetch_array($TeamCreatorResult)) {
  //  $Creator = $CreatorRows['CreatedBy'];
//  }
//  else {
//    echo"<script>alert('No Creator data from db!Technical errors!');</script>";
//  }

  ?>
</div>

<div class="d-flex justify-content-center">
  <div class="form-custom w-50 p-3">
  <form action="UpdateGroup.php?TeamID=<?php echo $TeamID."&UID=$UID";?>" class="" name="Transaction" method="post">

    <div class="form-group">
        <label for="TeamName" class="">Team Name: </label>
          <input type="text" class="form-control form-control-lg" name="TeamName" value="<?php echo $TeamName;?>" aria-describedby="TeamNameHelp"
            <?php if ($SessionUserRole == '1') { echo "required";}elseif ($SessionUserRole =='0'){echo "readonly";}?>>
          <small id="TeamNameHelp" class="form-text text-muted text-white">This is the name of your team, company or organization</small>
    </div>

    <div class="form-group">
      <label for="GroupType" class="">Team Type:</label>
        <select class="form-control form-control-lg" name="TeamType" <?php if ($SessionUserRole == '1') { echo "required";}elseif ($SessionUserRole =='0'){echo "readonly";}?>>
          <option value="Education" <?php if($TeamType== "Education"){echo "selected";}?>>Education</option>
          <option value="Marketing" <?php if($TeamType== "Marketing"){echo "selected";}?>>Marketing</option>
          <option value="Business" <?php if($TeamType== "Business"){echo "selected";}?>>Business</option>
          <option value="Family" <?php if($TeamType== "Family"){echo "selected";}?>>Family</option>
          <option value="Other" <?php if($TeamType== "Other"){echo "selected";}?>>Other</option>
        </select>
    </div>

    <div class="form-group">
        <label for="TransactionDescription" class="" aria-describedby="DescHelp">Description:</label>
          <textarea class="form-control form-control-lg" placeholder="Transaction Description" name="TeamDesc" rows="5" <?php if ($SessionUserRole =='0'){echo "readonly";}?>><?php echo $TeamDesc;?></textarea>
          <small id="DescHelp" class="form-text text-muted text-white">Get your members on board with a few words about your team.</small>
    </div>





      <?php
      if ($SessionUserRole == '1') {

        echo "<div class='container-fluid ml-0 mr-0 pl-0 pr-0 mt-3'>";
        echo "<a href='DeleteGroup.php?TeamID=$TeamID&UID=$UID'  onclick =\"return confirm('Do you really want to delete the team?');\"><button type='button' class='btn btn-danger pull-left' >Delete Team</button></a>";

        echo "<div class='float-right'>";
        echo "<button type='submit' class='btn btn-success mt-0 mr-3'>Save</button>";
        echo "<a href = 'GroupHome.php?TeamID=$TeamID&UID=$UID'><button type='button' class='btn btn-secondary mt-0'>Back</button></a>";
      }elseif ($SessionUserRole =='0'){
        echo "<div class='float-right'>";
        echo "<a href = 'GroupHome.php?TeamID=$TeamID&UID=$UID'><button type='button' class='btn btn-secondary mt-0'>Back</button></a>";
      }
      if ($SessionUserRole ='1') {
          echo "</div>";
      }
      echo "</div>";
       ?>

</div>
  </form>
  </div>
</div>

<?php include 'footer.php';?>
