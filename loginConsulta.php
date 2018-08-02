<?php
require 'conexion.php';
SESSION_START();

$usuarios = $mysqli->query("SELECT u.rol, a.nombre OR u.rol, c.nombre FROM usuario AS u INNER JOIN administrador
AS a INNER JOIN cliente AS c ON u.id_Usuario = a.id_Usuario OR u.id_Usuario = c.id_Usuario
WHERE u.usuario = '".$_POST['usuario']."'
AND u.clave = '".$_POST['clave']."' ");

if($usuarios->num_rows > 0):
    $datos = $usuarios->fetch_assoc();
    $_SESSION['usuario'] = $datos;
    echo json_encode(array('error' => false, 'tipo' => $datos['rol']));
else:
    echo json_encode(array('error' => true));
endif;

$mysqli->close();

?>

