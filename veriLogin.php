<?
session_start();// quiere almacenar info en el servidor

// se uso var_dump para verificar que si se recibierna los datos enviados por el formulario de login hacia verilogin
var_dump($_POST);

// servidor,usuario,la clave,bd
$EstatusConexion=mysqli_connect("localhost","User","1234","salesmanagement");

// se pregunta sobre el estatus de la conexion
if($EstatusConexion==null){
	echo "no se pudo conectar";
}else{
	echo "si se pudo conectar";
}

// codigo sql
// $consulta = "SELECT * FROM usuario where Email='".$_POST['email']."' and Clave=password('".$_POST['clave']."')";

// consulta de maestro
$consulta="SELECT * FROM usuario where nomb_usua='".$_POST['usuario']."' and pass_usua=password('".$_POST['contraseña']."')   ";

// echo $consulta;

// exit; // para abortar codigo

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

		$_SESSION['nomb_usua'] = $registro->nomb_usua;
		$_SESSION['Id'] = $registro->Id;
		$_SESSION['fk_id_rol'] = $registro->fk_id_rol;

		// var_dump($registro);
		// exit;

		// // actualizar el usuario en cuestion a la fecha de hoy 
		// $query="UPDATE usuario set fech_Ult_Acceso='".date("Y-m-d H:i:s")."'where id=".$_SESSION['idUsuario'];

		// mysqli_query($query);

		if ($_SESSION['fk_id_rol'] == 1) { // 1 es gerente
			// se inicializa la variable ed sesion para lalista de compra
			$_SESSION['listadoCanasta'] = array();
			$_SESSION['total'] = 0;
			header("location: admin/home.php");
		}else{
			// $_SESSION['nombre']=$_SESSION['idUsuario']= // variable global, SE GENERA SESSION
			
			// se inicializa la variable ed sesion para lalista de compra
			$_SESSION['listadodecompra']=array();
			$_SESSION['total'] = 0;
			header("location: home.php");	
		}

		
	}
else // los datos de identidficacion no corresponden
	
 	header("location: login.php?e=1"); // se manda a recuerso login

// si imprime 0 el registro no existe en base de datos
// si imprime 1 el restro existe en la base de datos

// niveles de seguridad
 	// nivel 1: cuando el acceso se realiza por medio de usuario y clave
 	// nivel 2: las claves no deben de ser visible, para ningun usuario de la db


?>