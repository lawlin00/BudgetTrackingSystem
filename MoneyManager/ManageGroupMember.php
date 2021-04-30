<?php
ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%title%","Team Members",$buffer);
echo $buffer;
include 'Noheaderlayout.php';
$TeamID = $_GET['TeamID'];
$UID = $_GET['UID'];
?>



<div class="h3 text-white d-flex justify-content-center mb-5">
  Member Info
</div>

<div class="d-flex justify-content-center">

  <div class="form-custom w-50 p-3">
  <div class="form-group">
<form action="InsertGroupMember.php?TeamID=<?php echo $TeamID."&UID=$UID";?>" class="" name="AddMember" method="post">

    <div class="container-fluid m-0 p-0">
    <div class="col-sm-12 float-left pl-0 mb-2 pr-0">
    <div class="form-row pr-0">
      <div class="form-group col-sm-9 mt-3">

          <input type="text" class="form-control" name="MemberEmail" placeholder="Enter Email address of the user to add member.">
          <small id="TeamMembersHelp" class="form-text text-muted text-white ml-1">Enter Email address of the user to add member.</small>


      </div>
      <div class="form-group col-sm-2 mr-0 float-right m-0">
        <button type="submit" name="addbtn" id="addbtn" class="btn btn-primary pull-left ml-0 mt-3 pull-right"><span class="glyphicon glyphicon-plus pr-3" aria-hidden="true"></span>Add Member</button>
      </div>
        </form>
    </div>
  </div>
    </div>


    <div class="form-group">
      <?php
        include 'conn.php';
        $SessionUser = $UID;
        $S_UserSQL = "SELECT UserRole As SUROle FROM userteamroles WHERE TeamID = '$TeamID' AND UserID='$SessionUser'";
        $SessionUserResult= mysqli_query($conn,$S_UserSQL);

        if (mysqli_num_rows($SessionUserResult)<=0){
          echo"<script>alert('No Session user role data from db!Technical errors!');</script>";
          //var_dump($S_UserSQL);
        }else {
          $UserRow = mysqli_fetch_assoc($SessionUserResult);
          $S_UserRole = $UserRow['SUROle'];
        }
      // var_dump($S_UserSQL);
        //var_dump($SessionUserResult);
        //var_dump($S_UserRole);


      //  var_dump($CheckSessionUserRoleSQL);
      //  $checkTeamCreatorSQL = "SELECT * FROM Team WHERE TeamID = '$TeamID';";
      //  $TeamCreatorResult = mysqli_query($conn,$checkTeamCreatorSQL);
      //  if ($CreatorRows = mysqli_fetch_array($TeamCreatorResult)) {
      //    $Creator = $CreatorRows['CreatedBy'];
      //  }
      //  else {
      //    echo"<script>alert('No Creator data from db!Technical errors!');</script>";
      //  }

        $sql = "SELECT u.UserID,ur.TeamID,ur.UserRole,u.Username, u.UserImg FROM userteamroles ur Inner Join user u on u.UserID = ur.UserID WHERE TeamID = '$TeamID' order by UserRole desc, Username asc;";
        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result)<=0){
          echo "<script>alert('No Team Members.Technical Errors!');</script>";
        //  echo "<script>window.location.href = 'AddMemberToGroup.php?TeamID=$TeamID&UID=$UID';</script>";
        }else {
          while ($rows = mysqli_fetch_array($result)) {
            $UserRole = $rows['UserRole'];
            $UserName = $rows['Username'];
            $UserID = $rows['UserID'];
            $UserImg = $rows['UserImg'];
            if (is_null($UserImg)) {
              $UserImg = "http://ssl.gstatic.com/accounts/ui/avatar_2x.png";
            }
            echo "<div  id='DynamicInput' class=''>";
            echo "<div class='row col-sm-11 mt-3 mb-1 pl-0 pr-0 ml-0 mr-0'>";
            echo "<div class='row col-sm-2 mt-2 mb-3'>";
            echo "<img src='$UserImg' width='40' height='40' class='rounded-circle'>";
            echo "</div>";
            echo "<div class='row col-sm-9 mt-3 mb-1 pl-0 pr-0 ml-0 mr-0'>";
            echo "<input type='text' class='form-control form-control-lg' name='TeamMembers' value='$UserName' aria-describedby='TeamMembersHelp' readonly>";
            echo "</div>";
            echo "<div class='row col-sm-1 mt-4 pl-0 pr-0 ml-2 mr-0  float-right'>";
            if ($UserRole == '1') {
              echo "<small id='TeamMembersHelp' class='form-text text-muted text-white'>Admin</small>";
              if ($S_UserRole === '1') {
                $CheckNoAdmin = "SELECT count(UserID) AS AdminNumber FROM userteamroles WHERE TeamID=$TeamID AND UserRole = '1';";
                $AdminResult = mysqli_query($conn,$CheckNoAdmin);
                //var_dump($CheckNoAdmin);

                if (mysqli_num_rows($AdminResult)<=0) {
                      echo "<script>alert('Technical Errors');<script>";
                      echo "<script>window.history.go(-1);</script>";
                }else {
                  $AdminRows = mysqli_fetch_assoc($AdminResult);
                  $NumberAdmin = $AdminRows['AdminNumber'];
                }

                if ($NumberAdmin >=2) {
                echo "</div>";
                echo "</div>";
                echo "<div class='col-sm-1 float-right mb-1 mt-3 pl-0 pr-0 ml-0 mr-0'>";
                echo "<button type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' class='btn btn-danger pull-right ml-4 mt-3'><span class='glyphicon glyphicon-option-vertical' aria-hidden='true'></span></button>";
                echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
                echo "<a class='dropdown-item' href='UpdateMemberStatus.php?UserID=$UserID&TeamID=$TeamID&UserRole=0&UID=$UID'>Dismiss as admin</a>";
                echo "<a class='dropdown-item' href='DeleteMember.php?UserID=$UserID&TeamID=$TeamID&UID=$UID' onclick =\"return confirm('Do you really want to remove the member?');\">Remove</a>";
              }
            }

            }else {
              echo "<small id='TeamMembersHelp' class='form-text text-muted text-white'>Members</small>";
              if ($S_UserRole==='1') {
                echo "</div>";
                echo "</div>";
                echo "<div class='col-sm-1 float-right mb-1 mt-3 pl-0 pr-0 ml-0 mr-0'>";
                echo "<button type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' class='btn btn-danger pull-right ml-4 mt-3'><span class='glyphicon glyphicon-option-vertical' aria-hidden='true'></span></button>";
                echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
                echo "<a class='dropdown-item' href='UpdateMemberStatus.php?UserID=$UserID&TeamID=$TeamID&UserRole=1&UID=$UID'>Mark as admin</a>";
                echo "<a class='dropdown-item' href='DeleteMember.php?UserID=$UserID&TeamID=$TeamID&UID=$UID' onclick =\"return confirm('Do you really want to remove the member?');\">Remove</a>";
            }
            }

            echo "</div>";
            echo "</div>";
            echo "</div>";
          }
        }


       ?>

  <div class="col-sm-6 float-left pl-0">
    <a href="DeleteMember.php?TeamID=<?php echo $TeamID;?>&UserID=<?php echo $SessionUser."&UID=$UID";?>"  onclick ="return confirm('Do you really want to remove the member?');"><button type="button" name="addbtn" id="addbtn" class="btn btn-danger pull-left ml-0 mt-3"><span class="glyphicon glyphicon-log-out pr-3" aria-hidden="true"></span>Leave Group</button></a>
    <a href = 'GroupHome.php?TeamID=<?php echo $TeamID."&UID=$UID";?>'><button type='button' class='btn btn-secondary mt-3 ml-3'>Back</button></a>
  </div>

  </div>

</div>
  </form>
  </div>
</div>

<?php  include 'footer.php'; ?>
