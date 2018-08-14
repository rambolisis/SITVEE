<?php
SESSION_START();

if (isset($_SESSION['usuario'])) {
    if ($_SESSION['usuario']['rol'] != "Usuario") {
        header("Location: adminMenu.php");
    }
} else {
    header('Location: index.php');
}
?>
<title>Usuario</title>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="./css/style.css">

 </head>
<?php include 'template/header.php';?>
            <div style="height: 64%">
            	<div class="vertical-menu">
				  <a style="height: 33.33%; padding: 23%;" id="TutorialSitvee">Tutorial SITVEE</a>
				  <a style="height: 33.33%; padding: 23%;" id="ImportarCSV">Eventos</a>
				  <a style="height: 33.33%; padding: 23%;" href="salir.php">Cerrar Sesion</a>
			</div>
			<!--<h1 style="padding-left: 240px;"> Bienvenido <?php echo $_SESSION['usuario']['nombre'] ?></h1>-->
			<div class="container" id="container" style="widht:85%;heigth:97%; padding:1%;">
		<!--ESTE ES EL DIV DONDE VAMOS A MOSTRAR LA TABLA-->
		<div id="beneficiosUser" style="display: none;">
			<form>
                    <div class="form-group">
                        <p style="float:left;width:40%;">
                            <label>Digite sus Beneficios:<input id="beneficio" class="form-control" type="text" placeholder="Beneficio..." style="width: 50%;float:right" required="" /></label>
                        </p>
                        <p style="float:left;width:40%; ">
                            <label>Digite la cantidad por persona:<input type="number" id="cantidad" class="form-control" type="text" placeholder="Cantidad..." style="width: 40%;float:right"/></label>
                            
                        </p>
                        <button style="width: 13%;" id="adicionar" class="btn btn-success" type="button">Añadir</button>
                    </div>
                </form>
				<div id="tablaBeneficios" style="height:250px; width:100%; overflow-y:scroll;">
                <table id="mytable" class="table table-bordered table-hover ">
                    <tr>
                        <th>Beneficios</th>
                        <th>Cantidad</th>
                        <th>Eliminar</th>
                    </tr>
                </table>
                <hr />
				</div>
            <button style="width: 13%;margin:1%;" onclick="Enviar2();" class="btn btn-success" type="button">Enviar</button>
			<button style="width: 13%;float:left;margin:1%;" id="regresar" class="btn btn-success" type="button">Regresar</button>
		</div>
		<div id="busqueda" style="display: none;">
			<h1>Por Favor adjunte un archivo.csv</h1>
			<br>
			<div class="custom-file">
					<input type="file" class="btn btn-outline-secondary" id="inputfile" style="padding: 3px;" name="Buscar">
					<button class="btn btn-outline-secondary" type="button" id="viewfile">Cargar</button>
			</div>
        <div class="input-group mt-2 mb-2" id="divTabla" style="height:240px; width:100%; display: none;overflow-y:scroll; ">
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

			<script src="js/jquery-3.3.1.min.js"></script>
			<script src="js/entradasBeneficios.js" type="text/javascript"></script>
			<script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
			<script src="js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>