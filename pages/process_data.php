<?php

//process_data.php

if(isset($_POST["first_name"]))
{
 $first_name = '';
 $last_name = '';
 $email = '';
 $tel = '';
 $msg = '';

 $first_name_error = '';
 $last_name_error = '';
 $email_error = '';
 $tel_error = '';
 $msg_error = '';
 $captcha_error = '';

 if(empty($_POST["first_name"]))
 {
  $first_name_error = 'Votre prénom est obligatoire';
 }
 else
 {
  $first_name = $_POST["first_name"];
 }

 if(empty($_POST["last_name"]))
 {
  $last_name_error = 'Votre nom de famille est obligatoire';
 }
 else
 {
  $last_name = $_POST["last_name"];
 }
 if(empty($_POST["email"]))
 {
  $email_error = 'Votre adresse email est obligatoire';
 }
 else
 {
  if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
  {
   $email_error = 'Adresse email invalide';
  }
  else
  {
   $email = $_POST["email"];
  }
 }

 if(empty($_POST["tel"]))
 {
  $tel_error = 'Le téléphone est obligatoire';
 }
 else
 {
  $tel = $_POST["tel"];
 }

 if(empty($_POST["message"]))
 {
  $msg_error = 'Le message est obligatoire';
 }
 else
 {
  $msg = $_POST["message"];
 }

if(empty($_POST['g-recaptcha-response']))
{
$captcha_error = 'Captcha est obligatoire.';
}
else
{
$secret_key = '6Ldv2bcUAAAAAFXUKdLW_qljFd9FpxNguf06DHhp';

if($first_name_error == '' && $phonenum_error == '' && $email_error == '' && $msg_error == '' && $tel_error == '' && $captcha_error == '')
{
$response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
$response_data = json_decode($response);
if(!$response_data->success)
{
$captcha_error = 'Échec de la vérification du captcha. Rafraîchir la page pour recharger si nécessaire.';
}
}
}

 if($first_name_error == '' && $last_name_error == '' && $email_error == '' && $tel_error == '' && $msg_error == '' && $captcha_error == '')
 {
  
  $subject = 'Demande de contact de '.$first_name.' '.$last_name;
  require 'class/class.phpmailer.php';
		$mail = new PHPMailer;
		$mail->IsSMTP();								//Sets Mailer to send message using SMTP
		$mail->Host = 'smtpout.secureserver.net';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
		$mail->Port = '80';								//Sets the default SMTP server port
		$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
		$mail->Username = 'xxxxxxxxxx';					//Sets SMTP username
		$mail->Password = 'xxxxxxxxxx';					//Sets SMTP password
		$mail->SMTPSecure = '';							//Sets connection prefix. Options are "", "ssl" or "tls"
		$mail->From = $email;					//Sets the From email address for the message
		$mail->FromName = $first_name.' '.$last_name;				//Sets the From name of the message
		$mail->AddAddress('abc@xyz.com', 'Name');		//Adds a "To" address
		$mail->IsHTML(false);							//Sets message type to HTML				
		$mail->Subject = $subject;				//Sets the Subject of the message
		$mail->Body = $msg;				//An HTML or plain text message body
		if($mail->Send())								//Send an Email. Return true on success or false on error
		{
			$error = '<label class="text-success">Votre demande de contact sera traitée dans les 24h</label>';
		}
		else
		{
			$error = '<label class="text-danger">Désolé une erreur est survenue</label>';
		}
		$name = '';
		$email = '';
		$subject = '';
		$message = '';

        $data = array(
            'success'  => true           );
 }
 else
 {
  $data = array(
   'first_name_error' => $first_name_error,
   'last_name_error' => $last_name_error,
   'email_error'  => $email_error,
   'tel_error' => $tel_error,
   'msg_error' => $msg_error,
   'captcha_error'  => $captcha_error
  );
 }

 echo json_encode($data);
}

?>