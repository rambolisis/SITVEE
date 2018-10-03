<?php
require '../conexion.php';

$json = array();

    if(isset($_GET["idInvitado"]) && isset($_GET["idEvento"])){
        $idInvitado = $_GET["idInvitado"];
        $idEvento = $_GET["idEvento"];

        $consultaBeneficios = $mysqli->query("SELECT nombre, cantidad, id_Beneficio FROM beneficio
        WHERE id_Invitado = '$idInvitado' AND id_Evento = '$idEvento' ");
        if($consultaBeneficios){
            while($reg=mysqli_fetch_array($consultaBeneficios)){
                $json['beneficios'][]=$reg;
            }
            $mysqli->close();
            echo json_encode($json);
            
        }else{
            $results["nombre"]='';
            $results["cantidad"]='';
            $results["id_Beneficio"]='';
            $json['beneficios'][]=$results;
            echo json_encode($json);
        }
    }else{
        $results["success"]=0;
        $results["message"]='WS no retorna';
        $json['beneficios'][]=$results;
        echo json_encode($json);
    }
?>