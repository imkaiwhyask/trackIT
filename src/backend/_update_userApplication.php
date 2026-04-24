<?php
session_start();

include('../config/config.php');

if(isset($_POST['submit']))
{
    if($_POST['dt']=='tisamidb')
    {
        $insert=mysqli_query($con,"UPDATE tbl_application SET name='".mysqli_escape_string($con,$_POST['name'])."',login='".mysqli_escape_string($con,$_POST['login'])."',role='".mysqli_escape_string($con,$_POST['role'])."',datetime='".mysqli_escape_string($con,$_POST['datetime'])."',lastChanged='".date('Y-m-d H:i:s')."',remarks='".mysqli_escape_string($con,$_POST['remarks'])."',status='".$_POST['status']."',byUser='".$_POST['byUser']."' where id='".$_POST['id']."'");
    }
    else
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $temp_conn = mysqli_connect("localhost", "root", "", $_POST['dt']);

        $insert=mysqli_query($temp_conn,"UPDATE ".$_POST['pref']."_user SET name='".mysqli_escape_string($con,$_POST['name'])."',login='".mysqli_escape_string($con,$_POST['login'])."',role='".mysqli_escape_string($con,$_POST['role'])."',datetime='".mysqli_escape_string($con,$_POST['datetime'])."',lastChanged='".date('Y-m-d H:i:s')."',remarks='".mysqli_escape_string($con,$_POST['remarks'])."',status='".$_POST['status']."',byUser='".$_POST['byUser']."' where id='".$_POST['id']."'");
    }
    $dt=urlencode(base64_encode($_POST['dt']));
    $apn=urlencode(base64_encode($_POST['apn']));
    $pref=urlencode(base64_encode($_POST['pref']));
    header('Location:../it/?inv='.$_POST['inv'].'&edit&success&id='.$_POST['id'].'&dt='.$dt.'&apn='.$apn.'&pref='.$pref.'');
}
    
?>