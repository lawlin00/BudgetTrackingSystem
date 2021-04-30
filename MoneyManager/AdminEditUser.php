<?php
ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%title%","Manage User",$buffer);
echo $buffer;

  include 'Layout3.php';
  include 'conn.php';
  $id = $_GET['id'];
  $sql = "SELECT * From user Where UserID = '$id'";
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
   // die ("<script>window.location.href='Hall.php';</script>");
  }
?>
  <div class="d-flex justify-content-center">

  <div class="userform-custom w-50 p-3">
  <form action="AdminEditUserProfile.php" method="POST" onsubmit="return confirm('Do you really want to update the information?')" enctype="multipart/form-data">
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
    <label for="Name" class="col-sm-3 col-form-label text-white">Account ID: </label>
    <div class="col-sm-9">
    <input class="form-control form-control-lg" name="id" type="text" value="<?php echo $UID;?>"/>
    </div>
    </div>
    <div class="form-group row">
    <label for="Name" class="col-sm-3 col-form-label text-white">Role: </label>
    <div class="col-sm-9">
    <select class="form-control form-control-lg ml-0" name="role" required>
                <option value="0" <?php if($Role == "0"){echo "selected";}?>>Member</option>
                <option value="1" <?php if($Role == "1"){echo "selected";}?>>Admin</option>
              </select>
    </div>
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
          <input type="text" class="form-control form-control-lg" name="username" value="<?php echo $Username;?>" required>
        </div>
    </div>

    <div class="form-group row" style="color: white">
        <label for="Password" class="col-sm-3 col-form-label text-white">Change Password: </label>
        <div class="col-sm-9">
        <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" >
        <input type="checkbox" onclick="myFunction()">Show Password
        <small id="passwordHelpBlock" class="form-text text-white" style="padding-top: 5px">
</small>
    </div>
    </div>

    <div class="form-group row" style="color: white;display:flex;justify-content:center;padding-left:30px;padding-top:10px">
    <button type="submit" class="btn btn-primary">Update</button>
</div>

  </form>
  </div>
</div>

<?php include 'footer.php'; ?>
