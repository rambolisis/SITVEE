<?php
    require '../conexion.php';
    require '../phpqrcode/qrlib.php';
    require '../vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
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
    }                                 // TCP port to connect to
    
    $ListaInvitados = json_decode($_POST["data"]);
    $idEvento = $_GET["idEvento"];
    //$zip = new ZipArchive();

    if($idEvento == "null"){
        var_dump(http_response_code(404));
    }
    $updateEstado = $mysqli->query("UPDATE evento SET estado='Invitacion Enviada' WHERE id_Evento='$idEvento'");
    $informacionEvento = $mysqli->query("SELECT * FROM evento WHERE id_Evento='$idEvento'");
    $datos = $informacionEvento->fetch_assoc();
    $nombreEvento = $datos['nombreEvento'];
    $fechaEvento = $datos['fecha'];
    $descripcionEvento = $datos['descripcion'];
    $lugarEvento = $datos['lugar'];
    $idCliente = $datos['id_Cliente'];
    $empresa = $mysqli->query("SELECT nombreCliente FROM cliente WHERE id_Cliente='$idCliente'");
    $datos2 = $empresa->fetch_assoc();
    $nombreEmpresa = $datos2['nombreCliente'];
    //$filenameZip = 'QR-Invitados-'.$datos["nombreEvento"].'.zip';
    $insertaInvitado = $mysqli->prepare("INSERT INTO invitado(nombreInvitado, correo, telefono, id_Evento, asistencia)
    VALUES (?,?,?,?,?)");
    $insertaBeneficio = $mysqli->prepare("INSERT INTO beneficio(nombre, cantidad, id_Evento, id_Invitado)
    VALUES (?,?,?,?)");
    $respuesta = false;
    $respuesta2 = false;
    $respuesta3 = false;
    /*if($zip->open($filenameZip, ZipArchive::CREATE)===true){*/

        foreach($ListaInvitados as $invitados){
            $nombre = $invitados->{"Nombre"};
            $ape1 = $invitados->{"Primer_Apellido"};
            $ape2 = $invitados->{"Segundo_Apellido"};
            $correo = $invitados->{"Correo"};
            $telefono = $invitados->{"Telefono"};
            $asistencia = "NO";
            $nombreCompleto = $nombre." ".$ape1." ".$ape2;
            $insertaInvitado->bind_param("ssiis",$nombreCompleto,$correo,$telefono,$idEvento,$asistencia);
            $respuesta = $insertaInvitado->execute();//Ejecutar el insertarInvitado
            $idInvitado = $mysqli->insert_id;//Agarrar id invitado creado
            $filename = '../QRimage/'.$nombreCompleto.'-'.$idInvitado.'.png';//Crear el codigo QR
            $size = 10;
            $level = 'H';
            $frameSize = 1;
            $contenido = $idInvitado.",".$idEvento;
            QRcode::png($contenido, $filename, $level, $size, $frameSize);
            //$zip->addFile($filename,$nombreCompleto.'-'.$idInvitado.'.png');
            $beneficios = "";
            foreach($invitados->{"Beneficios"} as $beneficio){
                $nombreBeneficio = $beneficio->{"Nombre_Beneficio"};
                $cantidad = $beneficio->{"Cantidad"};
                $insertaBeneficio->bind_param("siii",$nombreBeneficio,$cantidad,$idEvento,$idInvitado);
                $respuesta2 = $insertaBeneficio->execute();
                $beneficios .= "- ".$nombreBeneficio." | Cantidad total: ".$cantidad."<br>";
            }
            try{
                //Recipients
                $mail->setFrom('invitacion@sitvee.com', 'SITVEE');
                $mail->addAddress($correo);   // Add a recipient
                //Attachments
                $mail->addAttachment($filename);         // Add attachments
                //Content
                $mail->isHTML(true);                                // Set email format to HTML
                $mail->Subject = 'Te invitamos a '.$nombreEvento.'';
                $mail->Body    = 'Estimado(a) '.$nombreCompleto.'<br><br>

                Nos complace informarle que la empresa '.$nombreEmpresa.' le ha invitado al evento "'.$nombreEvento.'" que se realizará el día '.$fechaEvento.' en '.$lugarEvento.' <br><br>
                
                Este evento es para: '.$descripcionEvento.' <br><br>
                
                Además hacemos de su conocimiento que en dicho evento usted tendrá incluido el consumo del los siguientes beneficios: <br>
                '.$beneficios.'<br>
                
                Le informamos que para hacer el canje de estos beneficios durante el evento necesitará presentar la imagen que contiene su código QR personal,
                el cual encontrará adjunto a este correo, por lo que es muy importante que porte esta imagen en todo momento durante el evento. <br><br>
                
                Que disfrute mucho este evento, SITVEE será parte de este para mejorar su experiecia.';
                $mail->send();
                $mail->clearAttachments();
                $mail->clearAllRecipients();
                echo 'Correo enviado exitosamente a: '.$nombreCompleto;
            } catch (Exception $e) {
                echo 'Correo no enviado. Mailer Error: ', $mail->ErrorInfo;
            }
        }
        $beneficioControl = $mysqli->query("INSERT INTO beneficiocontrol (nombreBeneficio, cantidadCanjeada, id_Evento) 
        SELECT DISTINCT beneficio.nombre,0,$idEvento FROM 
        beneficio INNER JOIN evento ON beneficio.id_Evento = evento.id_Evento WHERE evento.id_Evento = $idEvento");
        //$zip->close();
        //unlink('../QRimage');
        /*
    }else{
        echo "ERROR";
    }*/
    
    
    $mysqli->close();
?>