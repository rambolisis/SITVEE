<?php
SESSION_START();

if (isset($_SESSION['usuario'])) {
    if ($_SESSION['usuario']['rol'] != "Usuario") {
        header("Location: adminMenu.php");
    }
} else {
    header('Location: index.php');
}

if(file_exists("QR-Invitados.zip")){
	header("Content-type: application/octet-stream");
	header("Content-disposition: attachment; filename=QR-Invitados.zip");
	readfile('QR-Invitados.zip');
	unlink('QR-Invitados.zip');
	$files = glob('QRimage/*'); //obtenemos todos los nombres de los ficheros
    foreach($files as $file){
    if(is_file($file))
    unlink($file); //elimino el fichero
}
}
?>
<title>Usuario</title>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="./css/style.css">
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/entradasBeneficios.js" type="text/javascript"></script>
<script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
 </head>
<?php include 'template/header.php';?>
	<div class="mensaje">
		<span></span>
	</div>
	<div id="loading-screen" style="display:none">
    	<img src="imagenes/spinning-circles.svg">
	</div>
	<div class="vertical-menu" style="padding:0px;">
				<ul class="menu" style="margin-top:0px;">
				  <li style="height: 33%; padding: 15%;"><a id="TutorialSitvee">Tutorial SITVEE</a></li>
				  <li style="height: 33%; padding: 15%;"><a  id="ImportarCSV">Eventos</a></li>
				  <li style="height: 33%; padding: 15%;"><a href="salir.php">Cerrar Sesion</a></li>
				</ul>
			</div>
			<div class="container" id="container" style="widht:85%;heigth:97%; padding:1%;">
		<!--ESTE ES EL DIV DONDE VAMOS A MOSTRAR LA TABLA-->
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
			</div>
    	    </div>
            <?php include 'template/footer.php';?>
    </body>
</html>