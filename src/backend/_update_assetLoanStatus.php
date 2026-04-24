<?php
    //ini_set("sendmail_from","noreply@total.com");
    date_default_timezone_set('Asia/Singapore');
    session_start();
    
    if(isset($_POST['submit']))
    {
        include('../config/config.php');
      
        $update=mysqli_query($con,"UPDATE tbl_assetloan set loanStatus='".$_POST['status']."',returnRemarks='".mysqli_escape_string($con,$_POST['returnRemarks'])."',byUser='".$_POST['byUser']."',lastChanged='".date('Y-m-d H:i:s')."' where id='".$_POST['id']."'");
        
       
    }
    
 
   header('Location:../it/?assetLoan&success');
    
?>
