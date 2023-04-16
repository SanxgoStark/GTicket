<?
session_start();// quiere almacenar info en el servidor

// se uso var_dump para verificar que si se recibierna los datos enviados por el formulario de login hacia verilogin
var_dump($_POST);

// servidor,usuario,la clave,bd
$EstatusConexion=mysqli_connect("localhost","root","","db_ticketsv2");

// se pregunta sobre el estatus de la conexion
if($EstatusConexion==null){
	echo "no se pudo conectar";

	
}else{
	echo "si se pudo conectar";

}

// codigo sql
// $consulta = "SELECT * FROM usuario where Email='".$_POST['email']."' and Clave=password('".$_POST['clave']."')";

// consulta
$consulta="SELECT * FROM usuarios where nombre_usuario='".$_POST['usuario']."' and password_usuario=MD5('".$_POST['contraseña']."')   ";

echo $consulta;

//exit; // para abortar codigo

// consulta
$bloqueRegistros=mysqli_query($EstatusConexion,$consulta); // regresa el bloque de registros que provoca la consulta

// despliegue de resultados
echo mysqli_error($EstatusConexion); // despliega el error que se genera

// cierre de conexion
mysqli_close($EstatusConexion);

// tercer nivelde seguridad, evitar inyecciones sql


// cuantos registro tiene el bloque de registros
if(mysqli_num_rows($bloqueRegistros))
	{
		$registro = mysqli_fetch_object($bloqueRegistros); // tomar un registro fetch
		
		//exit;
		$_SESSION['nombre_usuario'] = $registro->nombre_usuario;
		$_SESSION['id'] = $registro->id;
		$_SESSION['rol_id'] = $registro->rol_id;
		
		//var_dump($registro);
		//exit;

		// // actualizar el usuario en cuestion a la fecha de hoy 
		// $query="UPDATE usuario set fech_Ult_Acceso='".date("Y-m-d H:i:s")."'where id=".$_SESSION['idUsuario'];

		// mysqli_query($query);

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

// niveles de seguridad
 	// nivel 1: cuando el acceso se realiza por medio de usuario y clave
 	// nivel 2: las claves no deben de ser visible, para ningun usuario de la db


?>