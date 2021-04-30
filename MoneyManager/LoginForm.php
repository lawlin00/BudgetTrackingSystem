<!Doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="css/Layout.css" type="text/css" />
    <link rel="stylesheet" href="css/login.css" type="text/css" />


      <script>

        function myFunction() {
  var x = document.getElementById("exampleInputPassword1");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
      </script>


    <title>Login</title>
  </head>

  <body>

  <div class="d-flex justify-content-center">
  <div class="form-group row">
  <div class="wrapper">
  <div class="content">
    <div class="main">
    <form class="pure-form" action="Login.php" method="POST" >
      <fieldset>
        <h3>Login To Your Account</h3>
        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png"  class="avatar img-circle img-thumbnail" alt="avatar" style="width:130px;height:130px;margin-bottom:5px" name="profile">
        <p class="instruction">Please enter username and password.</p>
        <input type="text" name="username" placeholder="Username" required  size="30"/><br />
        <input type="password" name="password" placeholder="Password" id="exampleInputPassword1" required size="30"/><br />
        <input type="checkbox" onclick="myFunction()">Show Password
        <br/>
        <a href="ForgetPassword.php" class="forgetpassword">Forget Password? Click Here.</a>
        <p>
          <div class="btn" style=" margin:0 auto;width:250px">
        <button type="submit" class="pure-button pure-button-primary" style="color:black;padding: 10px 20px;border-radius: 8px;border:none" >Login</button>
          </div>
      <p>
      <a href="SignUpForm.php" class="register">Don't have account? Register Here.</a>
      </fieldset>
    </form>


  </div>
</div>
  </div>
</div>
  </div>


      <?php include 'footer.php' ?>
  </body>
</html>
