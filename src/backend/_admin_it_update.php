<?php
    session_start();
    include('../config/config_stadadb.php');
    
    $update=mysqli_query($con,"UPDATE tbl_inventory_it set item='".mysqli_escape_string($con,$_POST['item'])."',brand='".mysqli_escape_string($con,$_POST['brand'])."',model='".mysqli_escape_string($con,$_POST['model'])."',serialNumber='".mysqli_escape_string($con,$_POST['serialNumber'])."',dsl='".mysqli_escape_string($con,$_POST['dsl'])."',ram='".mysqli_escape_string($con,$_POST['ram'])."',hdd='".mysqli_escape_string($con,$_POST['hdd'])."',remoteApp='".mysqli_escape_string($con,$_POST['remoteApp'])."',os='".mysqli_escape_string($con,$_POST['os'])."',pos='".mysqli_escape_string($con,$_POST['pos'])."',byUser='".$_POST['byUser']."',lastChanged='".date('Y-m-d H:i:s')."' where id='".$_POST['id']."'");
    if($update)
    {
        header('Location:../main/it/?inv='.$_POST['inv'].'&updated');
    }

    
?>