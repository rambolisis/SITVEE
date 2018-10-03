<?php
    require '../conexion.php';

	//obtenemos los valores del formulario
	$nombreCliente = $_POST['nombreCliente'];
    $emailCliente = $_POST['correoCliente'];
    $usuarioCliente = $_POST['usuarioCliente'];
    $pass = $_POST['contraseniaCliente'];

    $verifica = $mysqli->query("SELECT usuario from usuario where usuario='$usuarioCliente'");

if($verifica->num_rows > 0){
    echo json_encode(array('mensaje' => true));
}else{
    $usuarios = $mysqli->query("INSERT INTO usuario(id_Usuario, usuario, clave, rol) VALUES ('','$usuarioCliente','$pass','Usuario')");
    $cliente = $mysqli->query ("INSERT INTO cliente(id_Cliente, nombreCliente, correo, id_Usuario) VALUES ('','$nombreCliente','$emailCliente','$mysqli->insert_id')");
	if($usuarios===TRUE && $cliente===TRUE){
        echo json_encode(array('mensaje' => false));
    }else{
        echo "<script>
                alert('A ocurrido un error al guardar el usuario');
            </script>";
    }
}

    $mysqli->close();
    
?>