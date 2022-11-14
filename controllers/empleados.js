function empleados(accion,Id){
	//console.log('entre controlador');
	switch(accion){

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

		default: alert(accion + "en venta.js " + "no ha sido programada");

	}

}