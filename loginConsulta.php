<?php
require 'conexion.php';
SESSION_START();

$administrador = $mysqli->query("SELECT u.rol, a.nombreAdministrador FROM usuario AS u INNER JOIN administrador
AS a ON u.id_Usuario = a.id_Usuario WHERE 
u.usuario = '".$_POST['usuario']."' 
AND u.clave = '".$_POST['clave']."' ");

$usuarios = $mysqli->query("SELECT u.rol, c.nombreCliente, c.id_Cliente FROM usuario AS u INNER JOIN cliente
AS c ON u.id_Usuario = c.id_Usuario
WHERE u.usuario = '".$_POST['usuario']."'
AND u.clave = '".$_POST['clave']."' ");

if($usuarios->num_rows > 0){
    $datos = $usuarios->fetch_assoc();
    $_SESSION['usuario'] = $datos;
    echo json_encode(array('error' => false, 'tipo' => $datos['rol']));
}else if($administrador->num_rows > 0){
    $datos = $administrador->fetch_assoc();
    $_SESSION['usuario'] = $datos;
    echo json_encode(array('error' => false, 'tipo' => $datos['rol']));
}else{
    echo json_encode(array('error' => true));
}

$mysqli->close();

?>

