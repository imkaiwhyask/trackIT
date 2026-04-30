<?php
session_start();

include('../config/config.php');

if(isset($_POST['submit']))
{
    
    // UPLOAD PERMANENT FORMS
    if((isset($_FILES["permanentForm"]) && $_FILES["permanentForm"]["error"] == 0))
    {
    
        //$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $allowed = array("pdf" => "application/pdf");
        $filename = $_FILES["permanentForm"]["name"];
        $filetype = $_FILES["permanentForm"]["type"];
        $filesize = $_FILES["permanentForm"]["size"];

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            move_uploaded_file($_FILES["permanentForm"]["tmp_name"], "../pdf/" . $filename);
            $updatelogs=mysqli_query($con,"UPDATE tbl_assetmobilelogs set permanentForms='".$filename."' where id='".$_POST['id']."' and country='".$_POST['country']."'");
        } else{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    }
 
    // UPLOAD PERMANENT FORMS
    if((isset($_FILES["returnForm"]) && $_FILES["returnForm"]["error"] == 0))
    {

        //update asset status
        $asset=mysqli_query($con,"UPDATE tbl_assetmobile set assetStatus='In Stock',lastChanged='".date('Y-m-d H:i:s')."',byUser='".$_POST['byUser']."' where id='".$_POST['assetid']."' and (imei='".$_POST['imei']."' or mobileNumber='".$_POST['mobileNumber']."') and assetStatus='In Use' and country='".$_POST['country']."'");

        //$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $allowed = array("pdf" => "application/pdf");
        $filename = $_FILES["returnForm"]["name"];
        $filetype = $_FILES["returnForm"]["type"];
        $filesize = $_FILES["returnForm"]["size"];
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            /*if(file_exists("../pdf/" . $filename)){
                echo $filename . " is already exists.";
            } else{*/
                move_uploaded_file($_FILES["returnForm"]["tmp_name"], "../pdf/" . $filename);
                //echo "Your file was uploaded successfully.";
                $updatelogs=mysqli_query($con,"UPDATE tbl_assetmobilelogs set returnForms='".$filename."',status='inactive' where id='".$_POST['id']."' and country='".$_POST['country']."'");
                //} 
        } else{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } 
    
    //update other details
    $updatelogs=mysqli_query($con,"UPDATE tbl_assetmobilelogs set  imei='".mysqli_escape_string($con,$_POST['imei'])."',assignedTo='".mysqli_escape_string($con,$_POST['employeeName'])."',igg='".mysqli_escape_string($con,$_POST['igg'])."',department='".mysqli_escape_string($con,$_POST['department'])."',startDate='".mysqli_escape_string($con,$_POST['startDate'])."',endDate='".mysqli_escape_string($con,$_POST['endDate'])."',remarks='".mysqli_escape_string($con,$_POST['remarks'])."', lastChanged='".date('Y-m-d H:i:s')."',byUser='".$_POST['byUser']."',type='".mysqli_escape_string($con,$_POST['type'])."',mobileNumber='".mysqli_escape_string($con,$_POST['mobileNumber'])."',location='".$_POST['location']."',country='".$_POST['country']."' where id='".$_POST['id']."' and country='".$_POST['country']."'");
        

    //update accessories
    if(isset($_POST['asset']))
    {
        //CLEAR ALL YES ACCESSORIES
        $query_accessories=mysqli_query($con,"SELECT * FROM tbl_accessories where type='main' and country='".$_POST['country']."' group by asset order by asset");
        while($row_accessories=mysqli_fetch_assoc($query_accessories))
        {
            $colname=$row_accessories['colname'];
            $remove=mysqli_query($con,"UPDATE tbl_assetmobilelogs set $colname='NO' and id='".$_POST['id']."' and country='".$_POST['country']."'");    
        }
        //END CLEAR ALL YES ACCESSORIES


        //UPDATE ALL SELECTED ACCESSORIES
        $query_accessories=mysqli_query($con,"SELECT * FROM tbl_accessories where type='mobile' and country='".$_POST['country']."' and asset!='MOBILE' AND asset!='SIM ONLY' group by asset order by asset");
        while($row_accessories=mysqli_fetch_assoc($query_accessories))
        {
            $length = count($_POST['asset']);
            for($i=0; $i<$length; $i++)
            {
                
                if($_POST['asset'][$i]==$row_accessories['colname'])
                    {
                        $update=mysqli_query($con,"UPDATE tbl_assetmobilelogs set ".$_POST['asset'][$i]."='YES' where id='".$_POST['id']."' and country='".$_POST['country']."'");
                    }
            }
        }
        //END UPDATE ALL SELECTED ACCESSORIES
    }
    else {
            //get all accessories
            $query_accessories=mysqli_query($con,"SELECT * FROM tbl_accessories where type='mobile' and country='".$_POST['country']."' and asset!='MOBILE' AND asset!='SIM ONLY' group by asset order by asset");
            while($row_accessories=mysqli_fetch_assoc($query_accessories))
            {
               
                $colname=$row_accessories['colname'];
               
                $remove=mysqli_query($con,"UPDATE tbl_assetmobilelogs set $colname='NO' and id='".$_POST['id']."' and country='".$_POST['country']."'");
            }
        }

        if((isset($_FILES["returnForm"]) && $_FILES["returnForm"]["error"] == 0))
        {
        
                 header('Location:../it/?inv='.$_POST['inv'].'&success');
        }
        else
        {
                 header('Location:../it/?inv='.$_POST['inv'].'&edit&id='.$_POST['id'].'&assetid='.$_POST['assetid'].'&success');
        }
   

}
    
?>