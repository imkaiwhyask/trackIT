<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
 
$mail = new PHPMailer;
$mail->isSMTP(); 
$mail->SMTPDebug = 5; 
$mail->Host = "10.30.37.15"; 
$mail->Port = "25"; // typically 587 
$mail->SMTPSecure = 'tsl'; // ssl is depracated
$mail->SMTPAuth = false;
$mail->Username = "";
$mail->Password = "";
$mail->setFrom("rm-ph.it@mail.totalenergies.com", "RM-IT PH");
$mail->addAddress("clara.lugtu@external.totalenergies.com", "Clara LUGTU");
$mail->Subject = 'Any_subject_of_your_choice';
$mail->msgHTML("test body"); // remove if you do not want to send HTML email
$mail->AltBody = 'HTML not supported';
//$mail->addAttachment('docs/brochure.pdf'); //Attachment, can be skipped
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->send();

?>