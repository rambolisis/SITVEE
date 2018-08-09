<?php
    SESSION_START();

    if(isset($_SESSION['usuario'])){
            if($_SESSION['usuario']['rol'] != "Usuario"){
                header("Location: adminMenu.php");
            }
        }else{
            header('Location: index.php');
        }
 ?>
<title>Usuario</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="./css/style.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="js/lectorCsv.js" type="text/javascript"></script>
<script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/menu2.js" type="text/javascript"></script>
 </head>
<?php include('template/header.php'); ?>
            <div style="height: 64%">
            	<div class="vertical-menu">
				  <a style="height: 16.66%" id="Home">Inicio</a>
				  <a style="height: 16.66%" id="TutorialSitvee">Tutorial SITVEE</a>
				  <a style="height: 16.66%" id="Event">Eventos</a>
				  <a style="height: 16.66%" id="TutorialCSV">Tutorial CSV</a>
				  <a style="height: 16.66%" id="ImportarCSV">Importar CSV</a>
				  <a style="height: 16.66%" href="salir.php">Cerrar Sesion</a>
			</div>
			<!--<h1 style="padding-left: 240px;"> Bienvenido <?php echo $_SESSION['usuario']['nombre']?></h1>-->
			<div class="container" id="container" style="widht:85%;heigth:97%; padding:1%;">
        <!--ESTE ES EL DIV DONDE VAMOS A MOSTRAR LA TABLA-->
		<div id="busqueda" style="display: none;">
		<h1>Por Favor adjunte un archivo.csv</h1>
        <br>
		<div class="custom-file">
                <input type="file" class="btn btn-outline-secondary" id="inputfile" style="padding: 3px;">
                <button class="btn btn-outline-secondary" type="button" id="viewfile">Cargar</button>
        </div>
        <div class="input-group mt-2 mb-2" id="divTabla" style="height:250px; width:100%; display: none;overflow-y:scroll; ">
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
			<br>
			</div>
			<input id="confirmar" style="width: 30%; display: none;" type="button" value="Confirmar" onclick="Enviar();"  />
			</div>
			</div>
    	    </div>
            <?php include('template/footer.php'); ?>
    </body>
</html>