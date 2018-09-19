<?php
require 'conexion.php';

    if(isset($_POST["user"]) && isset($_POST["pass"])){
        $usuario = $_POST["user"];
        $clave = $_POST["pass"];

$statement = $mysqli->query("SELECT u.usuario, u.clave FROM usuario AS u INNER JOIN staff
AS s ON u.id_Usuario = s.id_Usuario WHERE u.usuario = '$usuario' AND u.clave = '$clave' ");

$response = array();
$response["success"] = false;  

if($statement->num_rows > 0){
    $response["success"] = true;
    echo json_encode($response);
    $mysqli->close();
}else{
    $response["success"] = false;
    echo json_encode($response);
}

    }else{
        $response["success"] = false;
        echo json_encode($response);
    }
?>