<?php
require 'dist/PHPMailer/PHPMailerAutoload.php';

function sendmail($to,$subject,$message,$first_name)
{
	$mail = new PHPMailer();	
	$mail->isSMTP();
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$mail->Host = 'ssl://smtp.gmail.com';
		// use
			$mail->Port = 465;
		//Set the encryption system to use - ssl (deprecated) or tls
		//$mail->SMTPSecure = 'ssl';
		$mail->SMTPAutoTLS = false;;
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "crackviewsinfo@gmail.com";
		//Password to use for SMTP authentication
		$mail->FromName="Crack Views";
		$mail->Password = "akashdhavankenilvatsal"; //lol i changed it
		//Set who the message is to be sent to
		$mail->addAddress($to,$first_name);
		//Set the subject line
		$mail->Subject = $subject;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$mail->Body=$message;
		//Replace the plain text body with one created manually
		$mail->AltBody = 'This is a plain-text message body';
		if($mail->send()) {
		return 1;
		}		
		else{
			return -1;
		}
}
?>