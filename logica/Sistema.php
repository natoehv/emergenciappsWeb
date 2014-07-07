<?php
include_once '../persistencia/UsuarioDAO.php';
include_once '../persistencia/ContactoDAO.php';
include_once '../persistencia/NotificacionDAO.php';
include_once 'Notificacion.php';



    class Sistema{
        
        private static $miInstancia=NULL;
        private $usuario;
        private $contacto;
        private $notificacion;

        private function Sistema(){
            $this->usuario = new UsuarioDAO();
            $this->contacto = new ContactoDAO();
            $this->notificacion = new NotificacionDAO();
       }
        
        public static function  getInstancia(){
            if (self::$miInstancia == NULL) {
              self::$miInstancia = new Sistema();
            }
            return self::$miInstancia;
        }
        public function saveUsuario($usuario){
            $this->usuario->save($usuario);
        }
	
        public function saveContacto($contacto){
            session_start();
            $usuario = $_SESSION['usuario'];
            $this->contacto->save($contacto);
            $noti  = new Notificacion();
            $noti->setDescripcion("El usuario ".$usuario->getNombre()." te ha agregado como contacto");
            $noti->setIdUsuario($contacto->getNroContacto()); // A quien notifica
            $noti->setIdUsuarioNotifica($contacto->getNroUsuario()); //quien notifica
            $noti->setTipo(0);
            $noti->setVista(0);
            $this->notificacion->save($noti);
        }
        public function getUsuario($usuario){
                $usuarioAux = $this->usuario->getUsuario($usuario);
                if($usuario->getEncriptada() == $usuarioAux->getContrasena())
                        return $usuarioAux;
        }
        // Funcion encargada de obtener los contactos de un usuario
        public function getContactos($nro){
                return $this->contacto->getContactosConNro($nro);
        }
        // Retorna si es activo, success, warning o danger
        public function getEstadoContacto($estado){
                switch ($estado){
                        case 0: return "warning";
                        case 1: return "success";
                        case 2: return "";
                        default: return "";
                }
        }
        //obtener datos de usuario por su nro_telefono
        public function getUsuarioPorTelefono($nro){
                return $this->usuario->getUsuarioPorNro($nro);
        }
        /*
         * Obtiene numero de contactos en cuenta
         */
        public function getCantidadContactos($nro){
                return $this->contacto->getNroContactos($nro);
        }

        public function agregaNuevoContacto($idUsuario, $contacto){
            //retorna error o correcto
            return $this->contacto->ingresaNuevo($idUsuario, $contacto);
        }
        public function findAllNotifications($usuario){
            return $this->notificacion->findAll($usuario);
        }
        
        public function findNewNotifications($usuario){
            return $this->notificacion->findNews($usuario);
        }
    }
?>
