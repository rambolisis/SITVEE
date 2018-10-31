<?php
    require '../conexion.php';

    //obtenemos los valores del formulario
	if(isset($_POST['clienteId']) && $_POST['clienteId'] != 'null'){
        $lista = $_POST['clienteId'];
        $nombreCliente = $_POST['nombreNuevo'];
        $emailCliente = $_POST['correoNuevo'];
        $usuarioCliente = $_POST['usuarioNuevo'];
        $pass = $_POST['contraseniaNueva'];
        $array = explode(',', $lista);
        $id = $array[0];
        $cliente = $mysqli->query("UPDATE cliente SET nombreCliente = '$nombreCliente', correo = '$emailCliente' WHERE id_Cliente = '$id' ");
        $IdUsuarioCliente = $mysqli->query("SELECT id_Usuario FROM cliente WHERE id_Cliente = '$id' ");     
        $datos = $IdUsuarioCliente->fetch_assoc();
        $idUsuario = $datos['id_Usuario'];
        $usuario = $mysqli->query("UPDATE usuario SET usuario = '$usuarioCliente', clave = '$pass' WHERE id_Usuario = '$idUsuario'");
        echo json_encode(array('mensaje' => false));
    }else if(isset($_GET['idPerfilCliente']) && $_GET['idPerfilCliente'] != 'null'){
        $clienteIdPerfil = $_GET['idPerfilCliente'];
        $nombreClientePerfil = $_POST['nombreClientePerfil'];
        $emailClientePerfil = $_POST['correoClientePerfil'];
        $usuarioClientePerfil = $_POST['usuarioClientePerfil'];
        $clientePerfil = $mysqli->query("UPDATE cliente SET nombreCliente = '$nombreClientePerfil', correo = '$emailClientePerfil' WHERE id_Cliente = '$clienteIdPerfil' ");
        $IdUsuarioClientePerfil = $mysqli->query("SELECT id_Usuario FROM cliente WHERE id_Cliente = '$clienteIdPerfil' ");     
        $datosPerfil = $IdUsuarioClientePerfil->fetch_assoc();
        $idUsuarioPerfil = $datosPerfil['id_Usuario'];
        $usuarioPerfil = $mysqli->query("UPDATE usuario SET usuario = '$usuarioClientePerfil' WHERE id_Usuario = '$idUsuarioPerfil'");
        echo json_encode(array('mensaje' => false));
    }else{
        echo json_encode(array('mensaje' => true));
    }

    $mysqli->close();
    
?>