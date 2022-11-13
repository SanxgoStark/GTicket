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

		// caso de accion despliegue de productos
		case 'despProductos':
			$.ajax({
 				url:'../class/classNewventa.php',
 				beforeSend:function(){
 					$("#IDproductos").fadeOut(1500);
 					IDproductos.innerHTML='<div class="spinner-grow" role="status"><span class="sr-only">Loading...</span></div>';}, // antes de que lo traigas, innerHTML es el contenido
				success:function(datos){$('#IDproductos').html(datos);
				$("#IDproductos").fadeIn(1500);}, // se activa cuando el  recurso del url ya regreso
 
 
			})
			// console.log("pase");
		break;

		// caso de accion despliegue de productos
		case 'cancelVenta':

			accion = "accion=" + "cancelVenta";
			
			$.ajax({
 				url:'../class/classNewventa.php',
 				type:"post",
 				data: accion,
 				
				success:function(datos){

					$("#tCanasta").remove();
					document.getElementById("total").innerHTML = 0.00;
					document.getElementById("pago").innerHTML = 0;
					document.getElementById("cambio").innerHTML = 0;

				
					$.alert({
   						 title: 'Venta Cancelada!',
   						 
					});
					// $('#tCanasta').html(datos);
			}});
			console.log("pase");

			// ventana = $.confirm({
			//     title: 'Cancelacion venta',
			//     content: '' +
			//     '<form action="" class="formName">' +
			//     '<div class="form-group">' +
			//     '<label>PIN CANCELACION</label>' +
			//     '<input type="text" placeholder="PIN" class="name form-control" required />' +
			//     '</div>' +
			//     '</form>',
			//     buttons: {
			//         formSubmit: {
			//             text: 'aceptar',
			//             btnClass: 'btn-blue',
			//             url:'../class/classNewventa.php',
 		// 				type:"post",
 		// 				data: "pin="+this.$content.find('.pin').val(),
			//             action: function () {
			//                 var pin = this.$content.find('.pin').val();
			//                 if(!pin){
			//                     $.alert('por favor ingrese un pin');
			//                     return false;
			//                 }
			//                 $.alert('Your name is ' + name);
			//             }
			//         },
			//         cancel: function () {
			//             //close
			//         },
			//     },
			//     onContentReady: function () {
			//         // bind to events
			//         var jc = this;
			//         this.$content.find('form').on('submit', function (e) {
			//             // if the user submits the form by pressing enter in the field.
			//             e.preventDefault();
			//             jc.$$formSubmit.trigger('click'); // reference the button and click it
			//         });
			//     }
			// });
		break;

		case 'doVenta':

			// calculo de cambio
        	 var pago = Number.parseInt(document.getElementById("pago").value);
        	 var t = Number.parseInt(document.getElementById("total").innerHTML);
        	 console.log(pago);
        	 console.log(t);

         	var cambio = pago - t;
         	document.getElementById("cambio").value = cambio;
         	///////////////////////////////////

         	// return false;
			// accion a realizar en el php
			accion = "accion=" + "doVenta";
			
			$.ajax({
 				url:'../class/classNewventa.php',
 				type:"post",
 				data: accion,
 				
				success:function(datos){

					$("#tCanasta").remove();
					document.getElementById("total").innerHTML = 0.00;
					document.getElementById("pago").value = 0;
					// document.getElementById("cambio").value = 0;
	
				
					$.alert({
   						 title: 'Venta exitoza!',
   						 content: datos,
					});
					// $('#tCanasta').html(datos);
			}});

		break;

		default: alert(accion + " en ticket.js " + "no ha sido programada");

	}

}