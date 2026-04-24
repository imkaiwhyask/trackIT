<?php
session_start();

include('../config/config.php');

if(isset($_POST['submit']))
{
    
    //update asset status
    $asset=mysqli_query($con,"UPDATE tbl_assetothers set assetStatus='In Use',lastChanged='".date('Y-m-d H:i:s')."',byUser='".$_POST['byUser']."' where assetCode='".$_POST['assetCode']."' and assetStatus='In Stock' and country='".$_POST['country']."'");

    $insert=mysqli_query($con,"INSERT INTO tbl_assetotherslogs (id,assetCode,assignedTo,igg,department,location,status,remarks,lastChanged,byUser,country) VALUES ('','".$_POST['assetCode']."','".mysqli_escape_string($con,$_POST['employeeName'])."','".mysqli_escape_string($con,$_POST['igg'])."','".mysqli_escape_string($con,$_POST['department'])."','".mysqli_escape_string($con,$_POST['location'])."','active','".mysqli_escape_string($con,$_POST['remarks'])."','".date('Y-m-d H:i:s')."','".$_POST['byUser']."','".$_POST['country']."')");
  
    
   header('Location:../it/?inv='.$_POST['inv'].'&new&success');

}
    
?>