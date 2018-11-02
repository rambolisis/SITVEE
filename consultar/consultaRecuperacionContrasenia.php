<?php
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer(true);

//Método con str_shuffle() 
function generateRandomString($length = 10) { 
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
}

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    require '../conexion.php';

    $mysqli->set_charset('utf8');

    $emailConsulta = $mysqli->real_escape_string($_POST['correoClienteSolicitudContrasenia']);
    $clienteExiste = $mysqli->query("SELECT u.id_Usuario, u.usuario, c.nombreCliente 
    FROM cliente c 
    INNER JOIN usuario u 
    ON c.id_Usuario = u.id_Usuario
    WHERE correo = '$emailConsulta' ");

    if($clienteExiste->num_rows == 1){
        $datos = $clienteExiste->fetch_assoc();
        $idUsuario = $datos['id_Usuario'];
        $usuario = $datos['usuario'];
        $nombreCliente = $datos['nombreCliente'];
        $claveNueva = generateRandomString();
        $usuarioPerfil = $mysqli->query("UPDATE usuario SET clave = '$claveNueva' WHERE id_Usuario = '$idUsuario' ");
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mx1.hostinger.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'invitacion@sitvee.com';                 // SMTP username
            $mail->Password = 'sitvee123Admin';                           // SMTP password
            $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;
        } catch (Exception $e) {
            echo 'Error a conectarse al servidor de correo', $mail->ErrorInfo;
            echo json_encode(array('mensaje' => true));
        }
        try{
            //Recipients
            $mail->setFrom('invitacion@sitvee.com', 'SITVEE');
            $mail->addAddress($emailConsulta);   // Add a recipient
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Recuperación de Contraseña';
            $mail->Body = 'Buenas '.$nombreCliente.'<br><br>

            Este correo ha sido enviado ya que solicitó una nueva contraseña para ingresar a su cuenta <br><br> 
            
            Su usuario es: '.$usuario.' <br>
            Su nueva contraseña es: '.$claveNueva.' <br><br>

            Le recordamos que es muy importante que cambie esta contraseña generica para evitar cualquier problema de seguridad. Esto lo puede hacer en la sección de "Mi Perfil" en la página de Sitvee <br><br>

            Gracias';
            $mail->send();
            $mail->clearAllRecipients();
        } catch (Exception $e) {
            echo 'Correo no enviado. Mailer Error: ', $mail->ErrorInfo;
            echo json_encode(array('mensaje' => true));
        }
        echo json_encode(array('mensaje' => false));
    }else{
        echo json_encode(array('mensaje' => true));
    }


}

$mysqli->close();

?>