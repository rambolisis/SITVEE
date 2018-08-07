<?php
    SESSION_START();

    if(isset($_SESSION['usuario'])){
            if($_SESSION['usuario']['rol'] != "Administrador"){
                header("Location: userMenu.php");
            }
        }else{
            header('Location: index.php');
        }
 ?>
<title>Administrador</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="js/menu.js" type="text/javascript"></script>
<link rel="stylesheet" href="./css/style.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
</head>
<?php include('template/header.php'); ?>
            <div style="height: 73%">
            	<div class="vertical-menu">
				  <a id="Home">Inicio</a>
				  <a id="NewEvent">Nuevo Evento</a>
				  <a id="NewClient">Nuevo Cliente</a>
                  <a id="NewStaff">Nuevo Staff</a>
				  <a id="UpdateEvent">Actualizar Evento</a>
                  <a id="UpdateClient">Actualizar Cliente</a>
                  <a id="UpdateStaff">Actualizar Staff</a>
                  <a id="Administrator">Nuevo Administrador </a>
                  <a href='salir.php'>Cerrar Sesion</a>
                </div>
				<div id="Inicio">
					<p> Inicio</p>
				</div>
				<div id="NuevoEvento">
                    <form class="formulario" action="regEvent.php" method="POST">                  
                                    Usuario del Evento:<br>
                                    <input type="text" name="usuarioEvento" placeholder="Digite el Nombre del usuario del evento" required="">
                                    <br>
                                    Fecha del Evento:<br>
                                    <input name="fechaEvento" type="date" max="2025-12-31" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> required="">
                                    <br>
                                    Nombre del Evento:<br>
                                    <input type="text" name="nombreEvento" placeholder="Digite el nombre del evento" required="">
                                    <br><br>
                                    <input type="submit" class="Guardar" value="Guardar">
                    </form> 					
				</div>
                <div id="NuevoCliente">
                    <form class="formulario" action="regClient.php" method="POST">          
                      Nombre del Cliente:<br>
                      <input type="text" name="nombreCliente" placeholder="Digite el Nombre del Cliente" required="">
                      <br>
                      Correo del Cliente:<br>
                      <input type="email" name="correoCliente" id="correoCliente" placeholder="Digite el correo del Cliente"  pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Formato de correo invalido" required="">
                      <br>
                      Nombre de Usuario:<br>
                      <input type="text" name="usuarioCliente" placeholder="Digite el Nombre de Usuario" required="">
                      <br>
                      Contraseña:<br>
                      <input type="password" name="contraseniaCliente" placeholder="Digite la contraseña" required="">
                      <br><br>
                      <input type="submit" class="Guardar" value="Guardar">
                    </form> 
                </div>
                <div id="NuevoStaff">
                    <form class="formulario" action="" method="post">    
                                    Buscar Evento:<br>
                                    <input type="search" class="buscarEvento" name="buscarEvento">
                                    <button>Buscar</button>    
                                    <br>                         
                                    Usuario:<br>
                                    <input type="text" name="usuarioStaff" placeholder="Digite el Nombre del usuario del Staff" required="">
                                    <br>
                                    Contraseña:<br>
                                    <input type="password" name="contraseniaStaff" placeholder="Digite la contraseña" required="">
                                    <br><br>
                                    <input type="submit" class="Guardar" value="Guardar">
                    </form> 					
				</div>
                <div id="ActualizarEvento">
                    <form class="formulario" action="" method="post">       
                          Busqueda por Nombre del Evento:<br>
                          <input type="search" class="buscarEvento" name="buscarEvento">
                          <button>Buscar</button>    
                          <br>                   
                          Usuario del Evento:<br>
                          <input type="text" name="usuarioEventoNuevo"  required="">
                          <br>
                          Fecha del Evento:<br>
                          <input name="fechaEventoNueva" type="date" max="2025-12-31" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> required="">
                          <br>
                          Nombre del Evento:<br>
                          <input type="text" name="nombreEventoNuevo"  required="">
                          <br><br>
                          <input type="submit" class="Guardar" value="Actualizar">
          </form>
                </div>
                <div id="ActualizarCliente">
                    <form class="formulario" action="" method="post">    
                      Busqueda por Nombre de Usuario:<br>
                      <input type="search" id="buscarCliente" name="buscarCliente">
                      <button>Buscar</button>    
                      <br>        
                      Nombre del Cliente:<br>
                      <input type="text" name="nombreNuevo" required="">
                      <br>
                      Correo del Cliente:<br>
                      <input type="email" name="Correo" id="correoNuevo"  required="">
                      <br>
                      Nombre de Usuario:<br>
                      <input type="text" name="usuarioNuevo"  required="">
                      <br>
                      Contraseña:<br>
                      <input type="password" name="contraseniaNueva" required="">
                      <br><br>
                      <input type="submit" class="Guardar" value="Actualizar">
                    </form> 
                </div>
                <div id="ActualizarStaff">
                    <form class="formulario" action="" method="post">    
                                    Buscar Usuario:<br>
                                    <input type="search" id="buscarUsuarioStaff" name="buscarUsuarioStaff">
                                    <button>Buscar</button>    
                                    <br>                         
                                    Usuario:<br>
                                    <input type="text" name="usuarioStaff" placeholder="Digite el Nombre del usuario del Staff" required="">
                                    <br>
                                    Contraseña:<br>
                                    <input type="password" name="contraseniaStaff" placeholder="Digite la contraseña" required="">
                                    <br>
                                    Evento:<br>
                                    <input type="text" name="Evento" placeholder="Digite el Nombre del Evento" required="">
                                    <br><br>
                                    <input type="submit" class="Guardar" value="Guardar">
                    </form> 					
				</div>
                <div id="Administrador">
                    <form class="formulario" action="regAdmi.php" method="POST">                  
                          Correo:<br>
                          <input type="email" name="correoAdmi" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Formato de Correo Invalido" required="">
                          <br>
                          Nombre:<br>
                          <input type="text" name="nombreAdmi" required="">
                          <br>
                          Usuario:<br>
                          <input type="text" name="usuarioAdmi" required="">
                          <br>
                          Contraseña:<br>
                          <input type="password" name="contrasenia" required="">
                          <br><br>
                          <input type="submit" class="Guardar" value="Guardar">
                    </form>
                </div>
                <div id="CerrarSesion">
					<p> Cerrar Sesion</p>
				</div>
            </div>
            <?php include('template/footer.php'); ?>
    </body>
</html>