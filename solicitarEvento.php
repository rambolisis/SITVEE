<?php
    require 'vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    $mail = new PHPMailer(true); 

    $nombreCliente = $_POST["nombreCliente"];
    $nombreEvento = $_POST["nombreEventoNuevo"];
    $fechaEvento = $_POST["fechaEventoNuevo"];
    $descripcionEvento = $_POST["descripcionEventoNuevo"];
    $correo = $_POST['correoCliente'];
    
    $header = 'From: ' . $correo . " \r\n";
    $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
    $header .= "Mime-Version: 1.0 \r\n";
    $header .= "Content-Type: text/plain";
    
    $mensaje = "Cliente: " . $nombreCliente . " \r\n";
    $mensaje .= "Nombre Evento: " . $nombreEvento . " \r\n";
    $mensaje .= "Fecha Evento: " . $fechaEvento . " \r\n";
    $mensaje .= "Descripcion Evento: " . $descripcionEvento . " \r\n";
    
    $sitvee = 'info@sitvee.com';
    $asunto = 'Solicitud de Evento';
    
    
    if (mail($sitvee, $asunto, utf8_decode($mensaje), $header)){
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mx1.hostinger.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'info@sitvee.com';                 // SMTP username
            $mail->Password = 'sitvee123Admin';                           // SMTP password
            $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;
        } catch (Exception $e) {
            echo 'Error a conectarse al servidor de correo', $mail->ErrorInfo;
            echo json_encode(array('mensaje' => true));
        }
        try{
            //Recipients
            $mail->setFrom('info@sitvee.com', 'SITVEE');
            $mail->addAddress($correo);   // Add a recipient
            $mail->isHTML(true);                                // Set email format to HTML
            $mail->Subject = 'Solicitud de nuevo evento';
            $mail->Body = 'Nos complace saber que desea adquirir el servicio de administración para un nuevo evento de su empresa <br><br> 

            Hemos recibido su solicitud para la creación de un nuevo evento llamado '.$nombreEvento.' para la fecha '.$fechaEvento.'<br><br>
            
            Muy pronto nos pondremos en contacto para afinar detalles y que pueda tener a disposición su nuevo evento en nuestra plataforma <br><br>

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