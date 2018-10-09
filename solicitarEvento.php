<?php
    $destino = "invitacion@sitvee.com";
    $nombreCliente = $_POST["nombreCliente"];
    $nombreEvento = $_POST["nombreEventoNuevo"];
    $fechaEvento = $_POST["fechaEventoNuevo"];
    $descripcionEvento = $_POST["descripcionEventoNuevo"];
    $mail = $_POST['correoCliente'];
    
    $header = 'From: ' . $mail . " \r\n";
    $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
    $header .= "Mime-Version: 1.0 \r\n";
    $header .= "Content-Type: text/plain";
    
    $mensaje = "Cliente: " . $nombreCliente . " \r\n";
    $mensaje .= "Nombre Evento: " . $nombreEvento . " \r\n";
    $mensaje .= "Fecha Evento: " . $fechaEvento . " \r\n";
    $mensaje .= "Descripcion Evento: " . $descripcionEvento . " \r\n";
    
    $para = 'invitacion@sitvee.com';
    $asunto = 'Solicitud de Evento';
    
    if (mail($para, $asunto, utf8_decode($mensaje), $header)){
        echo json_encode(array('error' => false));
    }
    echo json_encode(array('error' => true));
?>