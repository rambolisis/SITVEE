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
    <div class="main" style="height:64%; width:100%; padding:1%; text-align:center">
                <h1>Contactenos </h1>
				<form action="" id="frmActualizaEventoUser">
						Nombre:<br>
						<input type="text" name="nombreClienteSolicitud" id="nombreClienteSolicitud"  required="" placeholder="Digite su nombre completo">
						<br>
                        Correo Electronico:<br>
                        <input type="email" name="correoClienteSolicitud" placeholder="Digite su correo electronico"  pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Formato de correo invalido" required="">
                        <br>
                        Teléfono: <br>
                        <input type="tel" name="telefonoClienteSolicitud" placeholder="Digite su numero telefonico" required="" title="Digite su numero para contactarlo">
						<br>
                        Comentarios:<br>
						<textarea name="comentariosClienteSolicitud" id="comentariosClienteSolicitud" rows="5" cols="60" placeholder="Escribe aquí tus comentarios"></textarea>
						<br>
						<input style="width: 30%;" type="submit" class="ActualizaEventoUser" value="Solicitar Evento">
				</form>
		   
    </div>
<?php $Pie->generarHTML(); ?>