<?php
class Conexion{

function _construct(){}

public function obtenerConexion(){

$link = mysql_connect("localhost","root","nato123");
mysql_select_db("emergenciapps",$link);

return $link;
}

}

?>
