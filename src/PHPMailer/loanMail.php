
<body style="font-family:calibri">
<?php

//DECLARATION
$IGG = $_POST['lIGG'];
$FNAME = $_POST['lFName'];
$EMAIL = $_POST['lEAdd'];
$CONTACT = $_POST['lCNo'];

$ASSET = $_POST['lAsset'];
$QTY = $_POST['lQTY'];

$FROM = $_POST['lFrom'];
$TO = $_POST['lTo'];
$BUJU = $_POST['lBuJu'];

$y = "";
$x = "In Progress";

$APPCODE = sha1(rand(1,10000000));
$DENCODE = sha1(rand(1,10000000));

        $server = "localhost";
        $username = "tis_admin";
        $password = "t0T4l15itm";
        $dbname = "dbtisami";

        $conn = new mysqli($server, $username, $password, $dbname);

        if ($conn->connect_error) {
            die('Could not connect: ' . $conn->connect_error);
        }

        $stmt=$conn->prepare("INSERT INTO tblloan (ID,IGG,FullName,EmailAdd,ContactNo,Unit,Qty,DateFrom,DateTo,BuJu,ApprovalCode,DeniedCode,ApprovalStatus) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("issssssssssss",$y,$IGG,$FNAME,$EMAIL,$CONTACT,$ASSET,$QTY,$FROM,$TO,$BUJU,$APPCODE,$DENCODE,$x);
        $stmt->execute();
        $stmt->close();

        $conn->close();

//STORE LOAN REQUEST TO DB

//START OF MAILER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

//SEND MAIL TO Approver(
    $mail = new PHPMailer;
    $mail->isSMTP(); 
    $mail->SMTPDebug = 0; 
    $mail->Host = "10.30.37.15"; 
    $mail->Port = "25"; // typically 587 
    $mail->SMTPSecure = 'tsl'; // ssl is depracated
    $mail->SMTPAuth = false;
    $mail->Username = "";
    $mail->Password = "";
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->setFrom("rm-ph.it@total.com", "RM-IT PH");
    $mail->addAddress("Ryan.Delos-Reyes@total.com");
    //$mail->addCC("Ryan.Delos-Reyes@total.com");
    $mail->Subject = "Loan Request - ".$IGG." - ".$ASSET."";
    $mail->msgHTML("
        <span style=\"font-family:Calibri\">
        Hi Sir Ryan,
        <br><br>
        Requesting for your approval for an asset loan request that has been submitted to our team. Please see below details:
        <br><br>
        <table>
            <tr>
                <td width=120px><u>IGG:</u> 
                <td width=100px>&emsp;".$IGG."
            </tr>
            <tr>
                <td><u>Full Name:</u>
                <td>&emsp;".$FNAME."
            </tr>
            <tr>
                <td><u>Email Address: </u>
                <td>&emsp;".$EMAIL."
            </tr>
            <tr>
                <td><u>Contact No:</u>
                <td>&emsp;".$CONTACT."
            </tr>
            <tr>
                <td>&emsp;
                <td>&emsp;
            </tr>
            <tr>
                <td><u>Asset:</u>
                <td>&emsp;".$ASSET."
            </tr>
            <tr>
                <td><u>Quantity:  </u>
                <td>&emsp;".$QTY."
            </tr>
            <tr>
                <td>&emsp;
                <td>&emsp;
            </tr>
            <tr>
                <td><u>Date From:</u>
                <td>&emsp;".$FROM."
            </tr>
            <tr>
                <td><u>Date To:</u>
                <td>&emsp;".$TO."
            </tr>
            <tr>
                <td>&emsp;
                <td>&emsp;
            </tr>
            </table>
            <table>
            <tr>
                <td colspan=2><u>Business Justification:</u>
            </tr>
            <tr>
                <td colspan=2>".$BUJU."
            </tr>
        </table>

        <br><br><br>

        <table> 
            <tr>
                <td style=\"width:100px; text-align:center; border:1px solid;\">
                    <a href=\"10.30.160.16/tisami/mail/mailResponse?s=$APPCODE\"><b>APPROVE</b></a>
                </td>
                <td>
                    &emsp;
                </td>
                <td style=\"width:100px; text-align:center; border:1px solid;\">               
                    <a href=\"10.30.160.16/tisami/mail/mailResponse?s=$DENCODE\"><b>DENY</b></a>
                </td>
            </tr>
        </table>

        <br><br><br>
        TOTAL IT Services - Asset Management and Inventory (TISAMI)
    </span>
    "); // remove if you do not want to send HTML email
    $mail->AltBody = 'HTML not supported';
    //$mail->addAttachment('docs/brochure.pdf'); //Attachment, can be skipped

    $mail->send();
//)

//SEND MAIL TO REQUESTOR(
    $mail2 = new PHPMailer;
    $mail2->isSMTP(); 
    $mail2->SMTPDebug = 0; 
    $mail2->Host = "10.30.37.15"; 
    $mail2->Port = "25"; // typically 587 
    $mail2->SMTPSecure = 'tsl'; // ssl is depracated
    $mail2->SMTPAuth = false;
    $mail2->Username = "";
    $mail2->Password = "";
    $mail2->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail2->setFrom("rm-ph.it@total.com", "RM-IT PH");
    $mail2->addAddress($EMAIL);
    $mail2->addCC("");
    $mail2->Subject = "Loan Request - ".$IGG." - ".$ASSET."";
    $mail2->msgHTML("
        <span style=\"font-family:Calibri\">
            Hi ".$FNAME.",
            <br><br>
            Your asset loan request has been sent for approval:<br><br>
            <br>
            <table>
                <tr>
                    <td><u>Asset:</u>
                    <td>&emsp;".$ASSET."
                </tr>
                <tr>
                    <td><u>Quantity:</u>  
                    <td>&emsp;".$QTY."
                </tr>
                <tr>
                    <td>&emsp;
                    <td>&emsp;
                </tr>
                <tr>
                    <td><u>Date From:</u>
                    <td>&emsp;".$FROM."
                </tr>
                <tr>
                    <td><u>Date To:</u>  
                    <td>&emsp;".$TO."
                </tr>
                <tr>
                    <td>&emsp;
                    <td>&emsp;
                </tr>
                </table>
                <table>
                <tr>
                    <td colspan=2><u>Business Justification:</u>
                </tr>
                <tr>
                    <td colspan=2>".$BUJU."
                </tr>
            </table>
            <br><br>
            <br><br><br>
            TOTAL IT Services - Asset Management and Inventory (TISAMI)
        </span>
    "); // remove if you do not want to send HTML email
    $mail2->AltBody = 'HTML not supported';
    //$mail->addAttachment('docs/brochure.pdf'); //Attachment, can be skipped

    $mail2->send();
//)

echo "
        <br><br><br>
        <script type=\"text/javascript\">

            // Total seconds to wait
            var seconds = 10;
            
            function countdown() {
                seconds = seconds - 1;
                if (seconds < 0) {
                    // Chnage your redirection link here
                    window.setTimeout(\"window.close()\", 1000); 
                } else {
                    // Update remaining seconds
                    document.getElementById(\"countdown\").innerHTML = seconds;
                    // Count down using javascript
                    window.setTimeout(\"countdown()\", 1000);
                }
            }
            
            // Run countdown function
            countdown();
            
        </script>

        <body onload=countdown()>

        <center>
            <h4>
                Your loan request has been submitted for IT review and approval.
                <br><br>      
                Window will automatically close in <span id=\"countdown\">10</span> second/s
            </h4>
        </center>
            
        </body>
    
    ";

?>
</body>