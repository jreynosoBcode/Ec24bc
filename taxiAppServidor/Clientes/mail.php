<?php
	require 'mail/PHPMailerAutoload.php'; 
	//$nombre = $_POST["nombre"];
	$correo = $_POST["correo"];
	//$telefono = $_POST["telefono"];
	//$comentario = $_POST["comentario"];
	

    $str=base64_encode($correo);

  	$body = "<div>
    			<div>
    				<center><h3>Soporte BCode</h3></center>
    			</div>
	    		<p style='font-size=20px'>Accede al siguiente enlace para reiniciar tu password:</p>
	    		<a href='http://bcodemexico.com/taxiApp/resetpassword.php?c=".$str."' target='_blank'>Enlace</a>
	    		<h3>Atencion!</h3>
	    		<p>Si no has solicitado un cambio de password has caso omiso de este correo</p>
	    		<p>Atte: Soporte BCode</p>
    		</div>";

	$mail = new PHPMailer();
    
/*
    $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                     // Enable SMTP authentication
	$mail->Username = 'mailbcode@gmail.com';          // SMTP username (correo gmail)
	$mail->Password = 'Inicio.14'; // SMTP Passwor (contrase単a de correo gmail)
	$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                          // TCP port to connect to
*/
    $mail->setFrom('mailbcode@gmail.com', 'Soporte Bcode');
    $mail->addAddress($correo);
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject  = 'Reinicio de password';
    $mail->Body     = $body;
    if(!$mail->send()) {
      echo 'Message was not sent.';
      echo 'Mailer error: ' . $mail->ErrorInfo;
    } else {
      echo '1';
    }
    /*
	$mail->setFrom($correo, 'Algo');
	$mail->addAddress('nazareth93.c@gmail.com');
	$mail->isHTML(true);  // Set email format to HTML
	$mail->Subject = 'Contacto BCode';
	$mail->Body    = $body;
	if(!$mail->send()) {
	    echo 'Error: ' . $mail->ErrorInfo;
	} else {
	    echo '1';
	}
	*/
?>