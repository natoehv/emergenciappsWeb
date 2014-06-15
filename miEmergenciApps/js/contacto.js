$(document).on('ready',function(){
	/*
         * momento en que carga por primera vez la página
    $('#contactos').on('click',function(){});
    $('#selectorid').on('blur',function(){});
    $('#selectorid').on('dblclick',function(){});
    */

});
var contacto = (function() {
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
                $('#nav_izq li').removeClass('active');
                $('#li_contacto').addClass('active');
		contacto.cargaContenedorContactos(tabla);
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
                                var checkID = $(this).attr("id");
                                alert("ha seleccionado checkbox: "+checkID);
                                $('#btnGuardarCambios').removeClass('disabled');
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
        agregarContacto: function(){
            console.log('Cargando nuevo contacto');
            nombre = $("#nombre").val();
            codA = $("#codA").val();
            validacion_email = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
            nroTelefono = $("#nroTelefono").val();
            email = $("#email").val();
            console.log('Ingresando contacto: ' + nombre);
            var datos = 'nombre='+ nombre + '&codA=' + codA + '&nroTelefono=' + nroTelefono + '&email=' + email;
            $.ajax({
                type: "POST",
                url: "agregaContacto.php",
                data: datos,
                success: function(response) {
                    console.log("Ajax ejecutado correctamente (Agregar nuevo contacto "+response +")");
                    //TODO mensaje contacto agregado
                    
                    //contacto.cargaContenido('contactos.php');
                    
                   
                },
                error: function() {
                    console.log("Error al ejecutar AJAX (Agregar nuevo contacto)");
                    
                    $('#page-wrapper').html('Consulta mal hecha');
                                  
                }
            });
            return false;
        }
      };
    })();



function mostrarFormulario(){
	 $.blockUI({ 	message: $('#signup'),
                        onOverlayClick: $.unblockUI,
		 	css: { 
		                width: '350px', 
		                top: '50px', 
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