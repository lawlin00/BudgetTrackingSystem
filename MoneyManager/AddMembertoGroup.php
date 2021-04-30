<?php
ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%title%","Money Manager - Add Member",$buffer);
echo $buffer;
 include 'Noheaderlayout.php';
 $TeamID = $_GET['TeamID'];

 ?>
<div class="container-fluid  mb-5">
<div class="float-right">
  <a href="GroupHome.php?TeamID=<?php echo $TeamID."&UID=$S_UserID";?>"><button type="button"  class="btn btn-primary-outline">
    <span class="text-white Detailbtn-custom">Group Home</span> <!--Go to edit group form-->
  </button></a>
</div>
</div>
<div class="h3 text-white d-flex justify-content-center mb-5">
  Add Member
</div>


<div class="d-flex justify-content-center">
  <div class="form-custom w-50 p-3">
  <form action="InsertGroupMember.php?TeamID=<?php echo $TeamID."&UID=$S_UserID";?>" class="" name="AddMember" method="post">

    <div class="form-group">
      <div class="col-sm-6 pl-0 pr-0 ml-0 mr-0">
        <label for="MemberEmail" class="" aria-describedby="DescHelp">Team Members:</label>
        <small id="TeamMembersHelp" class="form-text text-muted text-white">Enter Email address of the user to add member.</small>
      </div>
        <input type="email" class="form-control form-control-lg" name="MemberEmail" aria-describedby="TeamMembersHelp" required>
      </div>
    <!--repeat onclick-->
    <center>
      <button type="submit" class="btn btn-success">Add</button>
      </center>
  </div>

  </div>

</div>
  </form>
  </div>
</div>

<?php  include 'footer.php'; ?>
