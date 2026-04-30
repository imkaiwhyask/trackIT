<?php
session_start();

include('../config/config.php');

if(isset($_POST['submit']))
{
    //insert
    $update=mysqli_query($con,"UPDATE tbl_assetmain set type='".$_POST['type']."',model='".mysqli_escape_string($con,$_POST['model'])."',assetStatus='".$_POST['assetStatus']."',macAddress='".mysqli_escape_string($con,$_POST['macAddress'])."',serial='".mysqli_escape_string($con,$_POST['serial'])."',assetTag='".mysqli_escape_string($con,$_POST['assetTag'])."',computerName='".mysqli_escape_string($con,$_POST['computerName'])."',assetCondition='".$_POST['assetCondition']."',deliveryDate='".mysqli_escape_string($con,$_POST['deliveryDate'])."',warranty='".mysqli_escape_string($con,$_POST['warranty'])."',os='".mysqli_escape_string($con,$_POST['os'])."',assetRemarks='".mysqli_escape_string($con,$_POST['assetRemarks'])."',brand='".mysqli_escape_string($con,$_POST['brand'])."',osVersion='".mysqli_escape_string($con,$_POST['osVersion'])."',supplier='".mysqli_escape_string($con,$_POST['supplier'])."',disposalDate='".mysqli_escape_string($con,$_POST['disposalDate'])."',activeDirectory='".mysqli_escape_string($con,$_POST['activeDirectory'])."',byUser='".$_POST['byUser']."',lastChanged='".date('Y-m-d H:i:s')."',recoveryKey='".mysqli_escape_string($con,$_POST['recoveryKey'])."' where id='".$_POST['id']."'");

    if(isset($_POST['disposed']))
    {
        header('Location:../it/?disposed&editasset&id='.$_POST["id"].'&success');
    }
    elseif(isset($_POST['archive']))
    {
        header('Location:../it/?archive&editasset&id='.$_POST["id"].'&success');
    }
    elseif(isset($_POST['inv']))
    {
        header('Location:../it/?inv='.$_POST["inv"].'&editasset&id='.$_POST["id"].'&success');
    }
    

}
    
?>