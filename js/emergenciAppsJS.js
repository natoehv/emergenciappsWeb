/* C�digo a ejecutarse tan pronto como la 
   p�gina ha sido cargada por el navegador */  
document.observe('dom:loaded', function()  
{  console.log("iniciacion de eventos");
    /* Asociar el evento de clic del bot�n 'igual' 
       con la l�gica del negocio de la aplicaci�n */  
    function eventos(){
	  this.login = function(){
			var formulario = $('form-inline').serialize();
			console.log(formulario);
			
			new Ajax.Request('../logica/recibeLogin.php', {
				parameters: $('form-inline').serialize(true),
				onSuccess: function(transport) {
					var response = transport.responseText || "ERROR";
					//ACTUALIZAR PAGINA
					alert("Success! \n\n" + response);
				}
			});
	  }
  
  
  }

});  

/*
 Event.observe('igual', 'click', procesar); 
*/