<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notificacion
 *
 * @author Renato Hormazabal <nato.ehv@gmail.com>
 */
class Notificacion {
    private $id;
    private $fecha;
    private $descripcion;
    private $idUsuario;
    private $idUsuarioNotifica;
    /**
     * variable la cual permite saber si $idUsuario
     * ya vio su notificacion
     * @var type 
     */
    private $vista;
    private $tipo;
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function getIdUsuarioNotifica() {
        return $this->idUsuarioNotifica;
    }

    public function setIdUsuarioNotifica($idUsuarioNotifica) {
        $this->idUsuarioNotifica = $idUsuarioNotifica;
    }

    public function getVista() {
        return $this->vista;
    }

    public function setVista($vista) {
        $this->vista = $vista;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }


}

?>
