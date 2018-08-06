<?php
    $conn = new mysqli('localhost','id6607651_sitvee','12345','id6607651_sitvee');

    if($conn->connect_error){
        die($conn->connection_error);
    }
	//obtenemos los valores del formulario
	$nombreCliente = $_POST['nombreCliente'];
	$usuarioCliente = $_POST['usuarioCliente'];
	$emailCliente = $_POST['correoCliente'];
    $pass = $_POST['contraseniaCliente'];
    
    $sql = "INSERT INTO cliente(id_Cliente, nombre, correo, id_Usuario) VALUES ('','$nombreCliente','$emailCliente',3)";
 
	if($conn->query($sql)===TRUE){
        echo "Insert data";
    }else{
        echo "failed";
    }

    $conn->close();
?>