
<title>Importar Empleados</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js" type="text/javascript"></script>
<?php include 'template/header.php';?>
    <div class="container" style="margin-bottom : 92px" id="container" >
        <!--ESTE ES EL DIV DONDE VAMOS A MOSTRAR LA TABLA-->
        <h1 class="display-4">Por Favor adjunte un archivo.csv</h1>
        </br>
        <div class="input-group mt-2 mb-2" id="busqueda">
            <div class="custom-file">
                <input type="file" class="btn btn-outline-secondary" accept=".csv" id="inputfile" style="padding: 3px;">
                <button class="btn btn-outline-secondary" type="button" id="viewfile">Cargar</button>
            </div>
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
        <button id="confirmar" type="button" class="btn btn-outline-success btn-lg btn-block" onclick="Enviar();" style="display: none;">Confirmar</button>
        <!-- <input id="confirmar" type="button" value="Confirmar" onclick="Enviar();" style="display: none;" /> -->
    </div>

    <script src="js/lectorCsv.js" type="text/javascript"></script>
    <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <br>
    <br>
    <footer class="fixed-bottom">
        <?php include 'template/footer.php';?>
    </footer>
    
</body>

</html>