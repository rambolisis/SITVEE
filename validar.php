<?php
$usuario=$_POST['usuario'];
$clave=$_POST['clave'];
if($usuario=="admin" && $clave=="admin"){
    return header("location:adminMenu.php");
}else if($usuario=="usuario" && $clave=="usuario"){
    return header("location:userMenu.php");
}else{
    echo "<script>
                alert('Credenciales Invalidas');
                window.location= 'login.php'
        </script>";
}
?>