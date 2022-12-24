<?php
/*##########Script Information#########
  # Purpose: Send mail Using PHPMailer#
  #          & Gmail SMTP Server 	  #
  # Created: 24-11-2019 			  #
  #	Author : Hafiz Haider			  #
  # Version: 1.0					  #
  # Website: www.BroExperts.com 	  #
  #####################################*/


//Include required PHPMailer files
	require 'include/PhpMailer/PHPMailer.php';
	require 'include/PhpMailer/SMTP.php';
	require 'include/PhpMailer/Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

function send($email,$msg){


//Create instance of PHPMailer
	$mail = new PHPMailer();
	
//Set mailer to use smtp
	$mail->isSMTP();
//Define smtp host
	$mail->Host = "ssl://smtp.gmail.com";
//Enable smtp authentication
	$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
	$mail->SMTPSecure = "ssl";
//Port to connect smtp
	$mail->Port = "465";
//Set gmail username
	$mail->Username = "aptiv999@gmail.com";
//Set gmail password
	$mail->Password = "fadwa123";
//Email subject
	$mail->Subject = "Aptiv";
//Set sender email
	$mail->setFrom('aptiv999@gmail.com');
//Enable HTML
	$mail->isHTML(true);
//Attachment
	//$mail->addAttachment('img/attachment.png');
//Email body
	$mail->Body = "<h3>Hello </h3><br>$msg";
//Add recipient
	$mail->addAddress($email);
//Finally send email
if ( $mail->send() ) {
	echo "Email Sent..!";
}else{
	echo "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
}
//Closing smtp connection
	$mail->smtpClose();

}

