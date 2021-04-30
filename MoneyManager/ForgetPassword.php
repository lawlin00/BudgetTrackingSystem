<!Doctype html>
<html>
<head>
  <title>Forget Password</title>


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
  Forget Password
</div>

<div class="d-flex justify-content-center">
  <div class="form-custom w-50 p-3">
  <form action="ForgetPassword_function.php" method="POST" class="" name="formtemplate">

  <div class="form-group row">
    <div class="col-md-12"><label for="emailaddress">Email</label></div>
    <div class="col-md-12"><input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Enter Email" required></div>
    <div class="col-md-12"><small id="emailHelp" class="form-text text-muted text-white">Please enter your valid email. We will send you an email to reset the password.</small></div>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
 </div>

    <div class="form-group row">
        <div class="col-md-12 text-center"><button type="submit" name="forget" id="forget" class="btn btn-primary">Forget Password</button>
        <a href="LoginForm.php"><button type="button" name="forget" class="btn btn-primary ml-auto">Back</button></a></div>
    </div>

    </form>
  </div>
</div>
</div>

<?php include 'footer.php' ?>
