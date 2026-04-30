<?php
session_start();

include('../config/config.php');

if(isset($_POST['submit']))
{
    
    if($_POST['status']=='active')
    {
        $assetStatus='In Use';
    }
    elseif($_POST['status']=='inactive')
    {
        $assetStatus='In Stock';
    }
   
        //update asset status
        $asset=mysqli_query($con,"UPDATE tbl_assetothers set assetStatus='".$assetStatus."',lastChanged='".date('Y-m-d H:i:s')."',byUser='".$_POST['byUser']."' where assetCode='".$_POST['assetCode']."' and assetStatus='In Use' and country='".$_POST['country']."'");

        //update logs
        $logs=mysqli_query($con,"UPDATE tbl_assetotherslogs set assignedTo='".mysqli_escape_string($con,$_POST['employeeName'])."',igg='".mysqli_escape_string($con,$_POST['igg'])."',department='".mysqli_escape_string($con,$_POST['department'])."',location='".mysqli_escape_string($con,$_POST['location'])."',remarks='".mysqli_escape_string($con,$_POST['remarks'])."',status='".$_POST['status']."',lastChanged='".date('Y-m-d H:i:s')."',byUser='".$_POST['byUser']."' where id='".$_POST['id']."' and assetCode='".$_POST['assetCode']."' and country='".$_POST['country']."'");
        
  
    header('Location:../it/?inv='.$_POST['inv'].'&edit&id='.$_POST['id'].'&success');

}
    
?>