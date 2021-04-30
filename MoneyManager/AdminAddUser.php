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
    <link rel="stylesheet" href="css/signup.css" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

      <script>
         $(document).ready(function() {


var readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.avatar').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


$(".file-upload").on('change', function(){
    readURL(this);
});
});

function myFunction() {
  var x = document.getElementById("myRadio").required;
 
}

      </script>


    <title>Add User</title>
  </head>

  <body>
  <div class="d-flex justify-content-center">
  <div class="form-group row">
  <div class="wrapper">
  <div class="content">
    <div class="main">
    <Form id="Form" action="AdminSignUp.php" method="POST">
      <fieldset>
        <h3>Sign Up Form</h3>
        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png"  class="avatar img-circle img-thumbnail" alt="avatar" style="width:130px;height:130px;margin-bottom:15px;">
        
        <hr>
        <p class="instruction">Please fill in this form to create an acoount.</p>
        <p class="section">Section 1 - Basic Information</p>
        <input type="email" name="email" placeholder="Email Address" required size="29"/><br />
        <label id="lbldob">Date of Birth: </label>
        <input type="date" name="dob" placeholder="Date of Birth" size="20" required  /><br/>
        <label id="lblgender" require>Gender: </label>
        <form action="/action_page.php">
        <input type="radio" name="gender"  id="myRadio" value="Male" required />Male
        <input type="radio" name="gender" id="myRadio" value="Female" required />Female</p>
        </form>
        <hr />
        <p class="section">Section 2 - Login Detail</p>
        <input type="text" name="username" placeholder="Username" title="Please Enter your desire username" required size="29"/><br />
        <input type="password" id="password" name="password" placeholder="Password" required size="29"/><br />
        <input type="password" id="comfirm_password" name="confirmpsw" placeholder="Re-type your Password" required size="29"/><br />
        <select  name="role" required style="color: black;margin-left:5px;margin-top:5px;width:245px;padding:5px 0" >
                <option value="0" >Member</option>
                <option value="1" >Admin</option>
              </select>
     
        <br />
        <div class="setbutton">
        <button type="submit" style="color:black;padding: 10px 20px;border-radius: 8px;border:none;position:absolute;background-color:#4CAF50" >Confirm</button>
        <a href="http://localhost/MoneyManager/Adminmanageuser.php" target="_blank">Back</a>
        </div>
    </fieldset>
    </form>
</div>

      <br/>
  </div>
</div>
  </div>
</div>
  </div>
  </div>


      <?php include 'footer.php' ?>
  </body>
</html>
