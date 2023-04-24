<?
session_start();// quiere almacenar info en el servidor

// se uso var_dump para verificar que si se recibierna los datos enviados por el formulario de login hacia verilogin
//var_dump($_POST);

// se almacena la conexion, para emtro de conexion (servidor,usuario,la clave,bd)
$EstatusConexion=mysqli_connect("localhost","root","","db_ticketsv2");

// verificacion de conexio, se pregunta sobre el estatus de la conexion
if($EstatusConexion==null){
	echo "no se pudo conectar";
}else{
	echo "si se pudo conectar";
}

// almacenamiento de consulta usuarios
$consulta="SELECT * FROM usuarios where nombre_usuario='".$_POST['usuario']."' and password_usuario=MD5('".$_POST['contraseña']."')   ";

// se almacena el bloque de registros que regresa la consulta y la conexion
$bloqueRegistros=mysqli_query($EstatusConexion,$consulta); 

// despliegue de resultados
echo mysqli_error($EstatusConexion); // despliega el error que se genera en caso de existir

// cierre de conexion
mysqli_close($EstatusConexion);


// cuantos registro tiene el bloque de registros
if(mysqli_num_rows($bloqueRegistros))
	{
		// se alamcena un registro del bloque
		$registro = mysqli_fetch_object($bloqueRegistros); 
		
		// se accede al nombre de usuario, id y rol mediante el registro y se alamcenan en variables
		$_SESSION['nombre_usuario'] = $registro->nombre_usuario;
		$_SESSION['id'] = $registro->id;
		$_SESSION['rol_id'] = $registro->rol_id;

		// se verifica el rol del usuario que esta ingresando y se redirige al recurso pertienente
		if ($_SESSION['rol_id'] == 2) { // 2 es admin
			header("location: admin/home_admin.php");
		}else{ // 1 es user
			header("location: home_user.php");	
		}

		
	}
else // los datos de identidficacion no corresponden
	
 	header("location: index.php?e=1"); // se manda a recuerso login

// si imprime 0 el registro no existe en base de datos
// si imprime 1 el restro existe en la base de datos

?>