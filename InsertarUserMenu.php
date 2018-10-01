<?php
    require 'conexion.php';
    require 'phpqrcode/qrlib.php';
    require 'vendor/autoload.php';
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
    $zip = new ZipArchive();
    $filenameZip = 'QR-Invitados.zip';

    if($idEvento == "null"){
        var_dump(http_response_code(404));
    }
    $insertaInvitado = $mysqli->prepare("INSERT INTO invitado(nombreInvitado, correo, telefono, id_Evento)
    VALUES (?,?,?,?)");
    $insertaQR = $mysqli->prepare("UPDATE invitado SET codigoQR = ? WHERE id_Invitado = ?");
    $insertaBeneficio = $mysqli->prepare("INSERT INTO beneficio(nombre, cantidad, id_Evento, id_Invitado, codigo)
    VALUES (?,?,?,?,?)");
    $respuesta = false;
    $respuesta2 = false;
    $respuesta3 = false;
    if($zip->open($filenameZip, ZipArchive::CREATE)===true){

        foreach($ListaInvitados as $invitados){
            $nombre = $invitados->{"Nombre"};
            $ape1 = $invitados->{"Primer_Apellido"};
            $ape2 = $invitados->{"Segundo_Apellido"};
            $correo = $invitados->{"Correo"};
            $telefono = $invitados->{"Telefono"};
            $nombreCompleto = $nombre." ".$ape1." ".$ape2;
            $insertaInvitado->bind_param("ssii",$nombreCompleto,$correo,$telefono,$idEvento);
            $respuesta = $insertaInvitado->execute();//Ejecutar el insertarInvitado
            $idInvitado = $mysqli->insert_id;//Agarrar id invitado creado
            $filename = 'QRimage/'.$nombreCompleto.'-'.$idInvitado.'.png';//Crear el codigo QR
            $size = 10;
            $level = 'H';
            $frameSize = 1;
            $contenido = $idInvitado.",".$idEvento;
            QRcode::png($contenido, $filename, $level, $size, $frameSize);
            $zip->addFile($filename,$nombreCompleto.'-'.$idInvitado.'.png');
            try{
                //Recipients
                $mail->setFrom('invitacion@sitvee.com', 'SITVEE');
                $mail->addAddress($correo);   // Add a recipient
                //Attachments
                $mail->addAttachment($filename);         // Add attachments
                //Content
                $mail->isHTML(true);                                // Set email format to HTML
                $mail->Subject = 'Beneficios invitacion';
                $mail->Body    = 'El siguiente codigo QR adjunto se debe utilizar para canjear los beneficios que tenga disponibles<br><br>
                <center><img src="'.$filename.'"/></center>';
                /*$mail->send();*/
                echo 'Correo enviado exitosamente a: '.$nombreCompleto;
            } catch (Exception $e) {
                echo 'Correo no enviado. Mailer Error: ', $mail->ErrorInfo;
            }
            /*$imagenQR = file_get_contents($filename);
            $insertaQR->bind_param("bi",$imagenQR,$idInvitado);
            $respuesta3 = $insertaQR->execute();*/
            foreach($invitados->{"Beneficios"} as $beneficio){
                $nombreBeneficio = $beneficio->{"Nombre_Beneficio"};
                $cantidad = $beneficio->{"Cantidad"};
                $insertaBeneficio->bind_param("siiii",$nombreBeneficio,$cantidad,$idEvento,$idInvitado,$id);
                $respuesta2 = $insertaBeneficio->execute();
            } 
        }
        $zip->close();
        unlink('QRimage');
    }else{
        echo "ERROR";
    }
    
    
    $mysqli->close();
?>