<?php
include_once '../persistencia/UsuarioDAO.php';
include_once '../persistencia/ContactoDAO.php';



    class Sistema{
        
        private static $miInstancia=NULL;
        private $usuario;
        private $contacto;
        //private $cajero;

        private function Sistema(){
            $this->usuario = new UsuarioDAO();
            $this->contacto = new ContactoDAO();
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
		
		public function getUsuario($usuario){
			$usuarioAux = $this->usuario->getUsuario($usuario);
			/*
			$contrasenaMD5 = md5($cuenta->getContrasena())
			if($contrasenaMD5 == $cuentaAux->getContrasena())
				return $cuentaAux;
				*/
			if($usuario->getContrasena() == $usuarioAux->getContrasena())
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
    }
?>
