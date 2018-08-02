<title>Login</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/login.css">
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/validar.js"></script>
<?php
    SESSION_START();

    if(isset($_SESSION['usuario'])){
        if($_SESSION['usuario']['rol'] == "Administrador"){
            header('Location: adminMenu.php');
        }else if($_SESSION['usuario']['rol'] == "Usuario"){
            header('Location: userMenu.php');
        }
    }
?>
<?php include('template/header.php'); ?>
        <div class="error">
            <span>Credenciales invalidas, Por favor inténtelo de nuevo</span>
        </div>
        <div class="main">
            <form action="" id="formlg">
                <h2>Bienvenido a Sitvee</h2>
                <input type="text" name="usuario" placeholder=" Usuario" pattern="[A-Za-z0-9_-]{1,15}" required/>
                <input type="password" name="clave" placeholder=" Contraseña" pattern="[A-Za-z0-9_-]{1,15}" required/>
                <input type="submit" class="botonLogin" value="Iniciar Sesion"/>
            </form>         
        </div>
        <?php include('template/footer.php'); ?>
    </body>
</html>