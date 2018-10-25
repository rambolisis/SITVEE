<?php
require("template/plantilla.php");
$Encabezado=new Encabezado("SITVEE");
$Pie=new Pie();
$Encabezado->generarHTML();
?>
<div class="mensaje">
    <span id="mensaje"></span>
</div>
    <div class="main" style="height:64%; width:100%; padding:6%; text-align:center">
                <h2><strong>Recuperar Contraseña</strong></h2>
                <label>Por favor ingrese el correo registrado con su</label><br>
                <label>cuenta para proceder a recuperar su contraseña</label>
				<form action="" id="frmSolicitudContraseniaNueva">
						<br>
						<input type="email" name="correoClienteSolicitudContrasenia" placeholder="Digite su correo electronico"  pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Formato de correo invalido" required="">
						<br>
                        <br>
                        <button id="solicitudContraseniaNueva" name="solicitudContraseniaNueva" type="submit" class="btn btn-success">Solicitar Nueva contraseña</button>
				</form>  
    </div>
<?php $Pie->generarHTML(); ?>