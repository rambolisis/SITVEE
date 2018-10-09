<?php
    $destino = "invitacion@sitvee.com";
    $nombreCliente = $_POST["nombreClienteSolicitud"];
    $telefonoCliente = $_POST["telefonoClienteSolicitud"];
    $comentarios = $_POST["comentariosClienteSolicitud"];
    $mail = $_POST['correoClienteSolicitud'];
    
    $header = 'From: ' . $mail . " \r\n";
    $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
    $header .= "Mime-Version: 1.0 \r\n";
    $header .= "Content-Type: text/plain";
    
    $mensaje = "Cliente: " . $nombreCliente . " \r\n";
    $mensaje .= "Correo: " . $mail . " \r\n";
    $mensaje .= "Telefono: " . $telefonoCliente . " \r\n";
    $mensaje .= "Comentarios: " . $comentarios . " \r\n";
    
    $para = 'invitacion@sitvee.com';
    $asunto = 'Solicitud de Cuenta';
    
    if (mail($para, $asunto, utf8_decode($mensaje), $header)){
        echo json_encode(array('error' => false));
    }
    echo json_encode(array('error' => true));
?>
