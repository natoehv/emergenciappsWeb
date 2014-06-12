<?php
include_once '../logica/Sistema.php';
include_once '../logica/Contacto.php';
$nombre = $_POST['nombre'];
$codA = $_POST['codA'];
$correo = $_POST['email'];
$nroContacto = $_POST['nroTelefono'];
$contacto = new Contacto();
$contacto->setCorreo($correo);
$contacto->setEstado(0);
$contacto->setFavorito(0);
$contacto->setNombre($nombre);
$contacto->setNroContacto($codA ."".$nroContacto);

$control = Sistema::getInstancia();

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
