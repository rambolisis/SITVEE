<?php
require("template/plantilla.php");
$Encabezado=new Encabezado("Eventos");
$Pie=new Pie();
$Encabezado->generarHTML();
	SESSION_START();
	require 'conexion.php';
	
	$time = 600;

    if(isset($_SESSION["usuario"])){ 
        if ($_SESSION['usuario']['rol'] != "Usuario") {
			header("Location: adminMenu.php");
		}
        if(isset($_SESSION["expire"]) && time() > $_SESSION["expire"] + $time){
            unset($_SESSION["expire"]); 
            unset($_SESSION["usuario"]);
            header('Location: salir.php');
        }else{ 
            $_SESSION["expire"] = time(); 
        } 
    }else{
        header('Location: index.php');
}

$verificaFecha = $mysqli->query("SELECT estado FROM evento WHERE fecha < CURDATE()");
	while ($datos = $verificaFecha->fetch_assoc())
		if($datos['estado'] != "Finalizado"){
			$actualizaEstado = $mysqli->query("UPDATE evento SET estado='Finalizado' WHERE fecha < CURDATE()");
		}
/*if(file_exists("QR-Invitados.zip")){
	header("Content-type: application/octet-stream");
	header("Content-disposition: attachment; filename = QR-Invitados.zip");
	readfile('QR-Invitados.zip');
	unlink('QR-Invitados.zip');
	$files = glob('QRimage/*'); //obtenemos todos los nombres de los ficheros
		foreach($files as $file){
			if(is_file($file))
				unlink($file); //elimino el fichero
		}*/
$files = glob('QRimage/*'); //obtenemos todos los nombres de los ficheros
	foreach($files as $file){
		if(is_file($file))
			unlink($file); //elimino el fichero
	}
?>
<script type="text/javascript">
    session();
</script>
<div class="mensaje">
	<span id="mensaje"></span>
</div>
<div class="vertical-menu" style="padding:0px;  height:64%;">
				<ul class="menu" style="margin-top:0px; width:100%;">
				  <li style="height: 15.8%;" id="MiPerfil"><a>Mi Perfil</a></li>	
				  <li style="height: 15.8%;" id="TutorialSitvee"><a>Tutorial SITVEE</a></li>
				  <li style="height: 15.8%;" id="GenerarCSV"><a>Generar CSV</a></li>
				  <li style="height: 15.8%;" id="ImportarCSV"><a>Eventos</a></li>
				  <li style="height: 15.8%;" id="SolicitarEvento"><a>Solicitar Evento</a></li>
				  <li style="height: 15.8%;" onclick="salir();"><a>Cerrar Sesion</a></li>
				</ul>
			</div>
		<div class="container" id="container" style="width:85%; height:64%; padding:1%;">
		<div id="solicitud" style="height:98%; width:100%;padding-left:5%; display:none; text-align:center"> 
				<form id="frmSolicitudEvento">
					<h2><strong>Solicitar Evento</strong></h2>
						<input type="text" id="nombreCliente" name="nombreCliente" style="display:none;" value="<?php echo $_SESSION['usuario']['nombreCliente']; ?>"/>
						<input type="text" id="correoCliente" name="correoCliente" style="display:none;" value="<?php echo $_SESSION['usuario']['correo']; ?>"/>
						Nombre del Evento:<br>
						<input type="text" name="nombreEventoNuevo" id="nombreEventoNuevo" placeholder="Escriba el nombre del evento" required="">
						<br>
						Fecha del Evento:<br>
						<input style="width: 30%;" name="fechaEventoNuevo" id="fechaEventoNuevo" type="date" required="" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> max="2025-12-31"/>
						<br>
						Descripcion del Evento:<br>
						<textarea name="descripcionEventoNuevo" id="descripcionEventoNuevo" style="resize:none;" rows="5" cols="40" placeholder="Escriba la descripción del evento"></textarea>
						<br><br>
						<button id="solicitarEventoNuevo" name="solicitarEventoNuevo" type="submit" class="btn btn-success">Solicitar Evento</button>
				</form>
		</div>
		<div id="Perfil" style="text-align:center;padding:2.5%;display:none;">
		<h2><strong>Mi Perfil</strong></h2>
            <form id="frmPerfil">
				<?php
					require 'conexion.php';
					$idUsuario = $_SESSION['usuario']['id_Usuario'];
					$InfoPerfil = $mysqli->query("SELECT u.usuario, c.nombreCliente, c.correo, c.id_Cliente 
					FROM usuario AS u INNER JOIN cliente 
					AS c ON u.id_Usuario = c.id_Usuario
					WHERE u.id_Usuario = '$idUsuario'");
					if ($datosU = $InfoPerfil->fetch_assoc()) {
				?>
				<span  id="idPerfilCliente" style="display:none;"><?php echo $datosU['id_Cliente']?></span>
                Nombre:<br>
                <input value="<?php echo $datosU['nombreCliente']?>" disabled="disabled" type="text" id="nombreClientePerfil" name="nombreClientePerfil" required="">
                <br>
				Correo:<br>
                <input value="<?php echo $datosU['correo']?>" disabled="disabled" type="email" id="correoClientePerfil" name="correoClientePerfil" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Formato de correo invalido" required="">
                <br>
                Usuario:<br>
                <input value="<?php echo $datosU['usuario']?>" disabled="disabled" type="text" id="usuarioClientePerfil" name="usuarioClientePerfil" required="">
                <br>
				<br>
				<a id="cambiarClave" style="color:#297AD0;" > Cambiar contraseña </a>
				<?php
					}
					$mysqli->close();
				?>
                <br>
                <button type="button" id="btnEditarPerfil" name="btnEditarPerfil" class="btn btn-primary" onclick="editarBotonPerfil();">Editar</button>
				<button disabled="disabled" id="btnGuardarPerfil" name="btnGuardarPerfil" type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
		<div id="PerfilCambiarContraseña" style="text-align:center;padding:2.5%;display:none;">
		<h2><strong>Cambiar Contraseña</strong></h2>
            <form id="frmCambiarContraseña">
				<span id="idUsuarioCliente" style="display:none;"><?php echo $_SESSION['usuario']['id_Usuario']; ?></span>
                Contraseña actual:<br>
                <input type="password" id="claveActualUsuarioCliente" name="claveActualUsuarioCliente" required="">
                <br>
				Contraseña nueva:<br>
                <input type="password" id="claveNuevaUsuarioCliente" name="claveNuevaUsuarioCliente" required="">
                <br>
                Repetir contraseña nueva:<br>
                <input type="password" id="repetirClaveUsuarioCliente" name="repetirClaveUsuarioCliente" required="">
                <br>
                <br>
				<a href="solicitarContraseniaNueva.php"> ¿Olvidaste tu contraseña? </a>
				<br>
				<button id="btnGuardarClaveNueva" name="btnGuardarClaveNueva" type="submit" class="btn btn-success">Guardar cambios</button>
			</form>
        </div>
		 <div id="actualizacionEventoUser" style="height:98%; width:100%;padding-left:5%; display:none; text-align:center"> 
			<div class="info" style="height:64%; padding:1%; text-align:center"> 
				<form id="frmInfoEvento" style="padding:2%; resize:none;">
					<h2><strong>Informacion Evento</strong></h2>
						<span id="idInfoEvento" style="display:none;">null</span>
						<span id="idInfoCliente" style="display:none;"><?php echo $_SESSION['usuario']['id_Cliente']; ?></span>
						<label>Nombre:</label>
							<input disabled="disabled" type="text" id="nombreInfoEvento" name="nombreInfoEvento" required="">
							<br>
						<label>Lugar:</label>
							<input disabled="disabled" style="width: 36.5%;" type="text" id="lugarInfoEvento" name="lugarInfoEvento" required="">
							<br>
						<label>Fecha:</label>
							<input disabled="disabled" style="width: 36.5%;" required="" id="fechaInfoEvento" name="fechaInfoEvento" type="date" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> max="2022-12-31"/>
							<br>
						<label>Descripción:</label> 
							<br>
							<textarea disabled="disabled" style="resize:none;" name="descripcionInfoEvento" id="descripcionInfoEvento" rows="3" max-rows="3" cols="40"></textarea>
							<br>
							<button type="button" id="btnEditar" name="btnEditar" class="btn btn-primary" onclick="editarBoton();">Editar</button>
							<button disabled="disabled" id="btnGuardar" name="btnGuardar" type="submit" class="btn btn-success">Guardar</button>
							<br>
							<span>Estado: </span><strong><span id="estado"></span></strong>
							<br>
								<button style="display:none;" id="cargarCSV" type="button" class="btn btn-success">Cargar CSV</button>
								<button style="display:none;" id="verInvitaciones" type="button" class="btn btn-success" onclick="reporteInvitacionPDF();">Ver Invitaciones</button>
								<button style="display:none;" id="informeEvento" type="button" class="btn btn-success" onclick="reporteInformeEventoPDF();">Informe Evento</button>
				</form>
			</div>
		 </div>
		 <div id="busqueda" style="display: none;">
		 <h2 id="izquierda"><strong>Por Favor adjunte un archivo.csv</strong></h2>
		<br>
		<div class="custom-file">
				<input type="file" class="btn btn-outline-secondary" id="inputfile" style="padding: 3px;" name="Buscar">
				<button class="btn btn-success" type="button" id="viewfile">Cargar</button>
		</div>
	<div class="input-group mt-2 mb-2" id="divTabla" style="height:300px; width:100%; display: none;overflow-y:scroll;">
		<table class="table table-hover table-dark" id="tableMain" style="width:100%;">
			<thead>
				<tr style="display: none;" id="fila">
					<th scope="col">Nombre</th>
					<th scope="col">Primer Apellido</th>
					<th scope="col">Segundo Apellido</th>
					<th scope="col">Correo Electronico</th>
					<th scope="col">Telefono</th>
					<th scope="col">Asistencia</th>
				</tr>
			</thead>
			<tbody id="table-data"></tbody>
		</table>
		</div>
		<button class="btn btn-success" id="confirmar" type="button" onclick="Enviar();">Confirmar</button>
		<input type="checkbox" id="select_all" style="width:1%;display:none;"/>
		<label id="select" style="display:none;">Seleccionar todos</label>
		</div>
		 <div id="gestionEvento" style="height:98%; width:100%;padding-left:5%; text-align:center;display:none;padding-left:25%;padding-top:3%;"> 
				<table class="table table-hover table-dark" id="tablaEventos" style="width:70%;text-align:center;">
					<thead>
						<tr id="fila" >
							<th scope="col" style="width:50%">Nombre</th>
							<th scope="col" style="width:20%">Gestionar</th>
						</tr>
						<?php
							require 'conexion.php';
							$eventoCliente = $_SESSION['usuario']['id_Cliente'];
							$Infoeventos = $mysqli->query("SELECT * FROM evento WHERE id_Cliente = '$eventoCliente' ");
			
							while ($datosE = $Infoeventos->fetch_assoc()) {
								$array = $datosE['id_Evento'].",".
										$datosE['nombreEvento'].",".
										$datosE['fecha'].",".
										$datosE['descripcion'].",".
										$datosE['lugar'].",".
										$datosE['estado'];
						?>
						<tr>
							<td><?php echo $datosE['nombreEvento'] ?></td>
							<td><button type="button" name="eventoIdgestion" id="eventoIdgestion" 
							class="btn btn-info" onclick="listarEventoGestion('<?php echo $array ?>');">Ver Evento</button></td>
							<!-- En este button al hacer click debe mostrar el segundo formulario -->
						</tr>
						<?php
							}
							$mysqli->close();
						?>
					</thead>
					<tbody id="table-data-evento"></tbody>
				</table>
			</div>
			<div id="noEventos" style="display: none;"> 
				<h3><strong>No tiene eventos disponibles en este momento</strong></h2>
				<h3><strong>Vaya a la sección de solicitar evento</strong></h2>
			</div>
			<div class="generarCSV" id="generarCSV" style="height:98%; width:100%;text-align:center;display:none;padding-left:4%;padding-top:3%;">
			<form id="frmInvitados" class="invitados">
			<h2><strong>Datos Invitado</strong></h2>
				<label style="float:left; width:40%; margin-left:5.8%;">Nombre:<input id="nombreInvitado" class="form-control" type="text" placeholder="Escriba el nombre" style="width:60%; float:right; margin-right:14%;" required="" /></label>
				<label style="float:left; width:40%;">Correo:<input id="correoInvitado" class="form-control" type="email" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" placeholder="Escriba el correo" style="width: 65%; float:right; margin-right:14%;" required="" /></label>
				<br>
				<label style="float:left; width:40%; margin-left:1.3%;">Primer Apellido:<input id="primerApellido" class="form-control" type="text" placeholder="Escriba el primer apellido" style="width: 60%; float:right; margin-right:3%;" required="" /></label>
				<label style="float:left; width:40%; margin-left:3.6%;">Telefono:<input type="text" pattern="[0-9]*" id="telefonoInvitado" class="form-control" type="text" placeholder="Escriba el telefono" style="width: 65%; float:right; margin-right:12%;" required=""/></label>
				<br>
				<label style="float:left; width:40%;">Segundo Apellido:<input id="segundoApellido" class="form-control" type="text" placeholder="Escriba el segundo apellido" style="width: 60%; float:right;" required="" /></label>
				<button style="width: 13%;float:left; margin-left:14%;" id="agregar" class="btn btn-success" type="submit" >Agregar</button>
			</form>
				<div>
					<table class="table table-hover table-dark" id="tablaInvitados" style="width:70%;text-align:center;margin-left:15%;margin-right:15%;">
						<tr>
							<th>Nombre</th>
							<th>Primer Apellido</th>
							<th>Segundo Apellido</th>
							<th>Correo Electronico</th>
							<th>Telefono</th>
							<th>Accion</th>
						</tr>
					</table>
				</div>
				<button style="width: 13%;" id="exportarCSV" class="btn btn-success" type="button" onclick="exportTableToCSV()">Generar CSV</button>
			</div>
			<div id="beneficiosUser" style="display: none;">
		<form>
				<div class="form-group">
					<p style="float:left;width:40%;">
						<label>Digite sus Beneficios:<input id="beneficio" class="form-control" type="text" placeholder="Beneficio..." style="width: 50%;float:right" required="" /></label>
					</p>
					<p style="float:left;width:40%; ">
						<label style="width:90%;">Digite la cantidad por persona:<input type="number" id="cantidad" min="1" max="100" class="form-control" type="text" placeholder="Cantidad..." style="width: 35%;float:right"/></label>
						
					</p>
					<button style="width: 13%;" id="adicionar" class="btn btn-success" type="button">Añadir</button>
				</div>
			</form>
			<div id="tablaBeneficios" style="height:180px; width:100%; overflow-y:scroll;">
			<table id="mytable" class="table table-bordered table-hover ">
				<tr>
					<th>Beneficios</th>
					<th>Cantidad</th>
					<th>Eliminar</th>
				</tr>
			</table>
			<hr />
			</div>
		<button style="width: 13%;margin:1%;" onclick="Enviar2();" class="btn btn-success" id="enviar2" type="button">Enviar</button>
		<button style="width: 13%;float:left;margin:1%;" onclick="Ocultar();" id="regresar" class="btn btn-success" type="button">Regresar</button>
	</div>
		 </div>
	<!--ESTE ES EL DIV DONDE VAMOS A MOSTRAR LA TABLA-->
	</div>
</div>
<?php $Pie->generarHTML(); ?>