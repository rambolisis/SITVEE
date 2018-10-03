<?php
    require '../conexion.php';

	//obtenemos los valores del formulario
	if(isset($_POST['eventoId']) && $_POST['eventoId'] != 'null'){
        $lista = $_POST['eventoId'];
        $nombreEvento = $_POST['nombreEventoNuevo'];
        $fechaEvento = $_POST['fechaEventoNuevo'];
        $descripcionEvento = $_POST['descripcionEventoNuevo'];
        $array = explode(',', $lista);
        $id = $array[0];
        $evento = $mysqli->query("UPDATE evento SET nombreEvento = '$nombreEvento', fecha = '$fechaEvento', descripcion = '$descripcionEvento'
                             WHERE id_Evento = '$id' ");
        echo json_encode(array('mensaje' => false));
    }else if(isset($_GET['idInfoEvento']) && $_GET['idInfoEvento'] != 'null'){
        $eventoIdGestion = $_GET['idInfoEvento'];
        $nombreEventoGestion = $_POST['nombreInfoEvento'];
        $fechaEventoGestion = $_POST['fechaInfoEvento'];
        $descripcionEventoGestion = $_POST['descripcionInfoEvento'];
        $evento = $mysqli->query("UPDATE evento SET nombreEvento = '$nombreEventoGestion', fecha = '$fechaEventoGestion', descripcion = '$descripcionEventoGestion'
                             WHERE id_Evento = '$eventoIdGestion' ");
        echo json_encode(array('mensaje' => false));
    }else{
        echo json_encode(array('mensaje' => true));
    }

    $mysqli->close();
    
?>