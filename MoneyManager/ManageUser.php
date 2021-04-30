<?php include 'Layout5.php' ?>

<div class="container-fluid container-header">
  <div class="row">
    <div class="col-sm-8"><div class="h3 text-white"></div></div>
    <div class="col-sm-4">
            <form action="AdminAddUser.php" method="POST">
    <button type="button"  class="btn btn-primary-outline pull-right" >
        <span class="glyphicon glyphicon-plus plusicon mt-2" aria-hidden="true"></span>
      </button>
      </form>
    </div>
  </div>
  </div>

<div class="container-fluid container-content">
<div class="table-responsive-xl">
<table class="table text-white table-borderless">
<thead>
        <tr>
            <th class="col-sm-4">Username</th>
            <th class="col-sm-4">Email</th>
            <th class="col-sm-4">Role</th>
            <th class="text-center col-sm-4"></th>
        </tr>
</thead>
<?php
include 'conn.php';
$sql = "SELECT * From user";
        $result = mysqli_query($conn,$sql);
        while ($rows = mysqli_fetch_array($result) ) {
echo "<tr>";        
echo "<td class='col-sm-4'>".$rows['Username']."</td>";
echo "<td class='col-sm-4'>".$rows['UserEmail']."</td>";
echo "<td class='col-sm-4'>".$rows['UserRole']."</td>";
echo "<td class='text-center col-sm-4'><a class='btn btn-info btn-xs' href = 'AdminEditUser.php?id=".$rows['UserID']."' style='padding: 5px 10px'><span class='glyphicon glyphicon-edit'></span>Edit</a></td>";
echo "<td><a href='#' class='btn btn-danger btn-xs'style='padding: 5px 10px'><span class='glyphicon glyphicon-remove'></span> Del</a></td>";
echo "</tr>";
        }
?>        
</table>
</div>
</div>  
<?php include 'footer.php' ?>