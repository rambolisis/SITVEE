<!DOCTYPE html>
<html>
<?php
    require 'conexion.php';

    $info = $mysqli->query("SELECT
    cliente.nombreCliente AS Empresa,
    evento.nombreEvento AS Evento,
    evento.fecha AS Fecha,
    evento.descripcion AS Descripcion
    FROM
    cliente INNER JOIN evento ON cliente.id_Cliente = evento.id_Cliente 
    WHERE evento.id_Cliente = 1 AND evento.id_Evento = 3");
    $beneficios = $mysqli->query("SELECT DISTINCT
    beneficio.nombre AS Beneficio
    FROM 
    beneficio INNER JOIN evento ON beneficio.id_Evento = evento.id_Evento 
    WHERE evento.id_Evento = 3");
    $invitados = $mysqli->query("SELECT DISTINCT
    invitado.nombreInvitado AS Invitado
    FROM 
    invitado INNER JOIN evento ON invitado.id_Evento = evento.id_Evento 
    WHERE evento.id_Evento = 3");
    $datos = $info->fetch_assoc();
?>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PDF</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <img src='imagenes/Logo.png' style='width:30%; height:10%;'/>
    <br>
    <fieldset>
        <div style="font-weight: bold;">Empresa: <?php echo $datos['Empresa']; ?></div>
        <div style="font-weight: bold;">Nombre Evento: <?php echo $datos['Evento']; ?></div>
        <div style="font-weight: bold;">Fecha: <?php echo $datos['Fecha']; ?></div>
        <div style="font-weight: bold;">Descripción: <?php echo $datos['Descripcion']; ?></div>
    </fieldset>
    <fieldset>
        <legend>Lista Invitados</legend>
        <?php
        while ($datos2 = $invitados->fetch_assoc()) {

        echo "<div style='font-weight: bold;'>$datos2[Invitado]</div>";

        }
        
        ?>
    </fieldset>
    <fieldset>
        <legend>Lista Beneficios</legend>
        <?php
        while ($datos3 = $beneficios->fetch_assoc()) {

        echo "<div style='font-weight: bold;'>$datos3[Beneficio]</div>";

        }
        
        ?>
    </fieldset>
</body>
<?php $mysqli->close(); ?>
</html>