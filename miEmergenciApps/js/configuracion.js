var configuracion = (function() {
    console.log('Inicializa eventos configuracion');
    var configuracion = ({css: {border: 'none', 
		        padding: '15px', 
		        backgroundColor: '#000', 
		        '-webkit-border-radius': '10px', 
		        '-moz-border-radius': '10px', 
		        opacity: .5, 
		        color: '#fff' },
                        message: 'Cargando...'});
    return {
        cargaContenido: function() {
            $(document).ajaxStart($.blockUI(configuracion)).ajaxStop($.unblockUI);
            $( "#page-wrapper" ).load( 'configuracion.php', 
                        function (){
                            $('#nav_izq li').removeClass('active');
                            $('#li_configuracion').addClass('active');
                        } 
            );
        },
    }
})();


