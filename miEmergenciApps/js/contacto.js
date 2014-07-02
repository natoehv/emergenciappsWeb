$(document).on('ready',function(){
	/*
         * momento en que carga por primera vez la página
    $('#contactos').on('click',function(){});
    $('#selectorid').on('blur',function(){});
    $('#selectorid').on('dblclick',function(){});
    */

});
var contacto = (function() {
      console.log('Inicializa eventos contacto');
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
                            $('#tabla_contactos').dataTable(
                  {
		"sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-12'i><'col-lg-12 center'p>>",
		"sPaginationType": "bootstrap",
		"oLanguage": {
			"sLengthMenu": "_MENU_ Resultados por página"
		}
	}
                  
                  );
//                            .tablesorter({
//                                widthFixed: true,
//                                widgets: ['zebra']
//                            });
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
        
        validaDatosContacto: function(){
            nombre = $("#nombre").val();
            nroTelefono = $("#nroTelefono").val();
            email = $("#email").val();
            console.log('Ingresando contacto: ' + nombre);
            var datos = 'nombre='+ nombre + '&nroTelefono=' + nroTelefono + '&email=' + email;
            if(nombre == ""){
                $("#nombre").focus();
                console.error("Error en nombre");
            }else{
                if(nroTelefono.length != 8){
                    $("#nroTelefono").focus();
                    console.error("Error en nroTelefono");
                }
                else{
                    if(!contacto.validarMail(email)){
                        $("#email").focus();
                        console.error("Error en mail");
                    }else{
                        contacto.agregarContacto(datos);
                    }
                }
            }
        },
        
        validarMail: function(mail){
             if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(mail)){
                return true;
             }else{
                return false;
             }
        },
                
        agregarContacto: function(datos){
            console.log('Cargando nuevo contacto');
            
            $.ajax({
                type: "POST",
                url: "agregaContacto.php",
                data: datos,
                success: function(response) {
                    console.log("Ajax ejecutado correctamente (Agregar nuevo contacto "+response +")");
                    //TODO mensaje contacto agregado
                    
                    contacto.cargaContenido('contactos.php');
                    
                   
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