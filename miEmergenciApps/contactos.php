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
            <button type="button" class="btn btn-success disabled">Guardar</button>
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
   		//echo "<tr><td colspan='6' class='text-center'>todavía no haz agregado niun contacto</td></tr>";
   	}else{
	   foreach ($resultado as $contacto){
			// Se obtiene estado del contacto
	   		echo "<tr class='.$prin->getEstadoContacto($contacto->getEstado()).' >";
	   		echo "<td>.$contacto->getNroContacto().</td>";
	   		//Si el estado es > 0, entonces se pueden mostrar los siguientes datos
	   		if($contacto->getEstado()>0){
				$contacto2 = $prin->getUsuarioPorTelefono($contacto->getNroContacto());
				echo "<td>.$contacto2->getNombre().</td>";
				echo "<td>.$contacto2->getApellido().</td>";
				echo "<td>.$contacto2->getFecha().</td>";
				echo "</tr>";
				//TODO Agregar checkbox con favorito
				//TODO Agregar botones de accion
			}
	   }
   	}
   echo "   <tr class='success'>
                    <td>+56983466538</td>
                    <td>Javier</td>
                    <td>Hermosilla</td>
            		<td>05/04/2014</td>
            		<td><input type='checkbox' value='+56983466538'></td>
            		<td>
            			<button type='button' class='btn btn-warning'>Modificar</button>
            			<button type='button' class='btn btn-danger'>Eliminar</button>
            		</td>
                  </tr>
                  <tr class='success'>
                    <td>/about.html</td>
                    <td>261</td>
                    <td>33.3%</td>
            		<td>05/04/2014</td>
            		<td><input type='checkbox' ></td>
            		<td>
            			<button type='button' class='btn btn-warning'>Modificar</button>
            			<button type='button' class='btn btn-danger'>Eliminar</button>
            		</td>
                  </tr>
                  <tr class='warning'>
                    <td>/sales.html</td>
                    <td>665</td>
                    <td>21.3%</td>
                    <td>05/04/2014</td>
            		<td><input type='checkbox'></td>
            		<td>
            			<button type='button' class='btn btn-warning'>Modificar</button>
            			<button type='button' class='btn btn-danger'>Eliminar</button>
            		</td>
                  </tr>
                  <tr class='danger'>
                    <td>/blog.html</td>
                    <td>9516</td>
                    <td>89.3%</td>
                    <td>05/04/2014</td>
            		<td><input type='checkbox'></td>
            		<td>
            			<button type='button' class='btn btn-warning'>Modificar</button>
            			<button type='button' class='btn btn-danger'>Eliminar</button>
            		</td>
                  </tr>
                </tbody>
              </table>
              <div id='pager' class='pager'>
					<form>
						<img src='../icons/first.png' class='first'/>
						<img src='../icons/prev.png' class='prev'/>
						<input type='text' class='pagedisplay'/>
						<img src='../icons/next.png' class='next'/>
						<img src='../icons/last.png' class='last'/>
						<select class='pagesize'>
							<option selected='selected'  value='10'>1</option>
							<option value='20'>20</option>
							<option value='30'>30</option>
							<option  value='40'>40</option>
						</select>
					</form>
				</div>
            		
            </div>
          </div>
          
        </div><!-- /.row -->

       
          
        </div><!-- /.row -->
   		

   <div class='container' id='contenedorNuevoContacto' style='display:none;'>
	   <legend>Sign Up</legend>
	   <div class='well'>
	   <form id='signup' class='form-horizontal' method='post' action='success.php'>
		   <legend style='color: white;'>Sign Up</legend>
		   <div class='control-group'>
			   <label class='control-label' style='color: white;'>Nombre</label>
			   <div class='controls'>
				   <div class='input-prepend'>
					   <span class='add-on'><i class='icon-user'></i></span>
					   <input type='text' class='input-xlarge' id='fname' name='fname' placeholder='Nombre'>
				   </div>
			   </div>
		   </div>
		   <div class='control-group '>
			   <label class='control-label' style='color: white;'>Número Telefónico</label>
				   	<div class='controls'>
					   	<div class='input-prepend'>
					   		<span class='add-on'><i class='icon-user'></i></span>
              				<label class='control-label' style='color: white;'>+</label>
              				<input maxlength='3' type='text' id='codA' name='codA' placeholder='569'>
					   		<input maxlength='8'type='number' class='input-xlarge' id='lname' name='lname' placeholder='N° Telefonico'>
				   		</div>
			   		</div>
		   	</div>
		   <div class='control-group'>
			   <label class='control-label' style='color: white;'>Email</label>
			   <div class='controls'>
				   <div class='input-prepend'>
					   <span class='add-on'><i class='icon-envelope'></i></span>
					   <input type='text' class='input-xlarge' id='email' name='email' placeholder='Email'>
				   </div>
			   </div>
		   </div>
		  
		   
		   <div class='control-group'>
		   <label class='control-label'></label>
				<div class='controls'>
			   		<button type='submit' class='btn btn-success' >Agregar Contacto</button>
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