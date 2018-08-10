<?php
    require 'conexion.php';

	//obtenemos los valores del formulario
	$usuarioStaff = $_POST['usuarioStaff'];
    $claveStaff = $_POST['contraseniaStaff'];
    $array = explode(',', $_POST['staffId']);
    $id = $array[1];

    $usuario = $mysqli->query("UPDATE usuario SET usuario = '$usuarioStaff', clave = '$claveStaff' WHERE id_Usuario = '$id' ");

	if($usuario===TRUE){
        echo json_encode(array('mensaje' => false));
    }else{
        echo "<script>
                alert('A ocurrido un error al actualizar el evento');
            </script>";
    }

    $mysqli->close();
    
?>