<?
session_start(); // creacion de sesion en recurso

// verificacion para saber si se paso por el sistema de login
// isset permite saber si una variable existe
if(!isset($_SESSION['nombre_usuario']))
	{header("location: ../index.php?e=2"); // acceso ilegal
	exit; // ya no hagas nada}
}

?>

<!DOCTYPE html>
<html>
<head>
	<!-- Importacion de recursos css -->
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstraplux.css">
</head>
<body style="">
	<!-- Inclusion de recurso menu en recurso actual -->
	<? include "menu.php" ?>
	<!-- Titulo de recurso -->
	<h2 style="margin-top: 15px" align="center">Cuestionario </h2>
	<!-- Contenedor-->
	<div style="border-radius:;overflow-y: hidden;height:auto;margin-top:30%px;margin-left:1%; margin-right:1%;background-color:rgba(255,255,255,0.7)" class="">
		<!-- Inclusion de recurso classEmpleados en recurso actual -->
		<? include "../class/classCuestionarios.php" ?>
		
	</div>

</body>
</html>