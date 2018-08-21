<?php
    require 'conexion.php';
    require 'phpqrcode/qrlib.php';
    
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
    $insertaBeneficio = $mysqli->prepare("INSERT INTO beneficio(nombre, cantidad, id_Evento, id_Invitado)
    VALUES (?,?,?,?)");
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
            $filename = 'QRimage/'.$nombreCompleto.'.png';//Crear el codigo QR
            $size = 10;
            $level = 'H';
            $frameSize = 1;
            $contenido = $idInvitado.",".$idEvento;
            QRcode::png($contenido, $filename, $level, $size, $frameSize);
            $zip->addFile($filename,$nombreCompleto.'.png');
            /*$imagenQR = file_get_contents($filename);
            $insertaQR->bind_param("bi",$imagenQR,$idInvitado);
            $respuesta3 = $insertaQR->execute();*/
            /*unlink('QRimage/qr.png');*/
            foreach($invitados->{"Beneficios"} as $beneficio){
                $nombreBeneficio = $beneficio->{"Nombre_Beneficio"};
                $cantidad = $beneficio->{"Cantidad"};
                $insertaBeneficio->bind_param("siii",$nombreBeneficio,$cantidad,$idEvento,$idInvitado);
                $respuesta2 = $insertaBeneficio->execute();
            } 
        }
        $zip->close();
        header("Content-type: application/octet-stream");
        header("Content-disposition: attachment; filename=QR-Invitados.zip");
        readfile('QR-Invitados.zip');
        unlink('QR-Invitados.zip');
        echo "Invitados guardados: ".$respuesta;
        echo "Beneficios guardados: ".$respuesta2;
        echo "QR insertado: ".$respuesta3;
    }else{
        echo "ERROR";
    }
    
    
    $mysqli->close();
?>