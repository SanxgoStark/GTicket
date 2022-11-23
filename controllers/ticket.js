// si se agrega un nuevo case y el navegador no lo detecta, borrar datos de navegacion del navegador actual
// borrar datos de navegacion chrome ctrl + shift + supr
// borrado de cache de chrome ctrl + bloq mayus + r

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
			   $("#IDTickets").fadeIn(500);},
			})
		break;

		case 'list_user':

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
			
			datos=$("#formTickets").serialize();

			$.ajax({
 				url:'../class/classTickets.php',
 				type:"post",
 				data: datos,
 				
				success:function(datos){$('#IDTickets').html(datos)
 
 
			}})
		break;

		case 'buscar_user':
			//alert("buscar_user");
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