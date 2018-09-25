<?php
SESSION_START();

if (isset($_SESSION['usuario'])) {
    if ($_SESSION['usuario']['rol'] != "Administrador") {
        header("Location: userMenu.php");
    }
} else {
    header('Location: index.php');
}
?>
<title>Administrador</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="js/menu.js" type="text/javascript"></script>
<link rel="stylesheet" href="./css/style.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script type="text/javascript">
function listarCliente() {
    var cadena = document.getElementById("clienteId").value;
    var lista = cadena.split(",");
    var nombre = lista[1];
    var correo = lista[2];
    var usuario = lista[3];
    var clave = lista[4];
    if(cadena === "null"){
    document.getElementById("nombreNuevo").value = "";
    document.getElementById("correoNuevo").value = "";
    document.getElementById("usuarioNuevo").value = "";
    document.getElementById("contraseniaNueva").value = "";
    }else{
    document.getElementById("nombreNuevo").value = nombre;
    document.getElementById("correoNuevo").value = correo;
    document.getElementById("usuarioNuevo").value = usuario;
    document.getElementById("contraseniaNueva").value = clave;
    }
    
}
function listarEvento() {
    var cadena = document.getElementById("eventoId").value;
    var lista = cadena.split(",");
    var nombreEvento = lista[1];
    var fecha = lista[2];
    var descripcion = lista[3];
    var nombreCliente = lista[4];
    if(cadena === "null"){
    document.getElementById("nombreEventoNuevo").value = "";
    document.getElementById("fechaEventoNuevo").value = "";
    document.getElementById("descripcionEventoNuevo").value = "";
    document.getElementById("clienteEventoNuevo").value = "";
    }else{
    document.getElementById("nombreEventoNuevo").value = nombreEvento;
    document.getElementById("fechaEventoNuevo").value = fecha;
    document.getElementById("descripcionEventoNuevo").value = descripcion;
    document.getElementById("clienteEventoNuevo").value = nombreCliente;
    }
}
function listarStaff() {
    var cadena = document.getElementById("staffId").value;
    var lista = cadena.split(",");
    var usuario = lista[3];
    var clave = lista[4];
    if(cadena === "null"){
    document.getElementById("usuarioStaff").value = "";
    document.getElementById("contraseniaStaff").value = "";
    }else{
    document.getElementById("usuarioStaff").value = usuario;
    document.getElementById("contraseniaStaff").value = clave;
    }
}
</script>
<script src="js/validar.js"></script>
</head>
<?php include 'template/header.php';?>
        <div class="mensaje">
            <span></span>
        </div>
            <div style="height: 64%;">
            <div class="vertical-menu" >
                <ul class="menu" style="margin-top:0px;">
                    <li style="height: 11.5%;" id="NewClient"><a>Nuevo Cliente</a></li>
                    <li style="height: 11.5%;" id="NewEvent"><a>Nuevo Evento</a></li>
                    <li style="height: 11.5%;" id="NewStaff"><a>Nuevo Staff</a></li>
                    <li style="height: 11.5%;" id="UpdateClient"><a>Actualizar Cliente</a></li>
                    <li style="height: 11.5%;" id="UpdateEvent"><a>Actualizar Evento</a></li>
                    <li style="height: 11.5%;" id="UpdateStaff"><a>Actualizar Staff</a></li>
                    <li style="height: 11.5%;" id="Administrator"><a>Administrador</a></li>
                    <li style="height: 11.5%;" ><a href='salir.php'>Cerrar Sesion</a></li>
                 </ul>
                </div>
				<div id="NuevoEvento">
                    <form action="" id="frmNuevoEvento">
                        Nombre del Evento:<br>
                        <input type="text" name="nombreEvento" placeholder="Escriba el nombre del evento" required="">
                        <br>
                        Descripcion del Evento:<br>
                        <input type="text" name="descripcionEvento" placeholder="Escriba una descripción del evento" required="">
                        <br>
                        Fecha del Evento:<br>
                        <input style="width: 13%;" required="" name="fechaEvento" type="date" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> max="2022-12-31"/>
                        <br>                                    
                        <br>
                        <select name="clienteEvento" style="width: 250px;">
                        <option value="null">Seleccione un cliente</option>
                        <?php
                            require 'conexion.php';

                            $clientes = $mysqli->query("SELECT id_Cliente, nombreCliente FROM cliente ");

                            while ($datos = $clientes->fetch_assoc()) {

                                echo "<option value=\"{$datos['id_Cliente']}\">{$datos['nombreCliente']}</option>";

                            }
                            $mysqli->close();
                            ?>
                        </select>
                        <br>
                        <br>
                        <input style="width: 13%;" type="submit" class="GuardarEvento" value="Guardar">
                    </form>
				</div>
                <div id="NuevoCliente">
                    <form action="" id="frmNuevoCliente">
                      Nombre del cliente:<br>
                      <input type="text" name="nombreCliente" placeholder="Escriba el nombre" required="">
                      <br>
                      Correo del cliente:<br>
                      <input type="email" name="correoCliente" placeholder="Escriba el correo"  pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Formato de correo invalido" required="">
                      <br>
                      Usuario:<br>
                      <input type="text" name="usuarioCliente" placeholder="Escriba el usuario" required="">
                      <br>
                      Contraseña:<br>
                      <input type="password" name="contraseniaCliente" placeholder="Escriba la contraseña" required="">
                      <br><br>
                      <input style="width: 13%;" type="submit" class="GuardarCliente" value="Guardar">
                    </form>
                </div>
                <div id="NuevoStaff">
                    <form action="" id="frmNuevoStaff">
                        <select name="staffEvento" style="width: 250px;">
                            <option value="null">Seleccione un evento</option>
                            <?php
                                require 'conexion.php';

                                $eventoS = $mysqli->query("SELECT id_Evento, nombreEvento FROM evento ");

                                while ($datosS = $eventoS->fetch_assoc()) {

                                    echo "<option value=\"{$datosS['id_Evento']}\">{$datosS['nombreEvento']}</option>";

                                }
                                $mysqli->close();
                                ?>
                        </select>
                        <br>
                        Usuario:<br>
                        <input type="text" name="usuarioStaff" placeholder="Escriba el usuario" required="">
                        <br>
                        Contraseña:<br>
                        <input type="password" name="contraseniaStaff" placeholder="Escriba la contraseña" required="">
                        <br><br>
                        <input style="width: 13%;" type="submit" class="GuardarStaff" value="Guardar">
                    </form>
				</div>
                <div id="ActualizarEvento">
                    <form action="" id="frmActualizaEvento">
                      <select onchange="listarEvento();" name="eventoId" id="eventoId" style="width: 250px;">
                                    <option value="null">Seleccione un evento</option>
                                    <?php
                                        require 'conexion.php';

                                        $Actualizaeventos = $mysqli->query("SELECT * FROM evento ");

                                        while ($datosE = $Actualizaeventos->fetch_assoc()) {
                                            $id = $datosE['id_Cliente'];
                                            $cliente = $mysqli->query("SELECT nombreCliente FROM cliente WHERE id_Cliente = '$id' ");
                                            $datosC = $cliente->fetch_assoc();
                                            echo "<option value=\"{$datosE['id_Evento']},{$datosE['nombreEvento']},{$datosE['fecha']},{$datosE['descripcion']},{$datosC['nombreCliente']}\">{$datosE['nombreEvento']}</option>";

                                        }
                                        $mysqli->close();
                                        ?>
                                    </select>
                                    <br>
                          Cliente del Evento:<br>
                          <input type="text" disabled="disabled" name="clienteEventoNuevo" id="clienteEventoNuevo" required="">
                          <br>
                          Nombre del Evento:<br>
                          <input type="text" name="nombreEventoNuevo" id="nombreEventoNuevo"  required="">
                          <br>
                          Descripcion del Evento:<br>
                          <input type="text" name="descripcionEventoNuevo" id="descripcionEventoNuevo"  required="">
                          <br>
                          Fecha del Evento:<br>
                          <input style="width: 13%;" name="fechaEventoNuevo" id="fechaEventoNuevo" type="date" required="" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> max="2025-12-31"/>
                          <br><br>
                          <input style="width: 13%;" type="submit" class="ActualizaEvento" value="Actualizar">
                </form>
                </div>
                <div id="ActualizarCliente">
                <form action="" id="frmActualizaCliente">
                        <select onchange="listarCliente();" name="clienteId" id="clienteId" style="width: 250px;">
                                    <option value="null">Seleccione un cliente</option>
                                    <?php
                                        require 'conexion.php';
                                        $Actualizaclientes = $mysqli->query("SELECT * FROM cliente ");
                                        while ($datosC = $Actualizaclientes->fetch_assoc()) {
                                            $id = $datosC['id_Usuario'];
                                            $usuario = $mysqli->query("SELECT usuario,clave FROM usuario WHERE id_Usuario = '$id' ");
                                            $datosU = $usuario->fetch_assoc();
                                            echo "<option value=\"{$datosC['id_Cliente']},{$datosC['nombreCliente']},{$datosC['correo']},{$datosU['usuario']},{$datosU['clave']}\">{$datosC['nombreCliente']}</option>";

                                        }
                                        $mysqli->close();
                                    ?>
                                    </select>
                                    <br>
                      Nombre del Cliente:<br>
                      <input  type="text" name="nombreNuevo" id="nombreNuevo" required="">
                      <br>
                      Correo del Cliente:<br>
                      <input  type="email" name="correoNuevo" id="correoNuevo" required="">
                      <br>
                      Usuario:<br>
                      <input  type="text" name="usuarioNuevo" id="usuarioNuevo"  required="">
                      <br>
                      Contraseña:<br>
                      <input  type="text" name="contraseniaNueva" id="contraseniaNueva" required="">
                      <br><br>
                      <input style="width: 13%;" type="submit" class="ActualizarCliente" value="Actualizar">
                    </form>
                </div>
                <div id="ActualizarStaff">
                    <form action="" id="frmActualizaStaff">
                                    <select onchange="listarStaff();" name="staffId" id="staffId" style="width: 250px;">
                                    <option value="null">Seleccione un evento</option>                                    
                                    <?php
                                        require 'conexion.php';
                                        $staff = $mysqli->query("SELECT * FROM staff ");
                                        while ($datosS = $staff->fetch_assoc()) {
                                            $idU = $datosS['id_Usuario'];
                                            $idE = $datosS['id_Evento'];
                                            $usuarioS = $mysqli->query("SELECT id_Usuario,usuario,clave FROM usuario WHERE id_Usuario = '$idU' ");
                                            $datosU = $usuarioS->fetch_assoc();
                                            $EventoS = $mysqli->query("SELECT id_Evento,nombreEvento FROM evento WHERE id_Evento = '$idE' ");
                                            $datosE = $EventoS->fetch_assoc();
                                            echo "<option value=\"{$datosS['id_Staff']},{$datosS['id_Usuario']},{$datosS['id_Evento']},{$datosU['usuario']},{$datosU['clave']}\">{$datosE['nombreEvento']}</option>";
                                        }
                                        $mysqli->close();
                                        ?>
                                    </select>
                                    <br>
                                    Usuario:<br>
                                    <input type="text" name="usuarioStaff" id="usuarioStaff" required="">
                                    <br>
                                    Contraseña:<br>
                                    <input type="text" name="contraseniaStaff" id="contraseniaStaff" required="">
                                    <br><br>
                                    <input style="width: 13%;" type="submit" class="ActualizaStaff" value="Actualizar">
                    </form>
				</div>
                <div id="Administrador">
                    <form action="" id="frmNuevoAdministrador">
                          Nombre del administrador:<br>
                          <input type="text" name="nombreAdmi" placeholder="Escriba el nombre" required="">
                          <br>
                          Correo del administrador:<br>
                          <input type="email" name="correoAdmi" placeholder="Escriba el correo" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Formato de Correo Invalido" required="">
                          <br>
                          Usuario:<br>
                          <input type="text" name="usuarioAdmi" placeholder="Escriba el usuario" required="">
                          <br>
                          Contraseña:<br>
                          <input type="password" name="contrasenia" placeholder="Escriba la contraseña" required="">
                          <br><br>
                          <input style="width: 13%;" type="submit" class="GuardarAdministrador" value="Guardar">
                    </form>
                </div>
                <div id="CerrarSesion">
					<p> Cerrar Sesion</p>
				</div>
            </div>
            <?php include 'template/footer.php';?>
    </body>
</html>