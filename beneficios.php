﻿<title>Beneficios</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="js/beneficios.js" type="text/javascript"></script>
<?php include('template/header.php'); ?>
    <div class="container" style="margin: 3%">
                <form>
                    <div class="form-group">
                        <p>
                            <label>Digite sus Beneficios:</label>
                            <input id="beneficio" class="form-control" type="text" placeholder="Beneficio..." style="width: 30%" required="" />
                            <br>
                        </p>
                        <p>
                            <label>Digite la cantidad por persona:</label>
                            <input type="number" id="cantidad" class="form-control" type="text" placeholder="Cantidad..." style="width: 30%" style="float: left;">
                            <br>
                        </p>
                        <button id="adicionar" class="btn btn-success" type="button">Añadir</button>
                    </div>
                </form>
                <table id="mytable" class="table table-bordered table-hover ">
                    <tr>
                        <th>Beneficios</th>
                        <th>Cantidad</th>
                        <th>Eliminar</th>
                    </tr>
                </table>
                <hr />
            <button onclick="Enviar();" class="btn btn-success" type="button">Enviar</button>
        </div>
    </div>
    <?php include('template/footer.php'); ?>
</body>

</html>
