<?php
    require 'vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    $mail = new PHPMailer(true);
    
    $nombreCliente = $_POST["nombreClienteSolicitud"];
    $telefonoCliente = $_POST["telefonoClienteSolicitud"];
    $comentarios = $_POST["comentariosClienteSolicitud"];
    $correo = $_POST['correoClienteSolicitud'];
    
    $header = 'From: ' . $correo . " \r\n";
    $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
    $header .= "Mime-Version: 1.0 \r\n";
    $header .= "Content-Type: text/plain";
    
    $mensaje = "Cliente: " . $nombreCliente . " \r\n";
    $mensaje .= "Correo: " . $correo . " \r\n";
    $mensaje .= "Telefono: " . $telefonoCliente . " \r\n";
    $mensaje .= "Comentarios: " . $comentarios . " \r\n";
    
    $sitvee = 'invitacion@sitvee.com';
    $asunto = 'Solicitud de Cuenta';
    
    if (mail($sitvee, $asunto, utf8_decode($mensaje), $header)){
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mx1.hostinger.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'invitacion@sitvee.com';                 // SMTP username
            $mail->Password = 'sitvee123Admin';                           // SMTP password
            $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;
        } catch (Exception $e) {
            echo 'Error a conectarse al servidor de correo', $mail->ErrorInfo;
            echo json_encode(array('mensaje' => true));
        }
        try{
            //Recipients
            $mail->setFrom('invitacion@sitvee.com', 'SITVEE');
            $mail->addAddress($correo);   // Add a recipient
            $mail->isHTML(true);                                // Set email format to HTML
            $mail->Subject = 'Solicitud de cuenta SITVEE';
            $mail->Body = 'Estimado(a) '.$nombreCliente.'\n\n

            Agradecemos su interés por la plataforma para eventos especiales SITVEE\n\n
            
            Le indicamos que SITVEE ha recibido su solicitud para una nueva cuenta en nuestra aplicación, por lo cual muy pronto nos estaremos poniendo en\n
            contacto para brindarle mayor información.\n\n
            
            Gracias';
            $mail->send();
            $mail->clearAllRecipients();
        } catch (Exception $e) {
            echo 'Correo no enviado. Mailer Error: ', $mail->ErrorInfo;
            echo json_encode(array('mensaje' => true));
        }
        echo json_encode(array('mensaje' => false));
    }else{
        echo json_encode(array('mensaje' => true));
    }  
?>
