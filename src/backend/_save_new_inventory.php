<?php
session_start();

include('../config/config.php');

if(isset($_POST['submit']))
{
     //update asset status
     $asset=mysqli_query($con,"UPDATE tbl_assetmain set assetStatus='In Use',lastChanged='".date('Y-m-d H:i:s')."',byUser='".$_POST['byUser']."' where serial='".$_POST['serial']."' and assetStatus='In Stock' and country='".$_POST['country']."'");

   
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
 
         // Verify file size - 10MB maximum
         $maxsize = 10 * 1024 * 1024;
         if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
 
         // Verify MYME type of the file
         if(in_array($filetype, $allowed)){
             // Check whether file exists before uploading it
             /*if(file_exists("../pdf/" . $filename)){
                 echo $filename . " is already exists.";
             } else{*/
                 move_uploaded_file($_FILES["permanentForm"]["tmp_name"], "../pdf/" . $filename);
                 //echo "Your file was uploaded successfully.";
                 //insert to logs
                 $insert=mysqli_query($con,"INSERT INTO tbl_assetmainlogs (id,serial,assignedTo,igg,department,location,status,remarks,permanentForms,startDate,lastChanged,byUser,country) VALUES ('','".$_POST['serial']."','".mysqli_escape_string($con,$_POST['employeeName'])."','".mysqli_escape_string($con,$_POST['igg'])."','".mysqli_escape_string($con,$_POST['department'])."','".mysqli_escape_string($con,$_POST['location'])."','active','".mysqli_escape_string($con,$_POST['remarks'])."','".$filename."','".mysqli_escape_string($con,$_POST['startDate'])."','".date('Y-m-d H:i:s')."','".$_POST['byUser']."','".$_POST['country']."')");
             //} 
         } else{
             echo "Error: There was a problem uploading your file. Please try again."; 
         }
     } 
     else
     {
         //  echo "Error: " . $_FILES["permanentForm"]["error"];
           //insert to logs
           $insert=mysqli_query($con,"INSERT INTO tbl_assetmainlogs (id,serial,assignedTo,igg,department,location,status,remarks,startDate,lastChanged,byUser,country) VALUES ('','".$_POST['serial']."','".mysqli_escape_string($con,$_POST['employeeName'])."','".mysqli_escape_string($con,$_POST['igg'])."','".mysqli_escape_string($con,$_POST['department'])."','".mysqli_escape_string($con,$_POST['location'])."','active','".mysqli_escape_string($con,$_POST['remarks'])."','".mysqli_escape_string($con,$_POST['startDate'])."','".date('Y-m-d H:i:s')."','".$_POST['byUser']."','".$_POST['country']."')");
     }
     
    //get id to update
    $get=mysqli_query($con,"SELECT id from tbl_assetmainlogs where serial='".$_POST['serial']."' and status='active' and country='".$_POST['country']."' order by id DESC LIMIT 1");
        $row=mysqli_fetch_assoc($get);

    //update accessories
    if(isset($_POST['asset']))
    {
        $length = count($_POST['asset']);
        for($i=0; $i<$length; $i++)
        {
            $column= $_POST['asset'][$i] ?? null;
            if($column)
            {   
          
                $update=mysqli_query($con,"UPDATE tbl_assetmainlogs set ".$column."='YES' where serial='".$_POST['serial']."' and id='".$row['id']."' and country='".$_POST['country']."'");
            }
        }
    }

    header('Location:../it/?inv='.$_POST['inv'].'&new&success');

}
    
?>