<title>Login</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/login.css">
<script src="js/jquery-3.3.1.min.js"></script>
<?php include('template/header.php'); ?>
        <div>
            <form action="validar.php" method="POST">
                <h2>Bienvenido a Sitvee</h2>
                <input type="text" name="usuario" placeholder=" Usuario">
                <input type="password" name="clave" placeholder=" Contraseña">
                <input type="submit" value="Iniciar Sesion">
            </form>         
        </div>
        <?php include('template/footer.php'); ?>
    </body>
</html>