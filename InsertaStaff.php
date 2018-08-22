<?php
    require 'conexion.php';

	//obtenemos los valores del formulario
	$usuarioStaff = $_POST['usuarioStaff'];
    $claveStaff = $_POST['contraseniaStaff'];
    $id = $_POST['staffEvento'];

    $eventos = $mysqli->query("SELECT id_Evento FROM staff WHERE id_Evento = '$id' ");
    

	if($eventos->num_rows > 0){
        echo json_encode(array('mensaje' => true));
    }else{
        $usuarios = $mysqli->query("INSERT INTO usuario(id_Usuario, usuario, clave, rol) VALUES ('','$usuarioStaff','$claveStaff','Staff')");
        $staff = $mysqli->query ("INSERT INTO staff(id_Staff, id_Usuario, id_Evento) VALUES ('','$mysqli->insert_id','$id')");
        echo json_encode(array('mensaje' => false));
        
    }

    $mysqli->close();
    
?>