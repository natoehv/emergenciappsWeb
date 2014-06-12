<?php
class Contacto{
	private $nro_telefono_usuario;
	private $nro_telefono_contacto;
	private $id_contacto;
	private $estado;
	private $favorito;
	private $fecha;
	private $correo;
	private $nombre;

	function _construct(){}

	public function getNroUsuario() {
		return $this->nro_telefono_usuario;
	}
	public function setNroUsuario($nro) {
		$this->nro_telefono_usuario = $nro;
	}
	public function getNroContacto() {
		return $this->nro_telefono_contacto;
	}
	public function setNroContacto($nro) {
		$this->nro_telefono_contacto = $nro;
	}
	public function getIdContacto() {
		return $this->$nro_telefono_usuario;
	}
	public function setIdContacto($id) {
		$this->id_contacto = $id;
	}
	public function getEstado() {
		return $this->estado;
	}
	public function setEstado($estado) {
		$this->estado = $estado;
	}
	public function getFavorito() {
		return $this->favorito;
	}
	public function setFavorito($fav) {
		$this->favorito = $fav;
	}
	public function getFecha() {
		return $this->fecha;
	}
	public function setFecha($fecha) {
		$this->fecha = $fecha;
	}
	public function getNombre() {
		return $this->nombre;
	}
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}
	public function getCorreo() {
		return $this->nro_telefono_usuario;
	}
	public function setCorreo($correo) {
		$this->correo = $correo;
	}
}

?>