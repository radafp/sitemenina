<?php
// check if fields passed are empty
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "Nenhum dado informado!";
	return false;
   }
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];
	
// create email body and send it	
//$to = 'contato@maplebaregrill.com'; // hi mate thanks for purchase guna theme, just replace your email with emailme@myprogrammingblog.com
$to = 'confirmaset@gmail.com';
$email_subject = "Contato através do site - Maple Bar & Grill";
$email_body = "Mensagem enviada através do site Maple Bar & Grill em ". date('d/m/Y') . ' as ' . date('H:i') ." \n\n".
				  "\n \nNome: $name \n ".
				  "E-mail: $email_address\n Mensagem: \n $message";
$headers = "From: contato@maplebaregrill.com\n";
$headers .= "Reply-To: $email_address";	

mail($to,$email_subject,$email_body,$headers);
return true;			
?>