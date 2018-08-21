<?php
    require 'conexion.php';

	//obtenemos los valores del formulario
	$nombreAdministrador = $_POST['nombreAdmi'];
    $emailAdministrador = $_POST['correoAdmi'];
    $usuarioAdministrador = $_POST['usuarioAdmi'];
    $pass = $_POST['contrasenia'];

    $usuarios = $mysqli->query("INSERT INTO usuario(id_Usuario, usuario, clave, rol) VALUES ('','$usuarioAdministrador','$pass','Administrador')");
    $cliente = $mysqli->query ("INSERT INTO administrador(id_Administrador, nombreAdministrador, correo, id_Usuario) VALUES ('','$nombreAdministrador','$emailAdministrador','$mysqli->insert_id')");

	if($usuarios===TRUE && $cliente===TRUE){
        echo json_encode(array('mensaje' => false));
    }else{
        echo "<script>
                alert('A ocurrido un error al guardar el administrador');
            </script>";
    }

    $mysqli->close();
    
?>