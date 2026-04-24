<?php
session_start();

include('../config/config.php');

    $query=mysqli_query($con,"SELECT * FROM tbl_user where login='".$_POST['username']."' and password='".sha1($_POST['password'])."'");
        if(($numrows=mysqli_num_rows($query))<>0)
        {
            $query2=mysqli_query($con,"SELECT * FROM tbl_user where login='".$_POST['username']."' and password='".sha1($_POST['password'])."'");
                $row2=mysqli_fetch_assoc($query2);
            
                $_SESSION['uidrps']=$row2['id'];

            if($row2['role']=='USER')
            {
                header('Location:../main/?laptop');
            }
            elseif($row2['role']=='IT')
            {
                header('Location:../it/');
            }
            else
            {
                header('Location:../view/?invalid');
            }
        }
        else
        {
            header('Location:../view/?invalid');
        }
?>