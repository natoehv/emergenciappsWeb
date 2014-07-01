<?php
include_once '../logica/Sistema.php';
include_once '../logica/Contacto.php';
session_start();
$usuario =  (object) $_SESSION['usuario'];
$nombre = $_POST['nombre'];
$correo = $_POST['email'];
$nroContacto = $_POST['nroTelefono'];
$contacto = new Contacto();
$contacto->setCorreo($correo);
$contacto->setEstado(0);
$contacto->setFavorito(0);
$contacto->setNombre($nombre);
$contacto->setNroUsuario($usuario->getNroTelefono());
$contacto->setNroContacto("+569".$nroContacto);

$control = Sistema::getInstancia();
$control->saveContacto($contacto);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
