/* Controlador de Ticket */

// funcion ejecuta acciones como Listado, recarga y busqueda de tickets con el nombre de la accion y el id del usuario
// Se envia una accion a este recurso, entra en el switch, se envia al recurso de clase la misma accion y se ejecuta el caso que tenga el nombre de la accion finalmente se retornan resultados al recurso inicial
function tickets(accion,Id){

	switch(accion){
		
		case 'list':
			// caso para listar y recargar tickets admin
			$.ajax({
				url:'../class/classTickets.php',
				beforeSend:function(){
					$("#IDTickets").fadeOut(500);
					IDTickets.innerHTML='<div class="spinner-grow" role="status"><span class="sr-only">Loading...</span></div>';}, // antes de que lo traigas, innerHTML es el contenido
			   success:function(datos){$('#IDTickets').html(datos);
			   $("#IDTickets").fadeIn(500);},
			})
		break;

		case 'list_user':
			// caso para listar y recargar tickets user
			$.ajax({
				url:'class/classTickets.php',
				beforeSend:function(){
					$("#IDTickets").fadeOut(500);
					IDTickets.innerHTML='<div class="spinner-grow" role="status"><span class="sr-only">Loading...</span></div>';}, // antes de que lo traigas, innerHTML es el contenido
			   success:function(datos){$('#IDTickets').html(datos);
			   $("#IDTickets").fadeIn(500);},
			})
		break;

		case 'buscar':
			// caso para busqueda de tickets admin
			datos=$("#formTickets").serialize();

			$.ajax({
 				url:'../class/classTickets.php',
 				type:"post",
 				data: datos,
 				
				success:function(datos){$('#IDTickets').html(datos)
 
 
			}})
		break;

		case 'buscar_user':
			// caso para busqueda de tickets user
			datos=$("#formTickets").serialize();

			$.ajax({
 				url:'class/classTickets.php',
 				type:"post",
 				data: datos,
 				
				success:function(datos){$('#IDTickets').html(datos)
 
 
			}})
		break;

		default: alert(accion + " en ticket.js " + "no ha sido programada");

	}

}