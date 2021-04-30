<?php
    ob_start();
    include ("header.php");
    $buffer=ob_get_contents();
    ob_end_clean();

    $buffer = str_replace ("%title%", "MoneyManager - Change Password", $buffer);
    echo $buffer;
    include 'Noheaderlayout.php';
    $email = $_GET['email'];
?>

<div class="h3 text-white d-flex justify-content-center mb-5">
  Change Password
</div>

<div class="d-flex justify-content-center">
  <div class="form-custom w-50 p-3">
  <form action="ChangePassword_function.php?email=<?php echo $email;?>" class="" name="formtemplate" method="post">

    <div class="form-group row">
        <div class="col-md-12"><label for="email">Email</label></div>
        <div class="col-md-12"><input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Email" value="<?php echo "$email";?>" readonly></div>
    </div>

    <div class="form-group row">
        <div class="col-md-12"><label for="cpwd">Current Password</label></div>
        <div class="col-md-12"><input type="password" class="form-control form-control-lg" name="cpwd" id="cpwd" placeholder="Current Password"></div>
    </div>

    <div class="form-group row">
        <div class="col-md-12"><label for="npwd">New Password</label></div>
        <div class="col-md-12"><input type="password" class="form-control form-control-lg" name="npwd" id="npwd" placeholder="New Password"></div>
        <div class="col-md-12"><small id="passwordHelpBlock" class="form-text text-muted">
          Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
        </small></div>
    </div>

    <div class="form-group row">
        <div class="col-md-12"><label for="cnpwd">Confirmed New Password</label></div>
        <div class="col-md-12"><input type="password" class="form-control form-control-lg" name="cnpwd" id="cnpwd" placeholder="Confirmed New Password"></div>
    </div>

    <div class="form-group row">
        <div class="col-md-12 text-center"><button type="submit" name="change" id="change" class="btn btn-primary">Change Password</button></div>
    </div>

    </form>
  </div>
</div>


<?php include 'footer.php' ?>
