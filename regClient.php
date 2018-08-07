<?php
    $mysqli = new mysqli('localhost','id6607651_sitvee','12345','id6607651_sitvee');

    if($mysqli->connect_error){
        die($mysqli->connection_error);
    }
	//obtenemos los valores del formulario
	$nombreCliente = $_POST['nombreCliente'];
    $emailCliente = $_POST['correoCliente'];
    $usuarioCliente = $_POST['usuarioCliente'];
    $pass = $_POST['contraseniaCliente'];
    

    $usuarios = $mysqli->query("INSERT INTO usuario(id_Usuario, usuario, clave, rol) VALUES ('','$usuarioCliente','$pass','Usuario')");
 
	if($usuarios===TRUE){
        $cliente = $mysqli->query ("INSERT INTO cliente(id_Cliente, nombre, correo, id_Usuario) VALUES ('','$nombreCliente','$emailCliente','$mysqli->insert_id')");
        if($cliente===TRUE){
            echo "Insert data";
        }
    }else{
        echo "failed";
    }

    $mysqli->close();
    
?>