<title>Login</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/login.css">
<script src="js/login.js" type="text/javascript"></script>
<?php include('template/header.php'); ?>
            <form id="loginForm" action="validar.php" action="login.js" method="post">
                <h2>Bienvenido a Sitvee</h2>
                <input type="text" placeholder=" Usuario" name="usuario"/>
                <input type="password" placeholder=" Contraseña" name="clave"/>
                <input type="submit" value="Ingresar" />
            </form>
        <?php include('template/footer.php'); ?>
    </body>
</html>