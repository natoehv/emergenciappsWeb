$(document).on('ready',function(){
	/*
    $('#contactos').on('click',function(){});
    $('#selectorid').on('blur',function(){});
    $('#selectorid').on('dblclick',function(){});
    */

});


function cargaContenido(recurso){
	if(recurso=="contactos.php"){
		cargaContenedorContactos(recurso);
	}
	
	
}

function cargaContenedorContactos(recurso){
	/*
	 * Configura  mensaje de espera 
	 */
	$(document).ajaxStart($.blockUI(
			{ css: {
		        border: 'none', 
		        padding: '15px', 
		        backgroundColor: '#000', 
		        '-webkit-border-radius': '10px', 
		        '-moz-border-radius': '10px', 
		        opacity: .5, 
		        color: '#fff' 
				} ,
			message: 'Cargando...'
			})).ajaxStop(	$.unblockUI);
	/*
	 * Inicia llamada ajax a 
	 */
	$( "#page-wrapper" ).load( recurso, 
		function (){
			/*
			 * configura tabla para ordenar luego de cargar el recurso
			 */
		$('#tabla_contactos')
	    .tablesorter({
	        widthFixed: true,
	        widgets: ['zebra']
	    });
		//Eventos para tabla 
		$('#tbody input').click(function(){
			alert("ha seleccionado checkbox: ");
		});
		/*
		 * Inicializa validación formulario nuevo contacto
		 */
		
		/*
		 * Inicializa accion botones
		 */
		$('#agregarContacto').on('click',mostrarFormulario);
		} 
	);
}

function mostrarFormulario(){
	 $.blockUI({ 	message: $('#signup'),
		 			onOverlayClick: $.unblockUI,
		 			css: { 
		                width: '350px', 
		                top: '10px', 
		                left: '', 
		                right: '10px', 
		                border: 'none', 
		                padding: '5px', 
		                backgroundColor: '#000', 
		                '-webkit-border-radius': '10px', 
		                '-moz-border-radius': '10px', 
		                opacity: .9, 
		               
		            } 
		 
	 }); 
	 
     
}