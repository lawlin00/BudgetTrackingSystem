<?php
ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%title%","User Profile",$buffer);
echo $buffer;
  include 'Layout3.php';
  include 'conn.php';
  $id = $_SESSION['username'];
  $sql = "SELECT * From user Where Username = '$id'";
  $result = mysqli_query($conn,$sql);
  //var_dump($sql);

  if ($rows = mysqli_fetch_array($result)){
    $UID = $rows['UserID'];
    $Email = $rows['UserEmail'];
    $Dob =$rows['User_Birthday'];
    $Gender =$rows['UserGender'];
    $Username =$rows['Username'];
    $Psw =$rows['UserPassword'];
    $Role =$rows['UserRole'];
    $Profile = $rows['UserImg'];

  }
  else {
    echo "<script>alert('No Data From Database! Technical Errors!');</script>";
    //die ("<script>window.location.href='Hall.php';</script>");
  }
?>
  <div class="d-flex justify-content-center">

  <div class="userform-custom w-50 p-3">
  <form action="EditUserProfile.php" method="POST" enctype="multipart/form-data">
  <div class="form-group row" style="padding-bottom:10px">
  <div class="container bootstrap snippet" style=" display:flex;justify-content:center">
     <div class="col-sm-3" >
  <div class="profileimg" >
    <img src="<?php if (is_null($Profile)) {echo "css/Image/UserProfile/Login.png";}else {echo $Profile;}?>"  class="avatar img-circle img-thumbnail" alt="avatar" style="width:150px;height:130px" >
    <br><br>
        <input type="file" class="text-center center-block file-upload" style="color:white" name="fileimg">
        </div>
  </div>
</div>

  </div>
    <div class="form-group row">
    <input class="form-control form-control-lg" name="id" type="hidden" value="<?php echo $UID;?>" readonly/>
    <input  class="form-control form-control-lg" name="role" type="hidden" value="<?php echo $Role;?>" readonly/>
    </div>
    <div class="form-group row">
        <label for="Email" class="col-sm-3 col-form-label text-white">Email Address: </label>
        <div class="col-sm-9">
          <input type="email" class="form-control form-control-lg" name="email" value="<?php echo $Email;?>" required/>
        </div>
    </div>
    <div class="form-group row">
        <label for="Date" class="col-sm-3 col-form-label text-white">Date of Birth: </label>
        <div class="col-sm-9">
          <input type="date" class="form-control form-control-lg" name="dob" value="<?php echo $Dob;?>" required/>
        </div>
    </div>
    <div class="form-group row">
        <label for="Gender" class="col-md-3 col-form-label text-white">Gender:</label>
        <div class="col-sm-9">
          <select class="form-control form-control-lg ml-0" name="Gender" required>
            <option value="Male" <?php if($Gender == "Male"){echo "selected";}?>>Male</option>
            <option value="Female" <?php if($Gender == "Female"){echo "selected";}?>>Female</option>
          </select>
        </div>
    </div>
    <hr style="color: white">
    <h4 class="h4 text-white">Login Details</h4>
    <div class="form-group row">
        <label for="Username" class="col-sm-3 col-form-label text-white">Username: </label>
        <div class="col-sm-9">
          <input type="text" class="form-control form-control-lg" name="username" value="<?php echo $Username;?>" readonly>
        </div>
    </div>
    <div class="button" style="margin:0 auto; text-align:center; width: 150px;">
    <div class="form-group row" style="margin-right: 1em" >
    <a href="ChangePassword.php?email=<?php echo "$Email";?>"><button type="button" class="btn btn-danger pull-left">Change Password</button>
    <div class="form-group row" style="margin:0 auto; text-align:center">
          <button type="submit" class="btn btn-success">Update</button>
    </div>
</div>



  </form>
  </div>
</div>

<?php include 'footer.php'; ?>
