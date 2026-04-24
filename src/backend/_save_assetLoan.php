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

        $get=mysqli_query($con,"SELECT * from tbl_user where id='".$_POST['uid']."' and country='".$_POST['country']."'");
            $row=mysqli_fetch_assoc($get);

        $ref_id=uniqid();    
        $query=mysqli_query($con,"INSERT INTO tbl_assetloan (id,igg,email,name,contactNo,asset,qty,startDate,endDate,remarks,status,datetime,byUser,ref_id,country,loanStatus) VALUES ('','".$row['login']."','".$row['email']."','".$row['name']."','".mysqli_escape_string($con,$_POST['contactNo'])."','".mysqli_escape_string($con,$_POST['asset'])."','".mysqli_escape_string($con,$_POST['qty'])."','".mysqli_escape_string($con,$_POST['startDate'])."','".mysqli_escape_string($con,$_POST['endDate'])."','".mysqli_escape_string($con,$_POST['remarks'])."','PENDING','".date('Y-m-d H:i:s')."','".$row['name']."','".$ref_id."','".$_POST['country']."','Open')");

   
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
        $mail->addAddress("clara-marie.lugtu@tpcenergy.ph");
        $mail->Subject = 'Asset Loan Request - '.$row["name"].'';
        $mail->isHTML(); 
        $mail->Body="<html>
        <body style='font-size:12px;font-family:Verdana,Arial;'>
        Hi Jude,<br/><br/>
        Please see below details of asset loan request<br/><br/>
        <table cellpadding='5' style='background:#ffffff;font-family:Verdana,Arial;font-size:12px;width:600px;border:1px solid #666666'>
            <tr>
                <td style='background:#ededed'>Name</td>
                <td style='background:#ededed'>".$row['name']."</td>
            </tr>
            <tr>
                <td>IGG</td>
                <td>".$row['login']."</td>
            </tr>
            <tr>
                <td style='background:#ededed'>Email</td>
                <td style='background:#ededed'>".$row['email']."</td>
            </tr>
            <tr>
                <td>Contact No.</td>
                <td>".$_POST['contactNo']."</td>
            </tr>
            <tr>
                <td style='background:#ededed'>Asset</td>
                <td style='background:#ededed'>".$_POST['asset']."</td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td>".$_POST['qty']."</td>
            </tr>
            <tr>
                <td style='background:#ededed'>Start Date</td>
                <td style='background:#ededed'>".$_POST['startDate']."</td>
            </tr>
            <tr>
                <td>End Date</td>
                <td>".$_POST['endDate']."</td>
            </tr>
            <tr>
                <td style='background:#ededed'>Business Justification</td>
                <td style='background:#ededed'>".$_POST['remarks']."</td>
            </tr>
            <tr>
                <td style='text-align:center;color:#fff;background-color:#4e73df;'><a href='http://10.30.160.16/tisami/email_response.php?ref=".$ref_id."&status=APPROVED' style='color:#fff;text-decoration:none'><button>APPROVE</button></a></td>
                <td style='text-align:center;color:#fff;background-color:#e74a3b;'><a href='http://10.30.160.16/tisami/email_response.php?ref=".$ref_id."&status=DECLINED' style='color:#fff;text-decoration:none'><button>DECLINE</button></a></td>
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
            <!--<script type='text/javascript'>
                window.open("../main/?assetLoan&success");
            </script>-->
        <?php
            header('Location:../main/?assetLoan&success');
        }
}


//header('Location:../main/?assetLoan&success');

?>
