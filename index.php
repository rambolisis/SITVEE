<?php
require("template/plantilla.php");
$Encabezado=new Encabezado("SITVEE");
$Pie=new Pie();
$Encabezado->generarHTML();
    SESSION_START();
    require 'conexion.php';

        if(isset($_SESSION['usuario'])){
            if($_SESSION['usuario']['rol'] == "Administrador"){
                header('Location: adminMenu.php');
            }else if($_SESSION['usuario']['rol'] == "Usuario"){
                header('Location: userMenu.php');
            }
        }
        $verificaFecha = $mysqli->query("SELECT estado FROM evento WHERE fecha < CURDATE()");
        while ($datos = $verificaFecha->fetch_assoc()){
            if($datos['estado'] != "Finalizado"){
                $actualizaEstado = $mysqli->query("UPDATE evento SET estado='Finalizado' WHERE fecha < CURDATE()");
            }
        }      
?>
<div class="error">
    <span>Credenciales invalidas, Por favor inténtelo de nuevo</span>
</div>
    <div class="main" style="height:64%; width:100%; padding:1%;padding-top:2.5%;" >
        <form id="formlg" >
            <h2><strong>Inicia sesión en SITVEE</strong></h2>
                <input type="text" id="user" name="usuario" placeholder=" Usuario" pattern="[A-Za-z0-9_-]{1,15}" style="margin-bottom:0%;" required />
                <input type="password" id="pass" style="margin-bottom:2%; margin-top:2%;"name="clave" placeholder=" Contraseña" pattern="[A-Za-z0-9_-]{1,15}" required/>
                <input type="checkbox" onclick="myFunction()" style="width:4%;float:left;margin:1%;"/>
                <label style="float:left; margin:0%;margin-bottom:2%;">Mostrar Contraseña</label>
                <input type="submit" id="botonLogin" value="Iniciar Sesion" style="font-weight:bold;width:90%;margin-left:5%;margin-bottom:2%;"/>
                <a href="solicitarContraseniaNueva.php"> ¿Olvidaste tu contraseña? </a>
                <a href="solicitudCuenta.php" style="float:right;"> Solicitar cuenta </a>
        </form>         
    </div>
<?php $Pie->generarHTML(); ?>