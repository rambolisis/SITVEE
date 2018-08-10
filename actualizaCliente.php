<?php
    require 'conexion.php';

	//obtenemos los valores del formulario
	$nombreCliente = $_POST['nombreNuevo'];
    $emailCliente = $_POST['correoNuevo'];
    $usuarioCliente = $_POST['usuarioNuevo'];
    $pass = $_POST['contraseniaNueva'];  
    $array = explode(',', $_POST['clienteId']);
    $id = $array[0];

    $cliente = $mysqli->query("UPDATE cliente SET nombre = '$nombreCliente', correo = '$emailCliente' WHERE id_Cliente = '$id' ");

	if($cliente===TRUE){
        $IdUsuarioCliente = $mysqli->query("SELECT id_Usuario FROM cliente WHERE id_Cliente = '$id' ");     
        $datos = $IdUsuarioCliente->fetch_assoc();
        $idUsuario = $datos['id_Usuario'];
        $usuario = $mysqli->query("UPDATE usuario SET usuario = '$usuarioCliente', clave = '$pass' WHERE id_Usuario = '$idUsuario'");
            if($usuario===TRUE){
                echo json_encode(array('mensaje' => false));
            }else{
                echo "<script>
                alert('A ocurrido un error al actualizar el cliente');
            </script>";
            }
    }else{
        echo "<script>
                alert('A ocurrido un error al actualizar el cliente');
            </script>";
    }

    $mysqli->close();
    
?>