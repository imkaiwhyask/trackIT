<?php
session_start();

include('../config/config.php');

if(isset($_POST['submit']))
{
  
    $update=mysqli_query($con,"UPDATE tbl_applicationlist set application='".mysqli_escape_string($con,$_POST['application'])."',description='".mysqli_escape_string($con,$_POST['description'])."',platform='".mysqli_escape_string($con,$_POST['platform'])."',lastChanged='".date('Y-m-d H:i:s')."',byUser='".$_POST['byUser']."',country='".$_POST['country']."',status='".$_POST['status']."' where id='".$_POST['id']."' and country='".$_POST['country']."'");
  
    
   header('Location:../it/?inv='.$_POST['inv'].'&edit_application&id='.$_POST['id'].'&success');

}
    
?>