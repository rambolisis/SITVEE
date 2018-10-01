<?php
require("template/plantilla.php");
$Encabezado=new Encabezado("SITVEE");
$Pie=new Pie();
$Encabezado->generarHTML();
    SESSION_START();

        if(isset($_SESSION['usuario'])){
            if($_SESSION['usuario']['rol'] == "Administrador"){
                header('Location: adminMenu.php');
            }else if($_SESSION['usuario']['rol'] == "Usuario"){
                header('Location: userMenu.php');
            }
        }
?>
<div class="error">
    <span>Credenciales invalidas, Por favor inténtelo de nuevo</span>
</div>
    <div class="main" style="height:64%; width:100%; padding:3%;" >
        <form id="formlg" >
            <h2><strong>Inicia sesión en SITVEE</strong></h2>
                <input type="text" id="user" name="usuario" placeholder=" Usuario" pattern="[A-Za-z0-9_-]{1,15}" required/>
                <input type="password" id="pass" name="clave" placeholder=" Contraseña" pattern="[A-Za-z0-9_-]{1,15}" required/>
                <input type="submit" id="botonLogin" value="Iniciar Sesion" style="font-weight:bold;"/>
                <br>
                <a href=""> Olvide mi contraseña </a>
                <a href="SolicitarCuenta.php" style="float:right;"> Solicitar Cuenta </a>
        </form>         
    </div>
<?php $Pie->generarHTML(); ?>