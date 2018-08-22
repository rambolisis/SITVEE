<?php
require 'conexion.php';

$json = array();
    if(isset($_GET["user"]) && isset($_GET["pass"])){
        $usuario = $_GET["user"];
        $clave = $_GET["pass"];

    $staff = $mysqli->query("SELECT u.usuario, u.clave FROM usuario AS u INNER JOIN staff
    AS s ON u.id_Usuario = s.id_Usuario WHERE u.usuario = '$usuario' AND u.clave = '$clave' ");

        if($staff){
            if($reg = $staff->fetch_array()){
                $json['datos'][] = $reg;
            }
            $mysqli->close();
            echo json_encode($json);
            
        }else{
			$results["u.usuario"]='';
			$results["u.clave"]='';
			$json['datos'][]=$results;
			echo json_encode($json);
		}		
	}else{
		   	$results["user"]='';
			$results["pwd"]='';
			$json['datos'][]=$results;
			echo json_encode($json);
        }
?>