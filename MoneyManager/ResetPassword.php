<?php
  $token = $_GET['token'];
  $email = $_GET['email'];
?>

<!Doctype html>
<html>
<head>
  <title>Reset Password</title>


      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
      <link rel="stylesheet" href="css/Layout.css" type="text/css" />
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <!-- Optional JavaScript -->
      <!-- jQuery CDN - Slim version (=without AJAX) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
      <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
      <!-- jQuery Custom Scroller CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>


    </head>

    <body class="bg">

  <div style="min-height: 100vh;transition: all 0.3s;margin: 30px;">

<div class="h3 text-white d-flex justify-content-center mb-5">
  Reset Password
</div>

<div class="d-flex justify-content-center">
  <div class="form-custom w-50 p-3">
  <form action="ResetPassword_function.php?email=<?php echo $email;?>&token=<?php echo $token;?>" class="" name="formtemplate" method="post">

    <div class="form-group row">
        <div class="col-md-12"><label for="npwd">New Password</label></div>
        <div class="col-md-12"><input type="password" class="form-control form-control-lg" name="npwd" id="npwd" placeholder="New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"></div>
        <div class="col-md-12"><small id="passwordHelpBlock" class="form-text text-muted">
          Your password must be 8-20 characters long, contain at least one number and one uppercase and lowercase letter.
        </small></div>
    </div>

    <div class="form-group row">
        <div class="col-md-12"><label for="cnpwd">Confirmed New Password</label></div>
        <div class="col-md-12"><input type="password" class="form-control form-control-lg" name="cnpwd" id="cnpwd" placeholder="Confirmed New Password"></div>
    </div>

    <div class="form-group row">
        <div class="col-md-12 text-center"><button type="submit" name="reset" id="reset" class="btn btn-primary">Reset Password</button></div>
    </div>

    </form>
  </div>
</div>


<?php include 'footer.php' ?>
