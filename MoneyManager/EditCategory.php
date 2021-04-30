
<?php
ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%title%","Edit Category",$buffer);
echo $buffer;

include 'layout4.php';
include 'conn.php';
$BPID = $_GET['BPID'];
$cid = $_GET['cid'];
$sql = "SELECT * From category Where CategoryID = '$cid'";
$result = mysqli_query($conn,$sql);
//var_dump($sql);
if ($rows = mysqli_fetch_array($result)){
 $CName = $rows['CategoryName'];
}
else {
  echo "<script>alert('No data from database! Technical errors!');</script>";
  die ("<script>window.history.go(-1);</script>");
}
?>
<div class="box">
  <form action="UpdateEditCategory.php?BPID=<?php echo "$BPID&cid=$cid";?>" method="POST" class="form-container">
    <h3 style="text-align: center">Edit Category</h3>
  <br/>
    <div class="col-lg-12 marginTop">
            <strong class="col-lg-2">Catageory Name</strong>
            <div class="col-lg-4">
            <input class="form-control" type="text" name="categoryname" value="<?php echo $CName;?>" />
            </div>
        </div>
        <div class="col-lg-12 marginTop">
            <div class="col-lg-4">
            <input class="form-control" type="hidden" name="id" value="<?php echo $cid;?>" />
            </div>
        </div>


    <button type="submit" class="btn" style="margin-top:20px">Update</button>
    <button type="button" class="btn cancel" onclick="window.history.go(-1)" >Back</button>
  </form>
</div>
</body>
</html>
