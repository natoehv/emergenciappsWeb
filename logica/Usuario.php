<?php
class Usuario{
	private $correo;
	private $contrasena;
	private $nro_telefono;
	private $nombre;
	private $apellido;

	function _construct(){}

	public function getNombre() {
		return $this->nombre;
	}
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}
	public function getApellido() {
		return $this->nombre;
	}
	public function setApellido($apellido) {
		$this->apellido = $apellido;
	}
	public function getCorreo() {
		return $this->correo;
	}

	public function setCorreo($correo) {
		$this->correo = $correo;
	}

	public function getContrasena() {
		return $this->contrasena;
	}

	public function setContrasena($contrasena) {
		$this->contrasena = $contrasena;
	}


	public function getNroTelefono() {
		return $this->nro_telefono;
	}

	public function setNroTelefono($nro) {
		$this->nro_telefono = $nro;
	}




}
?>
