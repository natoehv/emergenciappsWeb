<?php

include_once 'Sistema.php';
include_once 'Usuario.php';

$nombre = $_POST['fname'];
$apellido = $_POST['lname'];
$mail = $_POST['email'];
$telefono = $_POST['phone'];
$pass = $_POST['password'];
$repass = $_POST['repassword'];
if(!($nombre == "" || $apellido == "" || $mail == "" || $telefono == "" || $pass == "")){
    if($pass != $repass){
        /*
         * Ingresar Nuevamente contraseña
         */
        echo "<script>  alert('no cohincide pass');
                        window.locationf='register.php';</script>";
    }else{
        $control = Sistema::getInstancia();
        $usuario = new Usuario();
        $usuario->setApellido($apellido);
        $usuario->setContrasena($pass);
        $usuario->setCorreo($mail);
        $usuario->setNombre($nombre);
        $usuario->setNroTelefono("+569".$telefono);
        $control->saveUsuario($usuario);
        session_start();
        $_SESSION['usuario'] = $usuario;
        header ("Location: ../miEmergenciApps");      
    }
}else{
    //echo "error desde registrar.php";
    header ("Location: register.html");
}
?>