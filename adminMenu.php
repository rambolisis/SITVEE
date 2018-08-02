<title>Administrador</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="js/menu.js" type="text/javascript"></script>
<link rel="stylesheet" href="./css/style.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
 </head>
 <?php
    SESSION_START();

    if(isset($_SESSION['usuario'])){
            if($_SESSION['usuario']['rol'] != "Administrador"){
                header("Location: userMenu.php");
            }
        }else{
            header('Location: login.php');
        }
 ?>
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
                  <a id="Administrator">Administrador</a>
                  <a href='salir.php'>Cerrar Sesion</a>
                </div>
				<div id="Inicio">
					<p> Inicio</p>
				</div>
				<div id="NuevoEvento">
                    <form id="formulario" action="" method="post">                  
                                    Usuario del Evento:<br>
                                    <input type="text" name="usuarioEvento" placeholder="Digite el Nombre del usuario del evento" required="">
                                    <br>
                                    Fecha del Evento:<br>
                                    <input name="fechaEvento" type="date" required="">
                                    <br>
                                    Nombre del Evento:<br>
                                    <input type="text" name="nombreEvento" placeholder="Digite el nombre del evento" required="">
                                    <br><br>
                                    <input type="submit" id="Guardar" value="Guardar">
                    </form> 					
				</div>
                <div id="NuevoCliente">
                    <form id="formulario" action="" method="post">          
                      Nombre del Cliente:<br>
                      <input type="text" name="nombreCliente" placeholder="Digite el Nombre del Cliente" required="">
                      <br>
                      Correo del Cliente:<br>
                      <input type="mail" name="correo" id="correo" placeholder="Digite el correo del Cliente" required="">
                      <br>
                      Nombre de Usuario:<br>
                      <input type="text" name="usuario" placeholder="Digite el Nombre de Usuario" required="">
                      <br>
                      Contraseña:<br>
                      <input type="password" name="contrasenia" placeholder="Digite la contraseña" required="">
                      <br><br>
                      <input type="submit" id="Guardar" value="Guardar">
                    </form> 
                </div>
                <div id="NuevoStaff">
                    <form id="formulario" action="" method="post">    
                                    Buscar Evento:<br>
                                    <input type="search" id="buscarEvento" name="buscarEvento">
                                    <button>Buscar</button>    
                                    <br>                         
                                    Usuario:<br>
                                    <input type="text" name="usuarioStaff" placeholder="Digite el Nombre del usuario del Staff" required="">
                                    <br>
                                    Contraseña:<br>
                                    <input type="password" name="contraseniaStaff" placeholder="Digite la contraseña" required="">
                                    <br><br>
                                    <input type="submit" id="Guardar" value="Guardar">
                    </form> 					
				</div>
                <div id="ActualizarEvento">
                    <form id="formulario" action="" method="post">       
                          Busqueda por Nombre del Evento:<br>
                          <input type="search" id="buscarEvento" name="buscarEvento">
                          <button>Buscar</button>    
                          <br>                   
                          Usuario del Evento:<br>
                          <input type="text" name="usuarioEventoNuevo"  required="">
                          <br>
                          Fecha del Evento:<br>
                          <input name="fechaEventoNueva" type="date" required="">
                          <br>
                          Nombre del Evento:<br>
                          <input type="text" name="nombreEventoNuevo"  required="">
                          <br><br>
                          <input type="submit" id="Guardar" value="Actualizar">
          </form>
                </div>
                <div id="ActualizarCliente">
                    <form id="formulario" action="" method="post">    
                      Busqueda por Nombre de Usuario:<br>
                      <input type="search" id="buscarCliente" name="buscarCliente">
                      <button>Buscar</button>    
                      <br>        
                      Nombre del Cliente:<br>
                      <input type="text" name="nombreNuevo" required="">
                      <br>
                      Correo del Cliente:<br>
                      <input type="mail" name="Correo" id="correoNuevo"  required="">
                      <br>
                      Nombre de Usuario:<br>
                      <input type="text" name="usuarioNuevo"  required="">
                      <br>
                      Contraseña:<br>
                      <input type="password" name="contraseniaNueva" required="">
                      <br><br>
                      <input type="submit" id="Guardar" value="Actualizar">
                    </form> 
                </div>
                <div id="ActualizarStaff">
                    <form id="formulario" action="" method="post">    
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
                                    <input type="submit" id="Guardar" value="Guardar">
                    </form> 					
				</div>
                <div id="Administrador">
                    <form id="formulario" action="" method="post">                  
                          Administrador:<br>
                          <input type="text" name="administrador" required="">
                          <br>
                          Nombre:<br>
                          <input type="text" name="nombre" required="">
                          <br>
                          Usuario:<br>
                          <input type="text" name="usuario" required="">
                          <br>
                          Contraseña:<br>
                          <input type="password" name="contrasenia" required="">
                          <br><br>
                          <input type="submit" id="Guardar" value="Guardar">
                    </form>
                </div>
                <div id="CerrarSesion">
					<p> Cerrar Sesion</p>
				</div>
            </div>
            <?php include('template/footer.php'); ?>
    </body>
</html>