<?php
$BPID = $_GET['BPID'];
?>
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
    <link rel="stylesheet" href="css/category.css" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Optional JavaScript -->
    <!-- jQuery CDN - Slim version (=without AJAX) -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src='https://kit.fontawesome.com/a076d05399.js'></script>

      <script>
          $(document).ready(function () {
          $("#sidenav").mCustomScrollbar({
            theme: "minimal"
          });

          $('#sidenavExpand').on('click', function () {
            $('#sidenav').toggleClass('active');
          });

        });
         function openForm() {
    document.getElementById("myForm").style.display = "block";
}

    function closeForm() {
    document.getElementById("myForm").style.display = "none";
}

function openForm2() {
    document.getElementById("myForm2").style.display = "block";
}

    function closeForm2() {
    document.getElementById("myForm2").style.display = "none";
}

      </script>


    <title>Money Manager</title>
  </head>

  <body class="bg">

      <div class="navbar navbar-expand-lg navbar-dark bg-dark navbar-custom">

        <button type="button" id="sidenavExpand" class="btn btn-primary-outline" aria-label="Menu">
          <span class="glyphicon glyphicon-menu-hamburger menuicon2" aria-hidden="true"></span>
        </button>

        <a href="UserHome.php"><img class="Logoimg" src="css/Image/Logo.png" alt="MoneyManager"></img></a>
        <!-- Search form -->



        <ul class="navbar-nav ml-auto">
          <li>
            <button type="button"  class="btn btn-primary-outline " id="CreateBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="glyphicon glyphicon-plus plusicon mt-2" aria-hidden="true"></span>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="CreateBtn">
              <a class="dropdown-item" href="NewBudgetPlan.php?UID=<?php echo $S_UserID;?>">Create Budget Plan</a>
              <a class="dropdown-item" href="NewGroup2.php?UID=<?php echo $S_UserID;?>">Create Team</a>
            </div>
            <?php
            include 'conn.php';

            $UserSQL = "SELECT * From user WHERE UserID = '$S_UserID';";
            $UserResult = mysqli_query($conn,$UserSQL);
            if (mysqli_num_rows($UserResult)<=0) {
              echo "<script>alert('No User Infomration; Please Login.');</script>";
              echo "<script>window.location.href = 'LoginForm.php';</script>";
            }else{
            $UserRows = mysqli_fetch_array($UserResult);
            $UserImg = $UserRows['UserImg'];
            $Username = $UserRows['Username'];
            if (is_null($UserImg)) {
              $UserImg = "http://ssl.gstatic.com/accounts/ui/avatar_2x.png";
            }

            }

            ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="<?php echo $UserImg;?>" width="40" height="40" class="rounded-circle">
              </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#"><?php echo $Username;?></a>
              <a class="dropdown-item" href="UserProfile.php">Profile</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="Logout.php" onclick="return confirm('Do you really want to logout?')">Log Out</a>
            </div>
          </li>
        </ul>

      </div>

      <div class="wrapper"> <!--This is for all content-->
        <!--Sidebar-->
        <div id="sidenav" >
          <ul class="list-unstyled components">

            <li>
              <a href="UserHome.php" data-toggle-"collapse" aria-exanded="false">Home</a>
            </li>

            <li>
              <a href="#BudgetSubmenu" data-toggle="collapse" aria-exanded="false" class="dropdown-toggle">Budget Plan</a>
              <ul class="collapse list-unstyled" id="BudgetSubmenu">
                <?php

                  $PersonalBudgetsql = "SELECT * FROM budgetplan WHERE UserID = '$S_UserID' ANd TeamID IS NULL AND BudgetPlanStatus = '0' ORDER BY BudgetTitle;";
                  $PersonalBudgetResult = mysqli_query($conn,$PersonalBudgetsql);

                  if (mysqli_num_rows($PersonalBudgetResult)>=1){
                    while ($PersonalBudgetRows = mysqli_fetch_array($PersonalBudgetResult)) {
                      $PersonalBudgetPlanID = $PersonalBudgetRows['BudgetPlanID'];
                      $PersonalBudgetTitle = $PersonalBudgetRows['BudgetTitle'];
                      echo "<li><a href='BudgetPlanHome.php?BPID=$PersonalBudgetPlanID'>$PersonalBudgetTitle</a></li>";
                    }
                  }//else {
                  //  echo "<script>alert('No Personal Budget Plan');</script>";
                //  }

                 ?>

                <?php
                  include 'conn.php';
                  $GroupBudgetsql = "SELECT ur.UserID, ur.TeamID, bp.BudgetPlanID, bp.BudgetTitle, bp.BudgetPlanImg FROM userteamroles ur INNER JOIN budgetplan bp on bp.TeamID = ur.TeamID WHERE ur.UserID = '$S_UserID' AND BudgetPlanStatus = '0' ORDER BY bp.BudgetTitle";
                  $GroupBudgetresult = mysqli_query($conn,$GroupBudgetsql);

                  if (mysqli_num_rows($GroupBudgetresult)>=1){
                    echo "<div class='dropdown-divider ml-4 mr-4'></div>";
                    while ($GroupBudgetRows = mysqli_fetch_array($GroupBudgetresult)) {
                      $BudgetPlanID = $GroupBudgetRows['BudgetPlanID'];
                      $BudgetTitle = $GroupBudgetRows['BudgetTitle'];
                      echo "<li><a href='BudgetPlanHome.php?BPID=$BudgetPlanID&UID=$S_UserID'>$BudgetTitle</a></li>";
                    }
                  }//else {
                  //  echo "<script>alert('No Team Budget Plan');</script>";
                //  }

                 ?>
              </ul>
            </li>


                <?php
                  $TeamSQL = "SELECT ur.UserID, ur.TeamID, t.TeamName, t.TeamStatus FROM userteamroles ur INNER Join Team t on ur.TeamID = t.TeamID WHERE ur.UserID = '$S_UserID' AND t.TeamStatus = '0' ORDER BY t.TeamName ASC";
                  $TeamResult = mysqli_query($conn,$TeamSQL);

                  if (mysqli_num_rows($TeamResult)>=1){

                    echo '<li>';
                    echo '<a href="#GroupSubMenu" data-toggle="collapse" aria-exanded="false" class="dropdown-toggle">Teams</a>';
                    echo '<ul class="collapse list-unstyled" id="GroupSubMenu">';
                    while ($TeamRows = mysqli_fetch_array($TeamResult)) {
                      $TeamName = $TeamRows['TeamName'];
                      $TeamID = $TeamRows['TeamID'];
                      echo "<li><a href='GroupHome.php?TeamID=$TeamID&UID=$S_UserID'>$TeamName</a></li>";
                    }
                    echo '</ul>';
                    echo '</li>';
                  }//else {
                  //  echo "<script>alert('No Teams');</script>";
                //  }

                 ?>


          <?php
          if($S_UserRole ==0){
            echo"<li>";
            echo "<a href='UserViewFeedback2.php' data-toggle-'collapse' aria-exanded='false'>Feedback</a>";
            echo "</li>";
          }else{
            echo"<li>";
            echo "<a href='AdminManageFeedback.php' data-toggle-'collapse' aria-exanded='false'>Manage Feedback</a>";
            echo "</li>";
            echo"<li>";
            echo "<a href='AdminManageUser.php' data-toggle-'collapse' aria-exanded='false'>Manage User</a>";
            echo "</li>";
          }

          ?>

            <li>
              <a href="Logout.php" data-toggle-"collapse" aria-exanded="false" onclick="return confirm('Do you really want to logout?')">Logout</a>
            </li>
          </ul>

        </div>

      <div class="content">
        <!--Start Code Here-->


    <div class="form-popup" id="myForm" style="position: -webkit-sticky;position: sticky;top: 0">


       <?php
       echo"<form action='UserAddCategory.php?BPID=$BPID' method='POST' class='form-container'>";
       ?>

    <h3 style="text-align: center">New Category</h3>
  <br/>
    <div class="col-lg-12 marginTop">
            <strong class="col-lg-2">Catageory Name</strong>
            <div class="col-lg-4">
            <input class="form-control" type="text" name="CName" /></div>
    </div>
    <div class="col-lg-12 marginTop">
            <strong class="col-lg-2">Catageory Type</strong>
            <div class="col-lg-4">
            <input class="form-control" type="text" name="Ctype" value="Income" readonly/></div>
        </div>


    <button type="submit" class="btn" style="margin-top:20px">Add</button>
    <button type="button" class="btn cancel"  id="myForm" onclick="closeForm()">Cancel</button>
  </form>
</div>




<div class="form-popup" id="myForm2" style="position: -webkit-sticky;position: sticky;top: 0">
<?php
  echo"<form action='UserAddCategory.php?BPID=$BPID' method='POST' class='form-container'>";
  ?>
    <h3 style="text-align: center">New Category</h3>
  <br/>
    <div class="col-lg-12 marginTop">
            <strong class="col-lg-2">Catageory Name</strong>
            <div class="col-lg-4">
            <input class="form-control" type="text" name="CName"  /></div>
    </div>
    <div class="col-lg-12 marginTop">
            <strong class="col-lg-2">Catageory Type</strong>
            <div class="col-lg-4">
            <input class="form-control" type="text" value="Expenses" name="Ctype" readonly/></div>
        </div>


    <button type="submit" class="btn" style="margin-top:20px">Add</button>
    <button type="button" class="btn cancel"  id="myForm" onclick="closeForm2()">Cancel</button>
  </form>
</div>
</form>
    <?php //include 'footer.php' ?>
  </body>
</html>
