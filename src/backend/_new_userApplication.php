<?php
session_start();

include('../config/config.php');

if(isset($_POST['submit']))
{
    if($_POST['dt']=='tisamidb')
    {
        if($_POST['apn']=='TISAMI')
        {
            $insert=mysqli_query($con,"INSERT INTO tbl_user (id,login,password,role,name,lastChanged,byUser,country,icon,status,datetime,remarks) VALUES ('','".mysqli_escape_string($con,$_POST['login'])."','".sha1(mysqli_escape_string($con,$_POST['pw']))."','".mysqli_escape_string($con,$_POST['role'])."','".mysqli_escape_string($con,$_POST['name'])."','".date('Y-m-d H:i:s')."','".$_POST['byUser']."','PH','philippines.png','active','".date('Y-m-d H:i:s')."','".mysqli_escape_string($con,$_POST['remarks'])."')");
            
        }
        //powerapps user
        else
        {
            $insert=mysqli_query($con,"INSERT INTO tbl_application (id,applicationName,name,login,role,datetime,lastChanged,remarks,status,byUser) VALUES ('','".mysqli_escape_string($con,$_POST['application'])."','".mysqli_escape_string($con,$_POST['name'])."','".mysqli_escape_string($con,$_POST['login'])."','".mysqli_escape_string($con,$_POST['role'])."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."','".mysqli_escape_string($con,$_POST['remarks'])."','active','".mysqli_escape_string($con,$_POST['byUser'])."')");
        }
    }
    else
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $temp_conn = mysqli_connect("localhost", "root", "", $_POST['dt']);

        $insert=mysqli_query($temp_conn,"INSERT INTO ".$_POST['tbl_prefix']."_user (id,igg,name,login,pw,byUser,lastChanged,role,datetime,remarks,status) VALUES ('','".mysqli_escape_string($con,$_POST['igg'])."','".mysqli_escape_string($con,$_POST['name'])."','".mysqli_escape_string($con,$_POST['login'])."','".sha1(mysqli_escape_string($con,$_POST['pw']))."','".$_POST['byUser']."','".date('Y-m-d H:i:s')."','".mysqli_escape_string($con,$_POST['role'])."','".date('Y-m-d H:i:s')."','".mysqli_escape_string($con,$_POST['remarks'])."','active')");
      
    }

    header('Location:../it/?inv='.$_POST['inv'].'&new&success');
}
    
?>