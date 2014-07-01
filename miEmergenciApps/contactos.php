<?php 
	include_once '../logica/Sistema.php';
   	include_once '../logica/Usuario.php';
   	include_once '../logica/Contacto.php';
   	session_start();
   	$usuario = $_SESSION['usuario'];
   	if(isset($usuario)){
   		$prin = Sistema::getInstancia();
   		$resultado = $prin->getContactos($usuario->getNroTelefono());
   		
?>
        <div class='row'>
          <div class='col-lg-12'>
            <h1>Contactos <small>Administra tus amigos</small></h1>
            <ol class='breadcrumb'>
              <li><a href='index.php'><i class='fa fa-dashboard'></i> Inicio</a></li>
              <li class='active'><i class='fa fa-table'></i> Contactos</li>
            </ol>
            <div class='alert alert-info alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              Agrega, elimina y modifica tus contactos, invita a tus amigos y mantente seguro con emergenciApps en tu celular y tu navegador preferido.
            </div>
          </div>
        </div><!-- /.row -->

        <div class='row'>
          <div class='col-lg-12'>
            <h2>Tabla de contactos 
            <button type="button" class="btn btn-primary btn-lg" id="agregarContacto">Agregar Contacto</button>
            <button id="btnGuardarCambios" type="button" class="btn btn-success disabled">Guardar</button>
            </h2>
            <div class='table-responsive'>
              <table id="tabla_contactos" class='table table-bordered table-hover table-striped tablesorter'>
                <thead>
                  <tr>
                    <th class="header">N° Teléfono <i class='fa fa-sort'></i></th>
                    <th class="header">Nombre <i class='fa fa-sort'></i></th>
                    <th class="header">Apellidos <i class='fa fa-sort'></i></th>
                    <th class="header">Fecha Agregado <i class='fa fa-sort'></i></th>
   					<th class="header">Favorito</i></h>
                    <th class="header">Acción</th>
                  </tr>
                </thead>
                <tbody id="tbody">
   	<?php 	
   //Buscar contactos he insertar
   	if($resultado == null){
   		echo "<tr><td colspan='1' class='text-center' >todavía no haz agregado niun contacto</td>
                    <td colspan='1' class='text-center' >todavía no haz agregado niun contacto</td>
                    <td colspan='1' class='text-center' >todavía no haz agregado niun contacto</td>
                    <td colspan='1' class='text-center' >todavía no haz agregado niun contacto</td>
                    <td colspan='1' class='text-center' >todavía no haz agregado niun contacto</td>
                    <td colspan='1' class='text-center' >todavía no haz agregado niun contacto</td>
</tr>";
   	}else{
	   foreach ($resultado as $contacto){
			// Se obtiene estado del contacto
	   		echo "<tr class='".$prin->getEstadoContacto($contacto->getEstado())."' >";
	   		echo "<td>".$contacto->getNroContacto()."</td>";
	   		//Si el estado es > 0, entonces se pueden mostrar los siguientes datos
	   		if($contacto->getEstado()>0){
                            //Obtengo contaacto
				$contacto2 = $prin->getUsuarioPorTelefono($contacto->getNroContacto());
				echo "<td>".$contacto->getNombre()." )".$contacto2->getNombre().")</td>";
				echo "<td>".$contacto2->getApellido()."</td>";
				echo "<td>".$contacto2->getFecha()."</td>";                              
			}else{
                            echo "<td>".$contacto->getNombre()."</td>";
                            echo "<td></td>";
                            echo "<td>".$contacto->getFecha()."</td>";
                        }
                        $checked = "";
                        if($contacto->getFavorito()==1) $checked = "checked";
                        echo "<td><input type='checkbox' id='".$contacto->getNroContacto()."' ".$checked."/> </td>";
                        echo "<td><button type='button' id='".$contacto->getNroContacto()."' class='btn btn-warning'>Modificar</button>";
                        echo "<button type='button' id='".$contacto->getNroContacto()."' class='btn btn-danger'>Eliminar</button></td></tr>";
	   }
   	}
   echo "
                </tbody>
              </table>
            		
            </div>
          </div>
          
        </div><!-- /.row -->

       
          
        </div><!-- /.row -->
   		

   <div class='container' style='display:none; cursor:default'>
	   <legend>Nuevo Contacto</legend>
	   <div class='well'>
	   <form id='signup' class='form-horizontal' style='cursor:default;' onSubmit='return false;'>
		   <legend style='color: white;'>Nuevo Contacto</legend>
		   <div class='control-group'>
			   <div class='controls'>
				   <div class='input-prepend'>
					   <span class='add-on'><i class='icon-user'></i></span>
					   <input type='text' class='form-control' id='nombre' name='nombre' placeholder='Nombre'>
				   </div>
			   </div>
		   </div>
		   <div class='control-group'>
                         <div class='controls'>
                             <div class='input-group'>
                                 <span class='input-group-addon'>+569</span>
                                 <input class='form-control' maxlength='8'type='number' id='nroTelefono' name='nroTelefono' placeholder='N° Telefonico'>
                             </div>
                         </div>
                   </div>
		   <div class='control-group'>
			   <div class='controls'>
				   <div class='input-prepend'>
					   <span class='add-on'><i class='icon-envelope'></i></span>
					   <input type='text' class='form-control' id='email' name='email' placeholder='Email'>
				   </div>
			   </div>
		   </div>
		  
		   
		   <div class='control-group'>
		   <label class='control-label'></label>
				<div class='controls'>
			   		<button onClick='contacto.validaDatosContacto();' class='btn btn-success' >Agregar Contacto</button>
			   	</div>
		   
		   </div>
	   
	   </form>
	   
	   </div>
   </div>
              		";
   }else{
	echo "<script>alert('No haz iniciado sesión, debes iniciar sesión para administrar tu cuenta.');</script>";
	header ("Location: ../");
   }
        ?>