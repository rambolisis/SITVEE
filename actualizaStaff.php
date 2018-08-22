<?php
    require 'conexion.php';

	//obtenemos los valores del formulario
	$usuarioStaff = $_POST['usuarioStaff'];
    $claveStaff = $_POST['contraseniaStaff'];
    $lista = $_POST['staffId'];
    

	if($lista != 'null'){
        $array = explode(',', $lista);
        $id = $array[1];
        $usuario = $mysqli->query("UPDATE usuario SET usuario = '$usuarioStaff', clave = '$claveStaff' WHERE id_Usuario = '$id' ");
        echo json_encode(array('mensaje' => false));
    }else{
        echo json_encode(array('mensaje' => true));
    }

    $mysqli->close();
    
?>