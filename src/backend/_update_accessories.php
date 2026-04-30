<?php
session_start();

include('../config/config.php');

if(isset($_POST['submit']))
{
    
   
        //update asset status
        $asset=mysqli_query($con,"UPDATE tbl_accessories set qty='".$_POST['qty']."',lastChanged='".date('Y-m-d H:i:s')."',byUser='".$_POST['byUser']."' where id='".$_POST['id']."' and country='".$_POST['country']."'");

   
  
    header('Location:../it/?inv='.$_POST['inv'].'&edit&id='.$_POST['id'].'&success');

}
    
?>