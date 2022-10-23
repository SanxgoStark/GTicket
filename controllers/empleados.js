var ventana;
var estado = false;



function empleados(accion,Id){
	//console.log('entre controlador');
	switch(accion){
		
		case 'addCanasta':
			alert(accion);
			// agregar producto a canasta (grafico y en session)
			datos= "accion=" + accion +
			       "&Id=" + Id;

			$.ajax({
 				url:'../class/classNewventa.php?',
 				type:"POST",
 				data: datos,
				success:function(datos){

					$('#tCanasta').append(datos); 
 					// $('#total').html(datos);
			}})

		break;

		case 'buscar':
			
			// datos={'producto':$("#Producto").val(),'accion':accion}; // forma numero 1
			datos=$("#formEmpleados").serialize(); // forma numero 2

			$.ajax({
 				url:'../class/classEmpleados.php',
 				type:"post",
 				data: datos,
 				
				success:function(datos){$('#IDEmpleados').html(datos)
 
 
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

		default: alert(accion + "en venta.js " + "no ha sido programada");

	}

}