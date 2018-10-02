<?php
require("template/plantilla.php");
$Encabezado=new Encabezado("Eventos");
$Pie=new Pie();
$Encabezado->generarHTML();
	SESSION_START();

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

	if(file_exists("QR-Invitados.zip")){
		header("Content-type: application/octet-stream");
		header("Content-disposition: attachment; filename = QR-Invitados.zip");
		readfile('QR-Invitados.zip');
		unlink('QR-Invitados.zip');
		$files = glob('QRimage/*'); //obtenemos todos los nombres de los ficheros
			foreach($files as $file){
				if(is_file($file))
					unlink($file); //elimino el fichero
			}
}
?>
<script type="text/javascript">
    session();
</script>
<div class="mensaje">
	<span></span>
</div>
<div class="vertical-menu" style="padding:0px;  height:64%;">
				<ul class="menu" style="margin-top:0px; width:100%;">
				  <li style="height: 25%; padding: 15%;" id="TutorialSitvee"><a>Tutorial SITVEE</a></li>
				  <li style="height: 25%; padding: 15%;" id="ImportarCSV"><a>Eventos</a></li>
				  <li style="height: 25%; padding: 12%;" id="SolicitarEvento"><a>SolicitarEvento</a></li>
				  <li style="height: 25%; padding: 15%;" onclick="salir();"><a>Cerrar Sesion</a></li>
				</ul>
			</div>
		<div class="container" id="container" style="width:85%; height:64%; padding:1%;">
		<div id="solicitud" style="height:98%; width:100%;padding-left:5%; display:none; text-align:center"> 
				<form action="" id="frmActualizaEventoUser">
						<h1>Nuevo Evento</h1>
						<br>
						Fecha del Evento:<br>
						<input style="width: 30%;" name="fechaEventoNuevoUserser" id="fechaEventoNuevoUser" type="date" required="" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> max="2025-12-31"/>
						<br>
						Nombre del Evento:<br>
						<input type="text" name="nombreEventoNuevo" id="nombreEventoNuevoUser"  required="">
						<br>
						Descripcion del Evento:<br>
						<textarea name="comentariosEventoNuevoUser" id="comentariosEventoNuevoUser" rows="5" cols="40" placeholder="Escribe aquí tus comentarios"></textarea>
						<br><br>
						<input style="width: 30%;" type="submit" class="ActualizaEventoUser" value="Solicitar Evento">
				</form>
		 </div>
		 <div id="actualizacionEventoUser" style="height:98%; width:100%;padding-left:5%; display:none; text-align:center"> 
			<div class="info" style="height:64%; padding:1%; text-align:center"> 
				<form id="frmInfoEvento">
					<h1>Informacion Evento </h1>
						<label>Nombre:</label> 
							<input type="text" name="nombreInfoEvento" required="">
							<br>
						<label>Fecha:</label>
							<input style="width: 30.8%;" required="" name="fechaInfoEvento" type="date" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> max="2022-12-31"/>
							<br>
						<label>Descripción:</label> 
							<input type="text" name="descripcionInfoEvento" required="">
							<br>
							<button type="button" class="btn btn-primary">Editar</button>
							<button type="button" class="btn btn-success">Guardar</button>
							<br>
							<br>
						<span>Estado:  </span><span id="estado"> Nuevo / Invitación Enviada / Finalizado </span>
							<br>
							<br>
								<button id="cargarCSV" type="button" class="btn btn-success">Cargar CSV</button>
								<!--Este boton debe mostrar el form de cargar CSV-->
								<button id="verInvitaciones" type="button" class="btn btn-success">Ver Invitaciones</button>
								<button id="informeEvento" type="button" class="btn btn-success">Informe Evento</button>
				</form>
			</div>
		 </div>
		 <div id="busqueda" style="display: none;">
		<select name="eventoId" id="eventoId" style="width: 250px;">
			<option value="null">Seleccione un evento</option>
			<?php
				require 'conexion.php';
				$eventoCliente = $_SESSION['usuario']['id_Cliente'];
				$Actualizaeventos = $mysqli->query("SELECT * FROM evento WHERE id_Cliente = '$eventoCliente' ");

				while ($datosE = $Actualizaeventos->fetch_assoc()) {
					echo "<option value=\"{$datosE['id_Evento']}\">{$datosE['nombreEvento']}</option>";
				}
				$mysqli->close();
				?>
		</select>
		<br><br>
		<h1>Por Favor adjunte un archivo.csv</h1>
		<br>
		<div class="custom-file">
				<input type="file" class="btn btn-outline-secondary" id="inputfile" style="padding: 3px;" name="Buscar">
				<button class="btn btn-outline-secondary" type="button" id="viewfile">Cargar</button>
		</div>
	<div class="input-group mt-2 mb-2" id="divTabla" style="height:180px; width:100%; display: none;overflow-y:scroll; ">
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
		<input id="confirmar" style="width: 13%; display: none;" type="button" value="Confirmar" onclick="Enviar();"  />
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
							$Actualizaeventos = $mysqli->query("SELECT * FROM evento WHERE id_Cliente = 1 ");
			
							while ($datosE = $Actualizaeventos->fetch_assoc()) {
						?>
						<tr>
							<td><?php echo $datosE['nombreEvento'] ?></td>
							<td><button value="<?php echo $datosE['id_Evento'] ?>" type="button"
							name="ver" id="verEvento" class="btn btn-primary">Ver Evento</button></td>
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