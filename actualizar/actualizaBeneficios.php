<?php
require '../conexion.php';

$json = array();

    if(isset($_GET["idBeneficio"])){
        $idBeneficio = $_GET["idBeneficio"];

        $actualizaBeneficios = $mysqli->query("UPDATE beneficio SET cantidad = cantidad - 1 WHERE id_Beneficio = '$idBeneficio' ");
        if($actualizaBeneficios){
            echo "actualiza";
        }else{
            echo "No actualiza";
        }
    }else{
        echo "No actualiza";
    }
?>