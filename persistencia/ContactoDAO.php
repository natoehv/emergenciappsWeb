<?php

include_once('Conexion.php');
include_once('../logica/contacto.php');

class ContactoDAO{
    
    private $cone;
    
    public function ContactoDAO(){
            $this->cone= new Conexion();
    }
    
    public function ingresarContactoDAO($contacto){
    	//TODO falta arreglar
        $link=$this->cone->obtenerConexion();
        $laConsulta="INSERT into contacto (nro_telefono_contacto, nro, nro_telefono ) VALUES 
            (".$contacto->getCorreo().",'".$contacto->getContrasena()."','".$contacto->getNroTelefono()."');";
        mysql_query($laConsulta,$link)or die("<script>alert('No fue posible insertar contacto en base de datos')</script>");
        mysql_close($link);
    }
	 public function getContactosConNro($nro){
		$link=$this->cone->obtenerConexion();
		$laConsulta="	SELECT 	*
						FROM	contacto
						WHERE	nro_telefono_usuario='".$nro."';";
		$resultado = mysql_query($laConsulta,$link)or die("<script>alert('Error al consultar contacto')</script>");
		$lista = array();
		while ($row = mysql_fetch_array($resultado)){
				$contacto = new Contacto();
				$contacto->setNroUsuario($row['nro_telefono_usuario']);
				$contacto->setNroContacto($row['nro_telefono_contacto']);
				$contacto->setIdContacto($row['id_contacto']);;
				$contacto->setFecha($row['fecha']);
				$contacto->setFavorito($row['favorito']);
				$contacto->setEstado($row['estado']);
				$contacto->setNombre($row['nombre']);
				$contacto->setCorreo($row['correo']);
				array_push($lista, $contacto);
		}
		if(empty($lista)){
			return null;
		}
		return $lista;
	}
	
	public function getNroContactos($nro){
		$link=$this->cone->obtenerConexion();
		$laConsulta="	SELECT 	count(*) as cantidad
						FROM	contacto, usuario
						WHERE	nro_telefono_usuario='".$nro."';";
		$resultado = mysql_query($laConsulta,$link)or die("<script>alert('Error al consultar contacto')</script>");
		$row = mysql_fetch_array($resultado);
		$cantidad = $row['cantidad'];
		return $cantidad;
	}
	public function getNroFavoritos($nro){
		$link=$this->cone->obtenerConexion();
		$laConsulta="	SELECT 	count(*) as cantidad
						FROM	contacto, usuario
						WHERE	nro_telefono_usuario='".$nro."'
						AND		favorito=1;";
		$resultado = mysql_query($laConsulta,$link)or die("<script>alert('Error al consultar contacto')</script>");
		$row = mysql_fetch_array($resultado);
		$cantidad = $row['cantidad'];
		return $cantidad;
	}
    
    
}
?>
