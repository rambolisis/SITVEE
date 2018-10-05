<?php
require '../conexion.php';

$json = array();

    if(isset($_GET["idBeneficio"])){
        $idBeneficio = $_GET["idBeneficio"];
        $actualizaBeneficios = $mysqli->query("UPDATE beneficio SET cantidad = cantidad - 1 WHERE id_Beneficio = '$idBeneficio' ");

        $infoBeneficio = $mysqli->query("SELECT nombre,id_Evento,id_Invitado FROM beneficio WHERE id_beneficio = '$idBeneficio' ");
        $datosinfoBeneficio = $infoBeneficio->fetch_assoc();
        $nombreBeneficio = $datosinfoBeneficio['nombre'];
        $idEvento = $datosinfoBeneficio['id_Evento'];
        $idInvitado = $datosinfoBeneficio['id_Invitado'];
        $canjeBeneficios = $mysqli->query("UPDATE beneficiocontrol SET cantidadCanjeada = cantidadCanjeada + 1 
        WHERE id_Evento = '$idEvento' AND nombreBeneficio = '$nombreBeneficio' ");
        $verificaAsistencia = $mysqli->query("SELECT asistencia FROM invitado WHERE id_Invitado = '$idInvitado' ");
        $datos = $verificaAsistencia->fetch_assoc();
            if($datos['asistencia'] == "NO"){
                $asisteInvitado = $mysqli->query("UPDATE invitado SET asistencia = 'SI'
                WHERE id_Invitado = '$idInvitado' ");
            }

        if($actualizaBeneficios && $canjeBeneficios){
            echo "actualiza";
        }else{
            echo "No actualiza";
        }
    }else{
        echo "No actualiza";
    }
?>