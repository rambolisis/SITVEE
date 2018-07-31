<?php
require 'conexion.php';

$usuarios = $mysqli->query("SELECT nombre, tipo_usuario
FROM usuarios
WHERE usuario = '".$_POST['usuario']."'
AND clave = '".$_POST['clave']."'");

if($usuarios->num_rows > 0):
    $datos = $usuarios->fetch_assoc();
    echo json_encode(array('error' => false, 'tipo' => $datos['tipo_usuario']));
else:
    echo json_encode(array('error' => true));
endif;

$mysqli->close();

?>