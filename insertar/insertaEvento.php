<?php
    require '../conexion.php';

	//obtenemos los valores del formulario
	$nombreEvento = $_POST['nombreEvento'];
    $fechaEvento = $_POST['fechaEvento'];
    $descripcionEvento = $_POST['descripcionEvento'];
    $id = $_POST['clienteEvento'];


    $evento = $mysqli->query("INSERT INTO evento(id_Evento, nombreEvento, fecha, descripcion, id_Cliente, estado) VALUES ('','$nombreEvento','$fechaEvento','$descripcionEvento','$id','Nuevo')");

	if($evento===TRUE){
        echo json_encode(array('mensaje' => false));
    }else{
        echo "<script>
                alert('A ocurrido un error al guardar el evento');
            </script>";
    }

    $mysqli->close();
    
?>