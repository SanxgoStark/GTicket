//var ventana;
//var estado = false;

// si se agrega un nuevo case y el navegador no lo detecta, borrar datos de navegacion del navegador actual

function tickets(accion,Id){
	//console.log('entre controlador');
	switch(accion){
		
		case 'list':

			$.ajax({
				url:'../class/classTickets.php',
				beforeSend:function(){
					$("#IDTickets").fadeOut(500);
					IDTickets.innerHTML='<div class="spinner-grow" role="status"><span class="sr-only">Loading...</span></div>';}, // antes de que lo traigas, innerHTML es el contenido
			   success:function(datos){$('#IDTickets').html(datos);
			   $("#IDTickets").fadeIn(500);}, //se ejecuta despeus de regresar
			})
		break;

		case 'buscar':
			
			// datos={'producto':$("#Producto").val(),'accion':accion}; // forma numero 1
			datos=$("#formTickets").serialize(); // forma numero 2

			$.ajax({
 				url:'../class/classTickets.php',
 				type:"post",
 				data: datos,
 				
				success:function(datos){$('#IDTickets').html(datos)
 
 
			}})
		break;

		default: alert(accion + " en ticket.js " + "no ha sido programada");

	}

}