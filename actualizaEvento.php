<?php
    require 'conexion.php';

	//obtenemos los valores del formulario
	$nombreEvento = $_POST['nombreEventoNuevo'];
    $fechaEvento = $_POST['fechaEventoNuevo'];
    $descripcionEvento = $_POST['descripcionEventoNuevo'];
    $lista = $_POST['eventoId'];
    
	if($lista != 'null'){
        $array = explode(',', $lista);
        $id = $array[0];
        $evento = $mysqli->query("UPDATE evento SET nombre = '$nombreEvento', fecha = '$fechaEvento', descripcion = '$descripcionEvento'
                             WHERE id_Evento = '$id' ");
        echo json_encode(array('mensaje' => false));
    }else{
        echo json_encode(array('mensaje' => true));
    }

    $mysqli->close();
    
?>