<html>
<head>



</head>
<body style="font-family:Calibri; font-size:18; text-align:center;">
<br><br><br>

<?php

//START OF MAILER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';


$s = strval($_GET['s']);

$server = "localhost";
$username = "tis_admin";
$password = "t0T4l15itm";
$dbname = "dbtisami";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Could not connect: ' . $conn->connect_error);
}

$stmt=$conn->prepare("SELECT ID, IGG, FullName, EmailAdd, ContactNo, Unit, Qty, BuJu, DateFrom, DateTo, ApprovalCode FROM tblloan WHERE ApprovalCode = ?");
$stmt->bind_param("s",$s);
$stmt->execute();
$stmt->bind_result($ID,$IGG,$Name,$EmailAdd,$Contact,$Asset,$Qty,$BuJu,$From,$To,$AppCode);
$stmt->store_result();

$stmtd=$conn->prepare("SELECT ID, IGG, FullName, EmailAdd, Unit, Qty, DateFrom, DateTo, ApprovalCode FROM tblloan WHERE DeniedCode = ?");
$stmtd->bind_param("s",$s);
$stmtd->execute();
$stmtd->bind_result($ID,$IGG,$Name,$EmailAdd,$Asset,$Qty,$From,$To,$AppCode);
$stmtd->store_result();

if ($stmt->num_rows > 0) {
    
    // output data of each row
    while($row = $stmt->fetch()) {
        echo "Request has been <span style=\"color:green; font-weight: 700;\">APPROVED</span> successfully";
        echo "<BR><BR><br>";
        echo "<u>Requestor:</u><br>";
        echo $Name;
        echo "<BR><br>";
        echo "<u>Asset:</u><br>";
        echo $Asset;
        echo "<BR><br>";
        echo "<u>Request ID:</u><br>";
        echo $ID;
        echo "<BR><BR><br>";
        echo "Window will automatically close in <br> <div id=\"countdown\"></div>";
        echo '<script> 
        
            window.setTimeout("window.close()", 10000); 

            var timeleft = 9;
            var downloadTimer = setInterval(function(){
            document.getElementById("countdown").innerHTML = timeleft + " seconds";
            timeleft -= 1;
            if(timeleft <= 0){
                clearInterval(downloadTimer);
                document.getElementById("countdown").innerHTML = "0 seconds - please proceed in manually closing window"
            }
            }, 1000);
            
            </script>';

        $stmt=$conn->prepare("UPDATE tblloan SET ApprovalStatus = 'Approved' WHERE ApprovalCode = ?");
        $stmt->bind_param("s",$s);
        $stmt->execute();

        $stmt=$conn->prepare("UPDATE tblloan SET ApprovalCode = '', DeniedCode = '' WHERE ApprovalCode = ?");
        $stmt->bind_param("s",$s);
        $stmt->execute();

        //Mail User for Approval
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
            $mail->addAddress($EmailAdd);
            //$mail->addCC("Ryan.Delos-Reyes@total.com");
            $mail->Subject = "Loan Request - ".$IGG." - ".$Asset."";
            $mail->msgHTML("
                <span style=\"font-family:Calibri\">
                Hi $Name,
                <br><br>
                Your loan request for the details below has been <b>APPROVED</b>.
                <br><br>
                <table>
                    <tr>
                        <td><u>Asset:</u>
                        <td>&emsp;".$Asset."
                    </tr>
                    <tr>
                        <td><u>Quantity:  </u>
                        <td>&emsp;".$Qty."
                    </tr>
                    <tr>
                        <td>&emsp;
                        <td>&emsp;
                    </tr>
                    <tr>
                        <td><u>Date From:</u>
                        <td>&emsp;".$From."
                    </tr>
                    <tr>
                        <td><u>Date To:</u>
                        <td>&emsp;".$To."
                    </tr>
                    <tr>
                        <td>&emsp;
                        <td>&emsp;
                    </tr>
                </table>
                <br><br><br>
                TOTAL IT Services - Asset Management and Inventory (TISAMI)
            </span>
            "); // remove if you do not want to send HTML email
            $mail->AltBody = 'HTML not supported';
            //$mail->addAttachment('docs/brochure.pdf'); //Attachment, can be skipped

            $mail->send();

            // MAIL IT TEAM
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
            $mail->addAddress("Giovani.GARIN@total.com");
            $mail->addAddress("Lito.MARTINEZ@total.com");
            $mail->addAddress("Renato.GESULGA@total.com");
            $mail->addCC("Ryan.Delos-Reyes@total.com");
            $mail->Subject = "Loan Request - ".$IGG." - ".$Asset."";
            $mail->msgHTML("
                <span style=\"font-family:Calibri\">
                Hi IT Team
                <br><br>
                A loan request has been Approved. Please see below details;
                <br><br>
                <table>
                    <tr>
                        <td width=120px><u>IGG:</u> 
                        <td width=100px>&emsp;".$IGG."
                    </tr>
                    <tr>
                        <td><u>Full Name:</u>
                        <td>&emsp;".$Name."
                    </tr>
                    <tr>
                        <td><u>Email Address: </u>
                        <td>&emsp;".$EmailAdd."
                    </tr>
                    <tr>
                        <td><u>Contact No:</u>
                        <td>&emsp;".$Contact."
                    </tr>
                    <tr>
                        <td>&emsp;
                        <td>&emsp;
                    </tr>
                    <tr>
                        <td><u>Asset:</u>
                        <td>&emsp;".$Asset."
                    </tr>
                    <tr>
                        <td><u>Quantity:  </u>
                        <td>&emsp;".$Qty."
                    </tr>
                    <tr>
                        <td>&emsp;
                        <td>&emsp;
                    </tr>
                    <tr>
                        <td><u>Date From:</u>
                        <td>&emsp;".$From."
                    </tr>
                    <tr>
                        <td><u>Date To:</u>
                        <td>&emsp;".$To."
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
                        <td colspan=2>".$BuJu."
                    </tr>
                </table>
                <br><br><br>
                TOTAL IT Services - Asset Management and Inventory (TISAMI)
            </span>
            "); // remove if you do not want to send HTML email
            $mail->AltBody = 'HTML not supported';
            //$mail->addAttachment('docs/brochure.pdf'); //Attachment, can be skipped

            $mail->send();
    }

} else if ($stmtd->num_rows > 0) {

    // output data of each row
    while($row = $stmtd->fetch()) {
        echo "Request has been <span style=\"color:red; font-weight: 700;\">DENIED</span> successfully";
        echo "<BR><BR><br>";
        echo "<u>Requestor:</u><br>";
        echo $Name;
        echo "<BR><br>";
        echo "<u>Asset:</u><br>";
        echo $Asset;
        echo "<BR><br>";
        echo "<u>Request ID:</u><br>";
        echo $ID;
        echo "<BR><BR><br>";
        echo "Window will automatically close in <br> <div id=\"countdown\"></div>";
        echo '<script> 
        
            window.setTimeout("window.close()", 10000); 

            var timeleft = 9;
            var downloadTimer = setInterval(function(){
            document.getElementById("countdown").innerHTML = timeleft + " seconds";
            timeleft -= 1;
            if(timeleft <= 0){
                clearInterval(downloadTimer);
                document.getElementById("countdown").innerHTML = "0 seconds - please proceed in manually closing window"
            }
            }, 1000);
            
            </script>';

        $stmtd=$conn->prepare("UPDATE tblloan SET ApprovalStatus = 'Denied' WHERE DeniedCode = ?");
        $stmtd->bind_param("s",$s);
        $stmtd->execute();

        $stmtd=$conn->prepare("UPDATE tblloan SET ApprovalCode = '', DeniedCode = '' WHERE DeniedCode = ?");
        $stmtd->bind_param("s",$s);
        $stmtd->execute();

        //Mail User for DENIED
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
            $mail->addAddress($EmailAdd);
            //$mail->addCC("Ryan.Delos-Reyes@total.com");
            $mail->Subject = "Loan Request - ".$IGG." - ".$Asset."";
            $mail->msgHTML("
                <span style=\"font-family:Calibri\">
                Hi $Name,
                <br><br>
                Your loan request for the details below has been <b>DENIED</b>. Please contact the IT Team for futher details.
                <br><br>
                <table>
                    <tr>
                        <td><u>Asset:</u>
                        <td>&emsp;".$Asset."
                    </tr>
                    <tr>
                        <td><u>Quantity:  </u>
                        <td>&emsp;".$Qty."
                    </tr>
                    <tr>
                        <td>&emsp;
                        <td>&emsp;
                    </tr>
                    <tr>
                        <td><u>Date From:</u>
                        <td>&emsp;".$From."
                    </tr>
                    <tr>
                        <td><u>Date To:</u>
                        <td>&emsp;".$To."
                    </tr>
                    <tr>
                        <td>&emsp;
                        <td>&emsp;
                    </tr>
                </table>
                <br><br><br>
                TOTAL IT Services - Asset Management and Inventory (TISAMI)
            </span>
            "); // remove if you do not want to send HTML email
            $mail->AltBody = 'HTML not supported';
            //$mail->addAttachment('docs/brochure.pdf'); //Attachment, can be skipped

            $mail->send();
        
    }

}   else {

    echo "Request has Expired or not Found";
 
}

$stmt->close();

$conn->close();

?>
</body>
<html>