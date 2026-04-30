<?php
    session_start();
    include('../config/config_stadadb.php');
    
    $update=mysqli_query($con,"INSERT INTO tbl_inventory_it (id,accountCode,item,brand,model,serialNumber,dsl,ram,hdd,remoteApp,os,pos,byUser,lastChanged) VALUES ('','".$_POST['accountCode']."','".mysqli_escape_string($con,$_POST['item'])."','".mysqli_escape_string($con,$_POST['brand'])."','".mysqli_escape_string($con,$_POST['model'])."','".mysqli_escape_string($con,$_POST['serialNumber'])."','".mysqli_escape_string($con,$_POST['dsl'])."','".mysqli_escape_string($con,$_POST['ram'])."','".mysqli_escape_string($con,$_POST['hdd'])."','".mysqli_escape_string($con,$_POST['remoteApp'])."','".mysqli_escape_string($con,$_POST['os'])."','".mysqli_escape_string($con,$_POST['pos'])."','".$_POST['byUser']."','".date('Y-m-d H:i:s')."')");
    if($update)
    {
        header('Location:../it/?inv='.$_POST['inv'].'&added');
    }
?>