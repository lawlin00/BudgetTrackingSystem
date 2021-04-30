<?php

include "conn.php";
$BPID = $_GET['BPID'];


$name = mysqli_real_escape_string($conn,$_POST['CName']);
$type = mysqli_real_escape_string($conn,$_POST['Ctype']);

//$sql="SELECT CategoryName,BudgetPlanID,CategoryStatus,CategoryID FROM category WHERE BudgetPlanID ='$BPID' ORDER BY CategoryName AND BudgetPlanID";
//$result = mysqli_query($conn,$sql);
//if ($rows = mysqli_fetch_array($result)>0){
 // $CN= $rows['CategoryName'];
  //$CBPID =  $rows['CBPID'];
  //$SCS =$rows['CategoryStatus'];
  //$CID=$rows['CategoryID'];

//  if( $name == $CN & $BPID == $CBPID){
  //  if($SCS='1'){
    //  $sql3 ="Update category SET CategoryStatus = '0' WHERE CategoryID = '$CID'";   
    //}else
    //echo"<script>alert('Data is already there!');</script>";
    //}else 

$sql2 = "INSERT INTO category ( CategoryName, CategoryType,BudgetPlanID) VALUES".
                            "('$name','$type','$BPID');";
  mysqli_query($conn,$sql2);

    if(mysqli_affected_rows($conn)<=0){
        echo"<script>alert('Unable to Insert Data, Please Try Again!');</script>";
      die("<script>window.history.go(-1);</script>");
    }

    else{
    echo"<script>alert('Insert Sucessfully!')</script>";
   echo "<script>window.location.href='viewCategory.php?BPID=$BPID';</script>";
    }
//}
  

?>
