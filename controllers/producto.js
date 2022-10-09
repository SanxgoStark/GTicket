function producto(accion){
	
	switch(accion){

		// caso de accion despliegue de productos
		case 'despProductos':
			$.ajax({
 				url:'../class/classNewventa.php',
 				beforeSend:function(){
 					$("#IDprodutos").fadeOut(2000);
 					IDproductos.innerHTML='<div class="spinner-grow" role="status"><span class="sr-only">Loading...</span></div>';}, // antes de que lo traigas, innerHTML es el contenido
				success:function(datos){$('#IDproductos').html(datos);
				 $("#IDproductos").fadeIn(2000);}, // se activa cuando el  recurso del url ya regreso

 	
			})
			// console.log("pase");
		break;

	}

}