<?php

include_once('Conexion.php');
include_once('../logica/Notificacion.php');
/**
 * Description of NotificacionDAO
 *
 * @author Renato Hormazabal <nato.ehv@gmail.com>
 */
class NotificacionDAO {
    
    private $cone;
    
    public function NotificacionDAO(){
            $this->cone= new Conexion();
    }
    
    public function save($noti){
        $link=$this->cone->obtenerConexion();
        $laConsulta="INSERT into notificacion (fecha, id_usuario, id_usuario_noti, vista, tipo, descripcion) VALUES 
            (sysdate(),'".$noti->getIdUsuario()."','".$noti->getIdUsuarioNotifica()."','".$noti->getVista()."','".$noti->getTipo()."','".$noti->getDescripcion()."');";
        mysql_query($laConsulta,$link)or die("ERROR AL AGREGAR Notificacion $laConsulta");
        mysql_close($link);
    }
    public function findAll($user){
        $link=$this->cone->obtenerConexion();
        $laConsulta="	SELECT 	*
                        FROM	notificacion
                        WHERE	id_usuario='".$user->getNroTelefono()."'
                        ORDER BY fecha;";
        $resultado = mysql_query($laConsulta,$link)or die("<script>alert('Error al consultar notificacion')</script>");
        $lista = array();
        while ($row = mysql_fetch_array($resultado)){
                        $notifi = new Notificacion();
                        $notifi->setDescripcion($row['descripcion']);
                        $notifi->setFecha($row['fecha']);
                        $notifi->setId($row['id']);
                        $notifi->setIdUsuario($row['id_usuario']);
                        $notifi->setIdUsuarioNotifica($row['id_usuario_noti']);
                        $notifi->setTipo($row['tipo']);
                        $notifi->setVista($row['vista']);
                        
                        $lista[] = $notifi;
        }
        return $lista;
    }
    
    public function findNews($user){
        $link=$this->cone->obtenerConexion();
        $laConsulta="	SELECT 	*
                        FROM	notificacion
                        WHERE	id_usuario='".$user->getNroTelefono()."'
                        AND     vista = 0
                        ORDER BY fecha;";
        $resultado = mysql_query($laConsulta,$link)or die("<script>alert('Error al consultar notificacion')</script>");
        $lista = array();
        while ($row = mysql_fetch_array($resultado)){
                        $notifi = new Notificacion();
                        $notifi->setDescripcion($row['descripcion']);
                        $notifi->setFecha($row['fecha']);
                        $notifi->setId($row['id']);
                        $notifi->setIdUsuario($row['id_usuario']);
                        $notifi->setIdUsuarioNotifica($row['id_usuario_noti']);
                        $notifi->setTipo($row['tipo']);
                        $notifi->setVista($row['vista']);
                        
                        $lista[] = $notifi;
        }
        return $lista;
    }
}

?>