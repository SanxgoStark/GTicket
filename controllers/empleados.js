/* Controlador de Empleado */

// funcion ejecuta accione busqueda de empleados con el nombre de la accion y el id del usuario
// Se envia una accion a este recurso, entra en el switch, se envia al recurso de clase la misma accion y se ejecuta el caso que tenga el nombre de la accion finalmente se retornan resultados al recurso inicial 
function empleados(accion,Id){

	switch(accion){

		case 'buscar':
			// caso para busqueda de empleados admin
			datos=$("#formEmpleados").serialize();

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