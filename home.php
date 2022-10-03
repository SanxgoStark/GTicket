<?
	session_start();
	var_dump($_SESSION);

	// validacion ara que no se pueda entrar con el url a la aplicacion
	// isset permite saber si una variable existe
if(!isset($_SESSION['nomb_usua']))
	{header("location:index.php?e=2"); // acceso ilegal
	exit; // ya no hagas nada}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<h1 align="center">Bienvenido <?echo $_SESSION['nomb_usua'];?></h1>
	<br><br>
	<a href="login.php" class="button">logout</a>

</body>
</html>