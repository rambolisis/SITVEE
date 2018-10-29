<?php
require("template/plantilla.php");
$Encabezado=new Encabezado("SITVEE");
$Pie=new Pie();
$Encabezado->generarHTML();
?>
<div class="mensaje">
    <span id="mensaje"></span>
</div>
    <div class="main" style="height:64%; width:100%; padding:0.5%; text-align:center">
                <h2><strong>Solicitud de Cuenta</strong></h2>
				<form action="" id="frmSolicitudCuenta">
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
						<textarea name="comentariosClienteSolicitud" id="comentariosClienteSolicitud" style="resize:none;" rows="5" cols="60" placeholder="Escribe aquí tus comentarios"></textarea>
						<br>
                        <button id="solicitudCuenta" name="solicitudCuenta" type="submit" class="btn btn-success">Solicitar Cuenta</button>
                        <button type="submit" class="btn btn-primary" onclick="location.href='index.php';">Regresar</button>
				</form>  
    </div>
<?php $Pie->generarHTML(); ?>