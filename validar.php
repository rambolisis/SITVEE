<?php
$usuario=$_POST['usuario'];
$clave=$_POST['clave'];
if($usuario=="admin" && $clave=="admin"){
    header("location:importarEmpleados.php");
}else{
    return header("location:login.php");
    echo "Credenciales invalidas";
}
?>