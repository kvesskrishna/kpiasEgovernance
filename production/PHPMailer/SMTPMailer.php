<?php

function SMTPMailer($to,$subject,$body)

{

    $host="mail.kpias.com";

    $username="egov@kpias.com";

    $password="egov@KPIAS999";

    $from="egov@kpias.com";

    $from_name="KPIAS E-Governance";

require_once('PHPMailerAutoload.php');

$mail = new PHPMailer(); // create a new object

$mail->IsSMTP(); // enable SMTP

$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only

$mail->SMTPAuth = true; // authentication enabled

$mail->SMTPOptions = array(

    'ssl' => array(

        'verify_peer' => false,

        'verify_peer_name' => false,

        'allow_self_signed' => true

    )

);

//$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail

$mail->Host = $host;

$mail->Port = 587; // or 587

$mail->IsHTML(true);

$mail->Username = $username;

$mail->Password = $password;

$mail->SetFrom($from);

$mail->FromName = $from_name;

$mail->Subject = $subject;

$mail->Body = $body;

$mail->AddAddress($to);

//$mail->AddCC("@gmail.com");

 if(!$mail->Send()) {

    $mailstatus= "Mailer Error: " . $mail->ErrorInfo;

    //$mailstatus=0;

 } else {

    //$mailstatus= "Message has been sent";

    $mailstatus=1;

 }

 return $mailstatus;

}

 ?>