<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/Exception.php';
require __DIR__ . '/PHPMailer/PHPMailer.php';
require __DIR__ . '/PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$message = $_POST['message'];

	$mail = new PHPMailer(true);

	try {
		$mail->isSMTP();
		$mail->Host       = 'your-dmainname.com';
		$mail->SMTPAuth   = true;
		$mail->Username   = 'noreply@your-dmainname.com';
		$mail->Password   = 'xxxxxx';
		$mail->SMTPSecure = 'ssl';
		$mail->Port       = 465;

		$mail->SMTPDebug = 0; // change to 2 for debug

		$mail->setFrom('noreply@your-dmainname.com', 'ALPS Tree Service');
		$mail->addAddress('alpstreeservice@gmail.com');
		$mail->addReplyTo($email, $name);

		$mail->isHTML(true);
		$mail->Subject = 'New Contact Form Message';

		$mail->Body = "
        Name: $name <br>
        Email: $email <br>
        Phone: $phone <br>
        Message: $message
        ";

		$mail->send();

		// AUTO REPLY
		$mail2 = new PHPMailer(true);

		$mail2->isSMTP();
		$mail2->Host       = 'mail.your-dmainname.com';
		$mail2->SMTPAuth   = true;
		$mail2->Username   = 'noreply@your-dmainname.com';
		$mail2->Password   = 'xxxxxx';
		$mail2->SMTPSecure = 'ssl';
		$mail2->Port       = 465;

		$mail2->setFrom('noreply@your-dmainname.com', 'ALPS Tree Service');
		$mail2->addAddress($email);

		$mail2->isHTML(true);
		$mail2->Subject = 'We received your enquiry';
		$mail2->Body = "Hi $name,<br>Thanks! We will contact you soon.";

		$mail2->send();

		echo "Success";
	} catch (Exception $e) {
		echo "Error: " . $mail->ErrorInfo;
	}
}
