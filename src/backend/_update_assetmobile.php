<?php
session_start();

include('../config/config.php');

if(isset($_POST['submit']))
{
    //insert
    $update=mysqli_query($con,"UPDATE tbl_assetmobile set brand='".mysqli_escape_string($con,$_POST['brand'])."',model='".mysqli_escape_string($con,$_POST['model'])."',serial='".mysqli_escape_string($con,$_POST['serial'])."',imei='".mysqli_escape_string($con,$_POST['imei'])."',provider='".mysqli_escape_string($con,$_POST['provider'])."',mobileNumber='".mysqli_escape_string($con,$_POST['mobileNumber'])."',amount='".mysqli_escape_string($con,$_POST['amount'])."',effectivityPlan='".mysqli_escape_string($con,$_POST['effectivityPlan'])."',remarks='".mysqli_escape_string($con,$_POST['assetRemarks'])."',assetStatus='".$_POST['assetStatus']."',byUser='".$_POST['byUser']."',lastChanged='".date('Y-m-d H:i:s')."',subscriptionStatus='".mysqli_escape_string($con,$_POST['subscriptionStatus'])."',type='".mysqli_escape_string($con,$_POST['type'])."',assetCondition='".mysqli_escape_string($con,$_POST['assetCondition'])."' where id='".$_POST['id']."' and country='".$_POST['country']."'");

    header('Location:../it/?inv='.$_POST["inv"].'&editasset&id='.$_POST["id"].'&success');

}
    
?>