<?php

include_once 'logica/Sistema.php';
include_once 'logica/Usuario.php';
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
        echo "<script>alert('no cohincide rut');</script>";
        header ("Location: register.php");
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
        header ("Location: miEmergenciApps");      
    }
}else{
    echo "error desde registrar.php";
    //header ("Location: register.html");
}
?>