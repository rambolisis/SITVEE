<?php
require '../conexion.php';

$claveActual = $_POST['claveActualUsuarioCliente'];
$claveNueva = $_POST['claveNuevaUsuarioCliente'];
$repiteClaveNueva = $_POST['repetirClaveUsuarioCliente'];


if(!isset($_GET['idUsuarioCliente']) != 'null'){
    $idUsuario = $_GET['idUsuarioCliente'];
    $consultaClaveActual = $mysqli->query("SELECT clave FROM usuario WHERE id_Usuario = '$idUsuario' ");
    $datos = $consultaClaveActual->fetch_assoc();
    $claveConsultada = $datos['clave'];
    if($claveActual == $claveConsultada){
        if($claveNueva == $repiteClaveNueva){
            $cambiarClaveUsuario = $mysqli->query("UPDATE usuario SET clave = '$claveNueva' WHERE id_Usuario = '$idUsuario'");
            echo json_encode(array('mensaje' => 1));
        }else{
            echo json_encode(array('mensaje' => 3));
        }
    }else{
        echo json_encode(array('mensaje' => 2));
    } 
}else{
    echo json_encode(array('mensaje' => 4));
}
?>