<?php

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    require '../conexion.php';
    SESSION_START();

    $mysqli->set_charset('utf8');

    $usuario = $mysqli->real_escape_string($_POST['usuario']);
    $clave = $mysqli->real_escape_string($_POST['clave']);
    $administrador = $mysqli->prepare("SELECT u.rol, a.nombreAdministrador 
    FROM usuario AS u INNER JOIN administrador
    AS a ON u.id_Usuario = a.id_Usuario 
    WHERE u.usuario = ? 
    AND u.clave = ? ");
    $cliente = $mysqli->prepare("SELECT u.rol, c.nombreCliente, c.correo, c.id_Cliente, u.id_Usuario 
    FROM usuario AS u INNER JOIN cliente
    AS c ON u.id_Usuario = c.id_Usuario
    WHERE u.usuario = ?
    AND u.clave = ? ");
    $administrador->bind_param('ss',$usuario,$clave);
    $administrador->execute();
    $resultadoA = $administrador->get_result();
    $cliente->bind_param('ss',$usuario,$clave);
    $cliente->execute();
    $resultadoC = $cliente->get_result();

    if($resultadoA->num_rows == 1){
        $datos = $resultadoA->fetch_assoc();
        $_SESSION['usuario'] = $datos;
        echo json_encode(array('error' => false, 'tipo' => $datos['rol']));
    }else if($resultadoC->num_rows == 1){
        $datos = $resultadoC->fetch_assoc();
        $_SESSION['usuario'] = $datos;
        echo json_encode(array('error' => false, 'tipo' => $datos['rol']));
    }else{
        echo json_encode(array('error' => true));
    }
    $administrador->close();
    $cliente->close();
}

$mysqli->close();

?>

