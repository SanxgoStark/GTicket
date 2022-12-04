<?
session_start();
// var_dump($_SESSION);

// por cada recurso restringido,debemos preguntar si paso porel sistema de logeo
// isset permite saber si una variable existe
if(!isset($_SESSION['nombre_usuario']))
	{header("location: ../index.php?e=2"); // acceso ilegal
	exit; // ya no hagas nada}
}
?>


<!-- <a href="../index.php">cerrar sesion</a> -->

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstraplux.css">
</head>
<body style="">

	<? include "menu.php" ?>
	<h2 style="margin-top: 15px" align="center">Empleados </h2>

	<div style="border-radius:22px;overflow-y:hidden;height: 485px;margin-top: 70px;background-color: rgba(255,255,255,0.7);" class="container">

		<? include "../class/classEmpleados.php" ?>
		
	</div>

</body>
</html>