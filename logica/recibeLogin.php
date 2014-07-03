<?php
include_once 'Usuario.php';
include_once 'Sistema.php';
$correo = $_POST['email'];
$contrasena =$_POST['password'];

$usuario = new Usuario();
$usuario->setCorreo($correo);
$usuario->setContrasena($contrasena);
$user = $usuario;
$prin = Sistema::getInstancia();

$usuario = $prin->getUsuario($usuario);
if($usuario == null){
	echo "<script>alert('El nombre de usuario o contraseña es incorreto');</script>";
        header ("Location: ../");
}else{
	/*
	 * Se guardan los datos del usuario registrado en sesion
	 */
	session_start();
	$_SESSION['usuario'] = $usuario;
	header ("Location: ../miEmergenciApps");
}




?>