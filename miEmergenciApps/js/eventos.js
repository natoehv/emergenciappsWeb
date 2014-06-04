$(document).on('ready',function(){
	/*
         * momento en que carga por primera vez la página
    $('#contactos').on('click',function(){});
    $('#selectorid').on('blur',function(){});
    $('#selectorid').on('dblclick',function(){});
    */

});
var eventos = (function() {
      console.log('Inicializa eventos');
      var variablePublica = "podria iniciar un widget aqui";
      //configuracion para blockUI
      var configuracion = ({css: {border: 'none', 
		        padding: '15px', 
		        backgroundColor: '#000', 
		        '-webkit-border-radius': '10px', 
		        '-moz-border-radius': '10px', 
		        opacity: .5, 
		        color: '#fff' },
                        message: 'Cargando...'});
      /*
	 * Inicia llamada ajax a 
	 */
      return {
        /**
         * Metodo encargado de cargar contenido
         */
        cargaContenido: function(tabla) {
            if(tabla=="contactos.php"){
		eventos.cargaContenedorContactos(tabla);
            }
        },
        
        cargaContenedorContactos: function(recurso){
            $(document).ajaxStart($.blockUI(configuracion)).ajaxStop($.unblockUI);
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
                         * Inicializa validaci�n formulario nuevo contacto
                         */

                        /*
                         * Inicializa accion botones
                         */
                            $('#agregarContacto').on('click',mostrarFormulario);
                        } 
            );
        },
        /**
         * 
         * @param {type} people
         * @returns {undefined}
         */
        vaciaTabla: function(tabla) {
          console.log('tabla ocultada');
        },
      };
    })();



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