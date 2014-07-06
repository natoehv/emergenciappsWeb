<?php

include_once('Conexion.php');
include_once('../logica/Usuario.php');
include_once '../logica/Usuario.php';


class UsuarioDAO{
    
    private $cone;
    
    public function UsuarioDAO(){
            $this->cone= new Conexion();
    }
    
    public function save($usuario){
        $link=$this->cone->obtenerConexion();
        $laConsulta="INSERT into usuario (nombre, apellidos, correo, contrasena, nro_telefono ) VALUES 
            ('".$usuario->getNombre()."','".$usuario->getApellido()."','".$usuario->getCorreo()."','".$usuario->getEncriptada()."','".$usuario->getNroTelefono()."');";
        mysql_query($laConsulta,$link)or 
                die("<script>alert('No fue posible insertar usuario en base de datos')</script>
            $laConsulta");
        mysql_close($link);
    }
    public function getUsuario($usuario){
           $link=$this->cone->obtenerConexion();
           $laConsulta="	SELECT 	*
                                           FROM	usuario
                                           WHERE	correo='".$usuario->getCorreo()."';";
           $resultado = mysql_query($laConsulta,$link)or die("<script>alert('No fue posible obtener usuario de base de datos')</script>");
           $row = mysql_fetch_array($resultado);
           if(count($row)>0){
           $usuario = new Usuario();
           $usuario->setCorreo($row['correo']);
           $usuario->setContrasena($row['contrasena']);
           $usuario->setNroTelefono($row['nro_telefono']);;
           $usuario->setApellido($row['apellidos']);
           $usuario->setNombre($row['nombre']);
           return $usuario;
           }else{
                   return null;
           }
    }
    
    public function findByExample($usuario){
        $link=$this->cone->obtenerConexion();
        $laConsulta = " SELECT * FROM predio";
        $conector = "WHERE";
        /*
         * Verifico valores que vienen en el ejemplo
         */
        if($usuario->getCorreo() != ""){
            $laConsulta = $laConsulta." ".$conector." ID_PREDIO = $usuario->getCorreo()";
            $conector  = "AND";
        }
            
        if($usuario->getContrasena() != ""){
            $laConsulta = $laConsulta." ".$conector." NOMBRE = $usuario->getContrasena()";
            $conector  = "AND";
        }
        $resultado = mysql_query($laConsulta,$link)or die("<script>alert('No fue posible obtener usuario de base de datos')</script>");
           $row = mysql_fetch_array($resultado);
           if(count($row)>0){
           $usuario = new Usuario();
           $usuario->setCorreo($row['correo']);
           $usuario->setContrasena($row['contrasena']);
           $usuario->setNroTelefono($row['nro_telefono']);;
           $usuario->setApellido($row['apellidos']);
           $usuario->setNombre($row['nombre']);
           return $usuario;
           }else{
                   return null;
           }
        
    }
    public function getUsuarioPorNro($nro){
            $link=$this->cone->obtenerConexion();
            $laConsulta="	SELECT 	*
                                            FROM	usuario
                                            WHERE	correo='".$nro."';";
            $resultado = mysql_query($laConsulta,$link)or die("<script>alert('No fue posible obtener usuario de base de datos')</script>");
            while($row = mysql_fetch_array($resultado)){
                    $usuario = new Usuario();
                    $usuario->setCorreo($row['correo']);
                    $usuario->setNroTelefono($row['nro_telefono']);;
                    $usuario->setApellido($row['apellidos']);
                    $usuario->setNombre($row['nombre']);
            }
            return $usuario;
    }
		
	
    
    
}
?>
