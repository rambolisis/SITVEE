<title>Usuario</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="./css/style.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
<script src="js/lectorCsv.js" type="text/javascript"></script>
<script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/menu2.js" type="text/javascript"></script>
 </head>
 <?php
    SESSION_START();

    if(isset($_SESSION['usuario'])){
            if($_SESSION['usuario']['rol'] != "Usuario"){
                header("Location: userAdmin.php");
            }
        }else{
            header('Location: login.php');
        }
 ?>
<?php include('template/header.php'); ?>
            <div style="height: 64%">
            	<div class="vertical-menu">
				  <a id="Home">Inicio</a>
				  <a id="TutorialSitvee">Tutorial SITVEE</a>
				  <a id="Event">Eventos</a>
				  <a id="TutorialCSV">Tutorial CSV</a>
				  <a id="ImportarCSV">Importar CSV</a>
				  <a href="salir.php">Cerrar Sesion</a>
			</div>
			<div class="container" id="container" style="margin: 5.2%">
        <!--ESTE ES EL DIV DONDE VAMOS A MOSTRAR LA TABLA-->
		<div id="busqueda" style="display: none;">
		<h1>Por Favor adjunte un archivo.csv</h1>
        <br>
        <div class="input-group mt-2 mb-2">
            <div class="custom-file">
                <input type="file" class="btn btn-outline-secondary" id="inputfile" style="padding: 3px;">
                <button class="btn btn-outline-secondary" type="button" id="viewfile">Cargar</button>
            </div>
			<table class="table table-hover table-dark" id="tableMain">
        		<thead>
            		<tr style="display: none;" id="fila">
            		    <th scope="col">Nombre</th>
            		    <th scope="col">Primer Apellido</th>
                		<th scope="col">Segundo Apellido</th>
            			<th scope="col">Correo Electronico</th>
            		    <th scope="col">Telefono</th>
                		<th scope="col">Opciones</th>
            		</tr>
        		</thead>
        		<tbody id="table-data"></tbody>
    		</table>
			<input id="confirmar" type="button" value="Confirmar" onclick="Enviar();" style="display: none;" />
        	</div>
			</div>
			</div>
    	    </div>
            <?php include('template/footer.php'); ?>
    </body>
</html>