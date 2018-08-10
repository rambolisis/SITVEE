<?php
    require 'conexion.php';

	//obtenemos los valores del formulario
	$usuarioStaff = $_POST['usuarioStaff'];
    $claveStaff = $_POST['contraseniaStaff'];
    $id = $_POST['staffEvento'];


    $usuarios = $mysqli->query("INSERT INTO usuario(id_Usuario, usuario, clave, rol) VALUES ('','$usuarioStaff','$claveStaff','Staff')");
    $staff = $mysqli->query ("INSERT INTO staff(id_Staff, id_Usuario, id_Evento) VALUES ('','$mysqli->insert_id','$id')");

	if($usuarios===TRUE && $staff===TRUE){
        echo json_encode(array('mensaje' => false));
    }else{
        echo "<script>
                alert('A ocurrido un error al guardar el staff');
            </script>";
    }

    $mysqli->close();
    
?>