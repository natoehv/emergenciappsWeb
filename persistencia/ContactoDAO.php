<?php

include_once('Conexion.php');
include_once('../logica/Contacto.php');

class ContactoDAO{
    
    private $cone;
    
    public function ContactoDAO(){
            $this->cone= new Conexion();
    }
    
    public function ingresarContactoDAO($contacto){
    	//TODO falta arreglar
        $resultado="Correcto";
        $link=$this->cone->obtenerConexion();
        $laConsulta="INSERT into contacto (nro_telefono_contacto, nro_telefono_usuario, fecha_ingreso, estado, favorito, correo, nombre ) VALUES 
            (".$contacto->getNroContacto().",'".$contacto->getNroUsuario()."','sysdate()','0','0','".$contacto->getCorreo()."','".$contacto->getNombre()."');";
        mysql_query($laConsulta,$link)or die($resultado = "error");
        mysql_close($link);
        return $resultado;
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
				$contacto->setIdContacto($row['ID_CONTACTO']);;
				$contacto->setFecha($row['fecha_ingreso']);
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
