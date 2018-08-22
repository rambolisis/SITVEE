<?php
require 'conexion.php';

$json = array();

    if(isset($_GET["idInvitado"]) && isset($_GET["idEvento"])){
        $idInvitado = $_GET["idInvitado"];
        $idEvento = $_GET["idEvento"];

        $consultaInfo = $mysqli->query("SELECT i.nombreInvitado, e.nombreEvento, c.nombreCliente 
        FROM invitado AS i INNER JOIN evento AS e INNER JOIN cliente
        AS c ON i.id_Evento = e.id_Evento AND e.id_Cliente = c.id_Cliente 
        WHERE i.id_Invitado = '$idInvitado' AND i.id_Evento = '$idEvento' ");
        
        if($consultaInfo){
            while($reg=mysqli_fetch_array($consultaInfo)){
                $json['info'][]=$reg;
            }
            $mysqli->close();
            echo json_encode($json);
            
        }else{
            $results["i.nombreInvitado"]='';
            $results["e.nombreEvento"]='';
            $results["c.nombreCliente"]='';
            $json['info'][]=$results;
            echo json_encode($json);
        }
    }else{
        $results["success"]=0;
        $results["message"]='WS no retorna';
        $json['info'][]=$results;
        echo json_encode($json);
    }
?>