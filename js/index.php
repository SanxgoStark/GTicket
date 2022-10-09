
<?

	if (isset($_POST['Nombre']) && $_POST['Apellido']) {
		// variables para almacenar lo enviado por post
		$nombre = $_POST['Nombre'];
		$apellido = $_POST['Apellido'];
		echo "Hola".$nombre," y tu apellido es ".$apellido;
	}
	
	// echo var_dump($_POST['nombre']);
	// echo $nombre;
	

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<script src="jquery-3.6.0.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

	<script>

		$(document).ready(function(){

			$('#btnguard').click(function(){
				// guarda todos los datos que tenga el formulario
				var datos = $('#frmajax').serialize();
				var nombre = document.getElementById('nombre').value;
		 		var apellido = document.getElementById('apellido').value;

		 		var ruta = "Nombre="+nombre+"&Apellido="+apellido;

		 		alert(nombre);
		 		alert(datos);
		 		// return false

		 		$.ajax({
		 		url: 'index.php',
		 		type:'POST', 
		 		data: ruta,
		 			
		 	})
		 	.done(function(res){
		 		 $('#respuesta').html(res);
		 		//console.log("done");
		 	})
		 	.fail(function(){
		 		console.log("error");
		 	})	

		 		// se agrega el return false para que la propidad submit del boton
		 		// no recargue el archivo con submit
		 		return false;

			});

		});

		 // function enviar(){
		 // 	// almacenando el valor de lo que el usuario vaya a introducir al input
		 // 	// se agrega el id que contiene el nombre
		 	

		 // 	// variable enviar en
		 // 	// almacenando las dos variables en una
		 // 	var dataEn = 'nombre='+nombre+'&apellido='+apellido;

		 // 	$.ajax({
		 // 		type:'POST', // sera enviado por post
		 // 		url: 'send.php', // archivo elcual va a recibir datos
		 // 		data: nombre,apellido, // se envia el contenido en una variable
		 // 		succes: function(resp){
		 		
		 // 			$('#respa').html(resp);
		 // 		}
		 // 	});
		 // 	return false;
		 // }

	</script>

	

	<!-- no puede haber 2 ids con el mismo nombre -->
<div>
	
	<form id="frmajax" method="POST">
		<input type="text" name="nombre" id="nombre">
		<input type="text" name="apellido" id="apellido">
		<input id="btnguard" type="button">
		
	</form>
</div>
	

	<div id="respuesta"></div>

</body>
</html>

