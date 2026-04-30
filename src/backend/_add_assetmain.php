<?php
session_start();

include('../config/config.php');

if(isset($_POST['submit']))
{
    //check if the asset is existing
    $check=mysqli_query($con,"SELECT * from tbl_assetmain where serial='".mysqli_escape_string($con,$_POST['serial'])."'");
        $numrows=mysqli_num_rows($check);

        if($numrows<>0)
        {
            header('Location:../it/?inv='.$_POST['inv'].'&add&existing');
        }
        else
        {
   
                //insert into tbl_assetmain
                $query=mysqli_query($con,"INSERT INTO tbl_assetmain (id,type,model,assetStatus,macAddress,serial,assetTag,computerName,assetCondition,deliveryDate,warranty,os,assetRemarks,brand,byUser,datetime,activeDirectory,country,osVersion,supplier,disposalDate,recoveryKey) VALUES ('','".$_POST['type']."','".mysqli_escape_string($con,$_POST['model'])."','".mysqli_escape_string($con,$_POST['assetStatus'])."','".mysqli_escape_string($con,$_POST['macAddress'])."','".mysqli_escape_string($con,$_POST['serial'])."','".mysqli_escape_string($con,$_POST['assetTag'])."','".mysqli_escape_string($con,$_POST['computerName'])."','".mysqli_escape_string($con,$_POST['assetCondition'])."','".mysqli_escape_string($con,$_POST['deliveryDate'])."','".mysqli_escape_string($con,$_POST['warranty'])."','".mysqli_escape_string($con,$_POST['os'])."','".mysqli_escape_string($con,$_POST['assetRemarks'])."','".mysqli_escape_string($con,$_POST['brand'])."','".$_POST['byUser']."','".date('Y-m-d H:i:s')."','".mysqli_escape_string($con,$_POST['activeDirectory'])."','".$_POST['country']."','".mysqli_escape_string($con,$_POST['osVersion'])."','".mysqli_escape_string($con,$_POST['supplier'])."','".mysqli_escape_string($con,$_POST['disposalDate'])."','".mysqli_escape_string($con,$_POST['recoveryKey'])."')");

                //insert into tbl_assetmainlogs
                if($_POST['serial']=='In Use')
                {
                    $log_status='active';
                }
                else
                {
                    $log_status='inactive';
                }

                $query2=mysqli_query($con,"INSERT INTO tbl_assetmainlogs (id,serial,status,lastChanged,byUser,country) VALUES ('','".mysqli_escape_string($con,$_POST['serial'])."','".$log_status."','".date('Y-m-d H:i:s')."','".$_POST['byUser']."','PH')");

                header('Location:../it/?inv='.$_POST['inv'].'&add&success');
        }
}
    
?>