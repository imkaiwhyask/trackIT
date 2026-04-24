<?php
    //ini_set("sendmail_from","noreply@total.com");
    session_start();
    
    date_default_timezone_set('Asia/Singapore');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';
    if(isset($_POST['submit']))
    {
        include('../config/config.php');
      
        if($_POST['status']=='DECLINED')
        {
            $update=mysqli_query($con,"UPDATE tbl_assetloan set loanStatus='Closed', status='".$_POST['status']."',comments='".mysqli_escape_string($con,$_POST['comments'])."',approvedBy='".$_POST['byUser']."',approvedDate='".date('Y-m-d')."',lastChanged='".date('Y-m-d H:i:s')."' where id='".$_POST['id']."'");
        
        }
        else {
            $update=mysqli_query($con,"UPDATE tbl_assetloan set status='".$_POST['status']."',comments='".mysqli_escape_string($con,$_POST['comments'])."',approvedBy='".$_POST['byUser']."',approvedDate='".date('Y-m-d')."',lastChanged='".date('Y-m-d H:i:s')."' where id='".$_POST['id']."'");
        
        }
        
        $get=mysqli_query($con,"SELECT * FROM tbl_assetloan where id='".$_POST['id']."'");
            $row=mysqli_fetch_assoc($get);

                    $mail = new PHPMailer;
                    $mail->isSMTP(); 
                    $mail->SMTPDebug = 5; 
                    $mail->Host = "10.30.37.15"; 
                    $mail->Port = "25"; // typically 587 
                    $mail->SMTPSecure = 'tsl'; // ssl is depracated
                    $mail->SMTPAuth = false;
                    $mail->Username = "";
                    $mail->Password = "";
                    $mail->setFrom("rm-ph.it@total.com", "RM-IT PH");
                    $mail->addAddress($row['email']);
                    $mail->addBcc('tpc-it@totalenergies.com');
                    $mail->Subject = 'Asset Loan Request - '.$row["name"].' - '.$_POST['status'].'';
                    $mail->isHTML(); 
                    $mail->Body="<html>
                    <body style='font-size:12px;font-family:Verdana,Arial;'>
                    Dear ".$row['name'].",<br/><br/>
                        ";

                        if($_POST['comments']!='')
                        {
                            $mail->Body="IT ".$_POST['status']." your Asset Loan Request due to following reason:<br>
                            ".$_POST['comments']."";
                        }
                        else
                        {
                            $mail->Body="IT ".$_POST['status']." your Asset Loan Request";
                        }

                     $mail->Body .="<br><br>Please see below details of asset loan request<br/><br/>
                    <table cellpadding='5' style='background:#ffffff;font-family:Verdana,Arial;font-size:12px;width:600px;border:1px solid #666666'>
                        <tr>
                            <td style='background:#ededed'>Name</td>
                            <td style='background:#ededed'>".$row['name']."</td>
                        </tr>
                        <tr>
                            <td>IGG</td>
                            <td>".$row['igg']."</td>
                        </tr>
                        <tr>
                            <td style='background:#ededed'>Email</td>
                            <td style='background:#ededed'>".$row['email']."</td>
                        </tr>
                        <tr>
                            <td>Contact No.</td>
                            <td>".$row['contactNo']."</td>
                        </tr>
                        <tr>
                            <td style='background:#ededed'>Asset</td>
                            <td style='background:#ededed'>".$row['asset']."</td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td>".$row['qty']."</td>
                        </tr>
                        <tr>
                            <td style='background:#ededed'>Start Date</td>
                            <td style='background:#ededed'>".$row['startDate']."</td>
                        </tr>
                        <tr>
                            <td>End Date</td>
                            <td>".$row['endDate']."</td>
                        </tr>
                        <tr>
                            <td style='background:#ededed'>Business Justification</td>
                            <td style='background:#ededed'>".$row['remarks']."</td>
                        </tr>";
                        
                            $mail->Body .='</tbody>
                                
                        </table>';
                                                           
                                            
                                $mail->Body .='
                                    <br/><br/>
                                    Thanks & Regards,<br/>
                                    TISAMI
                                    </body>
                                    </html>'; 
                    $mail->AltBody = 'HTML not supported';
                   
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );

                    if(!$mail->send())
                    {
                        echo $mail->ErrorInfo;
                    }
                    else
                    {
                    ?>
                        <script type='text/javascript'>
                            window.open("../it/?assetLoan&success");
                        </script>
                    <?php
                    }
    }
    
 
   //header('Location:../main/?assetLoan&success');
    
?>
