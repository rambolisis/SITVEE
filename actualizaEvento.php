<?php
    require 'conexion.php';

	//obtenemos los valores del formulario
	$nombreEvento = $_POST['nombreEventoNuevo'];
    $fechaEvento = $_POST['fechaEventoNuevo'];
    $descripcionEvento = $_POST['descripcionEventoNuevo'];
    $array = explode(',', $_POST['eventoId']);
    $id = $array[0];

    $evento = $mysqli->query("UPDATE evento SET nombre = '$nombreEvento', fecha = '$fechaEvento', descripcion = '$descripcionEvento'
                             WHERE id_Evento = '$id' ");

	if($evento===TRUE){
        echo json_encode(array('mensaje' => false));
    }else{
        echo "<script>
                alert('A ocurrido un error al actualizar el evento');
            </script>";
    }

    $mysqli->close();
    
?>