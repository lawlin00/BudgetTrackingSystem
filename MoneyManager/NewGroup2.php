<?php
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%title%","Create Team",$buffer);
echo $buffer;
include 'Noheaderlayout.php';?>

<div class="h3 text-white d-flex justify-content-center mb-5">
  New Team
</div>

<div class="d-flex justify-content-center">
  <div class="form-custom w-50 p-3">
  <form action="InsertGroup.php?UID=<?php echo $_GET['UID'];?>" class="" method="post" name="NewTeam">

    <div class="form-group">
        <label for="TeamName" class="">Team Name: </label>
          <input type="text" class="form-control form-control-lg" name="TeamName" aria-describedby="TeamNameHelp" required>
          <small id="TeamNameHelp" class="form-text text-muted text-white">This is the name of your team, company or organization</small>
    </div>

    <div class="form-group">
      <label for="TeamType" class="">Team Type:</label>
        <select class="form-control form-control-lg" name="TeamType" required>
          <option value="Education">Education</option>
          <option value="Marketing">Marketing</option>
          <option value="Business">Business</option>
          <option value="Family">Family</option>
          <option value="Other">Other</option>
        </select>
    </div>

    <div class="form-group">
        <label for="TeamDescription" class="" aria-describedby="DescHelp">Description:</label>
          <textarea class="form-control form-control-lg" name="TeamDesc" placeholder="Team Description" rows="5"></textarea>
          <small id="DescHelp" class="form-text text-muted text-white">Get your members on board with a few words about your team.</small>
    </div>

    <center>
      <button type="submit" class="btn btn-success mt-5">Create</button>
      <button type="reset" class="btn btn-info mt-5">Reset</button>
      <a href="UserHome.php"><button type="button" class="btn btn-secondary mt-5">Back</button></a>
    </center>
</div>
  </form>
  </div>
</div>

<?php include 'footer.php';?>
