<?php
    require '../conexion.php';
        $clienteIdGestion = $_GET['idInfoCliente'];
        $eventoIdGestion = $_GET['idInfoEvento'];

        $info = $mysqli->query("SELECT
        cliente.nombreCliente AS Empresa,
        evento.nombreEvento AS Evento,
        evento.fecha AS Fecha,
        evento.descripcion AS Descripcion
        FROM
        cliente INNER JOIN evento ON cliente.id_Cliente = evento.id_Cliente 
        WHERE evento.id_Cliente = '$clienteIdGestion' AND evento.id_Evento = '$eventoIdGestion' ");

        $beneficiosControl = $mysqli->query("SELECT DISTINCT
        beneficioControl.nombreBeneficio AS Beneficio,
        beneficioControl.cantidadCanjeada AS Cantidad
        FROM beneficioControl WHERE beneficioControl.id_Evento = '$eventoIdGestion' ");

        $invitadosAsistidos = $mysqli->query("SELECT DISTINCT
        invitado.nombreInvitado AS Invitado
        FROM invitado WHERE invitado.id_Evento = '$eventoIdGestion' AND invitado.asistencia = 'SI'");
        $datos = $info->fetch_assoc();
?>
<!DOCTYPE html>
<html>
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
        <span>Empresa:</span><span style="font-weight: bold;"> <?php echo $datos['Empresa']; ?> </span><br>
        <span>Evento:</span><span style="font-weight: bold;"> <?php echo $datos['Evento']; ?> </span><br>
        <span>Fecha:</span><span style="font-weight: bold;"> <?php echo $datos['Fecha']; ?> </span><br>
        <span>Descripcion:</span><span style="font-weight: bold;"> <?php echo $datos['Descripcion']; ?> </span><br>
    </fieldset>
    <fieldset>
        <legend><strong>Lista de Beneficios</strong></legend>
        <?php
        while ($datos3 = $beneficiosControl->fetch_assoc()) {

        echo "<span>$datos3[Beneficio] | Cantidad canjeada: $datos3[Cantidad]</span><br>";

        }
        
        ?>
    </fieldset>
    <fieldset>
        <legend><strong>Asistencia de Invitados</strong></legend>
        <?php
        while ($datos2 = $invitadosAsistidos->fetch_assoc()) {

        echo "<span>$datos2[Invitado]</span><br>";

        }
        
        ?>
    </fieldset>
</body>
<?php $mysqli->close(); ?>
</html>