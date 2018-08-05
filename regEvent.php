<?php
    $conn = new mysqli('localhost','id6607651_sitvee','12345','id6607651_sitvee');

    if($conn->connect_error){
        die($conn->connection_error);
    }
	//obtenemos los valores del formulario
	$nombreEvento = $_POST['nombreEvento'];
	$usuarioEvento = $_POST['usuarioEvento'];
	$fechaEvento = $_POST['fechaEvento'];
    
    $sql = "INSERT INTO evento(id_Evento, nombre, fecha, descripcion,  id_Cliente) VALUES ('','$nombreEvento','$fechaEvento','$usuarioEvento', 1)";
 
	if($conn->query($sql)===TRUE){
        echo "Insert data";
    }else{
        echo "failed";
    }

    $conn->close();
?>