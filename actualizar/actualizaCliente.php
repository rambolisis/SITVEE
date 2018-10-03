<?php
    require '../conexion.php';

	//obtenemos los valores del formulario
	$nombreCliente = $_POST['nombreNuevo'];
    $emailCliente = $_POST['correoNuevo'];
    $usuarioCliente = $_POST['usuarioNuevo'];
    $pass = $_POST['contraseniaNueva'];
    $lista = $_POST['clienteId']; 

	if($lista != 'null'){
        $array = explode(',', $lista);
        $id = $array[0];
        $cliente = $mysqli->query("UPDATE cliente SET nombreCliente = '$nombreCliente', correo = '$emailCliente' WHERE id_Cliente = '$id' ");
        $IdUsuarioCliente = $mysqli->query("SELECT id_Usuario FROM cliente WHERE id_Cliente = '$id' ");     
        $datos = $IdUsuarioCliente->fetch_assoc();
        $idUsuario = $datos['id_Usuario'];
        $usuario = $mysqli->query("UPDATE usuario SET usuario = '$usuarioCliente', clave = '$pass' WHERE id_Usuario = '$idUsuario'");
        echo json_encode(array('mensaje' => false));
    }else{
        echo json_encode(array('mensaje' => true));
    }

    $mysqli->close();
    
?>