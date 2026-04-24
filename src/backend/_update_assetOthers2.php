<?php
session_start();

include('../config/config.php');

if(isset($_POST['submit']))
{
    //insert
    if($_POST['inv']=='Servers' || $_POST['inv']=='Printers' || $_POST['inv']=='Network Devices')
    {

        $query=mysqli_query($con,"UPDATE tbl_assetothers SET name='".$_POST['name']."',location='".$_POST['location']."',localInterface='".$_POST['lcoalInterface']."',category='".$_POST['category']."',type='".mysqli_escape_string($con,$_POST['type'])."',model='".mysqli_escape_string($con,$_POST['model'])."',assetCondition='".$_POST['assetCondition']."',serial='".mysqli_escape_string($con,$_POST['serial'])."',assetStatus='".$_POST['assetStatus']."',assetRemarks='".mysqli_escape_string($con,$_POST['assetRemarks'])."',byUser='".$_POST['byUser']."',lastChanged='".date('Y-m-d H:i:s')."',os='".mysqli_escape_string($con,$_POST['os'])."',serverName='".mysqli_escape_string($con,$_POST['serverName'])."',domainName='".mysqli_escape_string($con,$_POST['domainName'])."',dnsSuffix='".mysqli_escape_string($con,$_POST['dnsSuffix'])."',ilo='".mysqli_escape_string($con,$_POST['ilo'])."',role='".mysqli_escape_string($con,$_POST['role'])."',ipAddress='".mysqli_escape_string($con,$_POST['ipAddress'])."',macAddress='".mysqli_escape_string($con,$_POST['macAddress'])."',dataPortNumber='".mysqli_escape_string($con,$_POST['dataPortNumber'])."',brand='".mysqli_escape_string($con,$_POST['brand'])."',vendor='".mysqli_escape_string($con,$_POST['vendor'])."',purchasedDate='".mysqli_escape_string($con,$_POST['purchasedDate'])."',warrantyStartDate='".mysqli_escape_string($con,$_POST['warrantyStartDate'])."',warrantyEndDate='".mysqli_escape_string($con,$_POST['warrantyEndDate'])."',serverRole='".mysqli_escape_string($con,$_POST['serverRole'])."',databaseName='".mysqli_escape_string($con,$_POST['databaseName'])."',assetType='".mysqli_escape_string($con,$_POST['assetType'])."',hostPhysicalServer='".mysqli_escape_string($con,$_POST['hostPhysicalServer'])."',byUser='".$_POST['byUser']."',lastChanged='".date('Y-m-d H:i:s')."' where id='".$_POST['id']."'");
        
        // UPLOAD ATTACHMENT1
        if((isset($_FILES["attachment1"]) && $_FILES["attachment1"]["error"] == 0))
        {
        
            //$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $allowed = array("pdf" => "application/pdf");
            $filename = $_FILES["attachment1"]["name"];
            $filetype = $_FILES["attachment1"]["type"];
            $filesize = $_FILES["attachment1"]["size"];

            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

            // Verify file size - 5MB maximum
            $maxsize = 5 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

            // Verify MYME type of the file
            if(in_array($filetype, $allowed)){
                // Check whether file exists before uploading it
                move_uploaded_file($_FILES["attachment1"]["tmp_name"], "../pdf_otherAssets/" . $filename);
                $updatelogs=mysqli_query($con,"UPDATE tbl_assetothers set attachment1='".$filename."' where id='".$_POST['id']."'");
            } else{
                echo "Error: There was a problem uploading your file. Please try again."; 
            }
        }

        // UPLOAD ATTACHMENT2
        if((isset($_FILES["attachment2"]) && $_FILES["attachment2"]["error"] == 0))
        {
        
            //$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $allowed = array("pdf" => "application/pdf");
            $filename = $_FILES["attachment2"]["name"];
            $filetype = $_FILES["attachment2"]["type"];
            $filesize = $_FILES["attachment2"]["size"];

            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

            // Verify file size - 5MB maximum
            $maxsize = 5 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

            // Verify MYME type of the file
            if(in_array($filetype, $allowed)){
                // Check whether file exists before uploading it
                move_uploaded_file($_FILES["attachment2"]["tmp_name"], "../pdf_otherAssets/" . $filename);
                $updatelogs=mysqli_query($con,"UPDATE tbl_assetothers set attachment2='".$filename."' where id='".$_POST['id']."'");
            } else{
                echo "Error: There was a problem uploading your file. Please try again."; 
            }
        }

        // UPLOAD ATTACHMENT2
        if((isset($_FILES["attachment3"]) && $_FILES["attachment3"]["error"] == 0))
        {
        
            //$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $allowed = array("pdf" => "application/pdf");
            $filename = $_FILES["attachment3"]["name"];
            $filetype = $_FILES["attachment3"]["type"];
            $filesize = $_FILES["attachment3"]["size"];

            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

            // Verify file size - 5MB maximum
            $maxsize = 5 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

            // Verify MYME type of the file
            if(in_array($filetype, $allowed)){
                // Check whether file exists before uploading it
                move_uploaded_file($_FILES["attachment3"]["tmp_name"], "../pdf_otherAssets/" . $filename);
                $updatelogs=mysqli_query($con,"UPDATE tbl_assetothers set attachment3='".$filename."' where id='".$_POST['id']."'");
            } else{
                echo "Error: There was a problem uploading your file. Please try again."; 
            }
        }

       
    }
    else {
        //insert
        $query=mysqli_query($con,"UPDATE tbl_assetothers SET category='".$_POST['category']."',type='".mysqli_escape_string($con,$_POST['type'])."',model='".mysqli_escape_string($con,$_POST['model'])."',assetCondition='".$_POST['assetCondition']."',serial='".mysqli_escape_string($con,$_POST['serial'])."',assetStatus='".$_POST['assetStatus']."',assetRemarks='".mysqli_escape_string($con,$_POST['assetRemarks'])."',byUser='".$_POST['byUser']."',lastChanged='".date('Y-m-d H:i:s')."' where id='".$_POST['id']."'");
    }
    
    header('Location:../it/?inv='.$_POST['inv'].'&editasset&id='.$_POST['id'].'&success');

}
    
?>