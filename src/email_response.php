<?php
 date_default_timezone_set('Asia/Singapore');
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;




?>
<html>
    <head>
        <title>Email Response</title>
    </head>
    <body>
        <?php
        include('config/config.php');
        $query=mysqli_query($con,"SELECT * from tbl_assetloan where ref_id='".$_GET['ref']."' and status='PENDING'");
        if(($numrow=mysqli_num_rows($query))<>0)
            {
                $update=mysqli_query($con,"UPDATE tbl_assetloan set approvedBy='Jude Joel CAYEBA',approvedDate='".date('Y-m-d H:i:s')."',status='".$_GET['status']."' where ref_id='".$_GET['ref']."' and status='PENDING'");
                ?>
                <br><br>
                <div style='background:#d0f5e0;color:#02a348;text-align:center;padding:5px;'>Thank you for responding!</div>
                
                <?php
             
                $get=mysqli_query($con,"SELECT * from tbl_assetloan where ref_id='".$_GET['ref']."'");
                    $row=mysqli_fetch_assoc($get);
                    
                    require 'PHPMailer/src/Exception.php';
                    require 'PHPMailer/src/PHPMailer.php';
                    require 'PHPMailer/src/SMTP.php';
                    $mail = new PHPMailer;
                    $mail->isSMTP(); 
                    $mail->SMTPDebug = 5; 
                    $mail->Host = "10.30.37.15"; 
                    $mail->Port = "25"; // typically 587 
                    $mail->SMTPSecure = 'tsl'; // ssl is depracated
                    $mail->SMTPAuth = false;
                    $mail->Username = "";
                    $mail->Password = "";
                    $mail->setFrom("rm-ph.it@mail01.totalenergies.com", "RM-IT PH");
                    $mail->addAddress($row['email']);
                    $mail->Subject = 'Asset Loan Request - '.$row["name"].' - '.$_GET['status'].'';
                    $mail->isHTML(); 
                    $mail->Body="<html>
                    <body style='font-size:12px;font-family:Verdana,Arial;'>
                    Dear ".$row['name'].",<br/><br/>
                    Please see below details of asset loan request<br/><br/>
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
                                    trackIT
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
                      <!--<script type='text/javascript'>
                            window.open("../main/pb/?pb=<?php echo $_POST['pb']?>&next&success&ref=<?php echo $ref_id?>");
                            window.close();
                        </script>-->
                    <?php
                    }

                   
            }
            else{
                ?>
                <br><br>
                <div style='background:#ffb3b3;color:#ff2e2e;text-align:center;padding:5px;'>You already respond to this email.</div>
                <?php
            }
        ?>
    </body>
</html>