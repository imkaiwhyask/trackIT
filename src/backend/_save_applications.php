<?php
session_start();

include('../config/config.php');

if(isset($_POST['submit']))
{
  
    $insert=mysqli_query($con,"INSERT INTO tbl_applicationlist (id,application,description,platform,lastChanged,byUser,country,status) VALUES ('','".mysqli_escape_string($con,$_POST['application'])."','".mysqli_escape_string($con,$_POST['description'])."','".mysqli_escape_string($con,$_POST['platform'])."','".date('Y-m-d H:i:s')."','".$_POST['byUser']."','".$_POST['country']."','active')");
  
    
   header('Location:../it/?inv='.$_POST['inv'].'&add&success');

}
    
?>