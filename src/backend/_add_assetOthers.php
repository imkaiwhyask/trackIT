<?php
session_start();

include('../config/config.php');

if(isset($_POST['submit']))
{
    //get the last asset
    $get=mysqli_query($con,"SELECT assetCode FROM tbl_assetothers where country='".$_POST['country']."' order by id DESC LIMIT 1");
        $row=mysqli_fetch_assoc($get);
        $lastAsset=substr($row['assetCode'], 2);
      
        //generate asset code
        $increment=$lastAsset+1;
        $newAsset=$_POST['country'].str_pad($increment, 6, '0', STR_PAD_LEFT);

    //insert
    if($_POST['inv']=='Servers' || $_POST['inv']=='Printers' || $_POST['inv']=='Network Devices')
    {

        $query=mysqli_query($con,"INSERT INTO tbl_assetothers (id,assetCode,category,type,model,assetCondition,serial,assetStatus,assetRemarks,byUser,lastChanged,country,os,serverName,domainName,dnsSuffix,ilo,role,ipAddress,macAddress,dataPortNumber,brand,vendor,purchasedDate,warrantyStartDate,warrantyEndDate,serverRole,databaseName,assetType,hostPhysicalServer) VALUES ('','".$newAsset."','".$_POST['category']."','".mysqli_escape_string($con,$_POST['type'])."','".mysqli_escape_string($con,$_POST['model'])."','".$_POST['assetCondition']."','".mysqli_escape_string($con,$_POST['serial'])."','".$_POST['assetStatus']."','".mysqli_escape_string($con,$_POST['assetRemarks'])."','".$_POST['byUser']."','".date('Y-m-d H:i:s')."','".$_POST['country']."','".mysqli_escape_string($con,$_POST['os'])."','".mysqli_escape_string($con,$_POST['serverName'])."','".mysqli_escape_string($con,$_POST['domainName'])."','".mysqli_escape_string($con,$_POST['dnsSuffix'])."','".mysqli_escape_string($con,$_POST['ilo'])."','".mysqli_escape_string($con,$_POST['role'])."','".mysqli_escape_string($con,$_POST['ipAddress'])."','".mysqli_escape_string($con,$_POST['macAddress'])."','".mysqli_escape_string($con,$_POST['dataPortNumber'])."','".mysqli_escape_string($con,$_POST['brand'])."','".mysqli_escape_string($con,$_POST['vendor'])."','".mysqli_escape_string($con,$_POST['purchasedDate'])."','".mysqli_escape_string($con,$_POST['warrantyStartDate'])."','".mysqli_escape_string($con,$_POST['warrantyEndDate'])."','".mysqli_escape_string($con,$_POST['serverRole'])."','".mysqli_escape_string($con,$_POST['databaseName'])."','".mysqli_escape_string($con,$_POST['assetType'])."','".mysqli_escape_string($con,$_POST['hostPhysicalServer'])."')");
        
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
                $updatelogs=mysqli_query($con,"UPDATE tbl_assetothers set attachment1='".$filename."' where assetCode='".$newAsset."' and country='".$_POST['country']."'");
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
                $updatelogs=mysqli_query($con,"UPDATE tbl_assetothers set attachment2='".$filename."' where assetCode='".$newAsset."' and country='".$_POST['country']."'");
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
                $updatelogs=mysqli_query($con,"UPDATE tbl_assetothers set attachment3='".$filename."' where assetCode='".$newAsset."' and country='".$_POST['country']."'");
            } else{
                echo "Error: There was a problem uploading your file. Please try again."; 
            }
        }

       
    }
    else {
        $query=mysqli_query($con,"INSERT INTO tbl_assetothers (id,assetCode,category,type,model,assetCondition,serial,assetStatus,assetRemarks,byUser,lastChanged,country) VALUES ('','".$newAsset."','".$_POST['category']."','".mysqli_escape_string($con,$_POST['type'])."','".mysqli_escape_string($con,$_POST['model'])."','".$_POST['assetCondition']."','".mysqli_escape_string($con,$_POST['serial'])."','".$_POST['assetStatus']."','".mysqli_escape_string($con,$_POST['assetRemarks'])."','".$_POST['byUser']."','".date('Y-m-d H:i:s')."','".$_POST['country']."')");
    }
   

    header('Location:../it/?inv='.$_POST['inv'].'&add&success');

}
    
?>