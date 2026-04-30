<?php
session_start();

include('../config/config.php');

if(isset($_POST['submit']))
{
    //insert
    $query=mysqli_query($con,"INSERT INTO tbl_assetmobile (id,brand,model,serial,imei,provider,mobileNumber,amount,effectivityPlan,remarks,assetStatus,byUser,lastChanged,type,assetCondition,country) VALUES ('','".mysqli_escape_string($con,$_POST['brand'])."','".mysqli_escape_string($con,$_POST['model'])."','".mysqli_escape_string($con,$_POST['serial'])."','".mysqli_escape_string($con,$_POST['imei'])."','".mysqli_escape_string($con,$_POST['provider'])."','".mysqli_escape_string($con,$_POST['mobileNumber'])."','".mysqli_escape_string($con,$_POST['amount'])."','".mysqli_escape_string($con,$_POST['effectivityPlan'])."','".mysqli_escape_string($con,$_POST['assetRemarks'])."','".mysqli_escape_string($con,$_POST['assetStatus'])."','".mysqli_escape_string($con,$_POST['byUser'])."','".date('Y-m-d H:i:s')."','".mysqli_escape_string($con,$_POST['type'])."','".mysqli_escape_string($con,$_POST['assetCondition'])."','".$_POST['country']."')");

    //INSERT IN MOBILE LOGS
    $query2=mysqli_query($con,"INSERT INTO tbl_assetmobilelogs (id,imei,status,type,mobileNumber,country,lastChanged,byUser) VALUES ('','".mysqli_escape_string($con,$_POST['imei'])."','inactive','".mysqli_escape_string($con,$_POST['type'])."','".mysqli_escape_string($con,$_POST['mobileNumber'])."','".$_POST['country']."','".date('Y-m-d H:i:s')."','".$_POST['byUser']."')");
    
    header('Location:../it/?inv='.$_POST['inv'].'&add&success');

}
    
?>