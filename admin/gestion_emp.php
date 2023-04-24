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

	<!-- Importacion de recursos javascript -->
    <script src="../controllers/empleados.js"></script>

	<script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery-confirm.js"></script>
</head>
<body style="">

	<!-- Inclusion de recurso menu en recurso actual -->
	<? include "menu.php" ?>

	<!-- Contendor de titulo de recurso y barra de busqueda -->
    <div id="cabecera"style="text-align: center;background-color:;margin-top: 15px;margin-left:1%; margin-right:1%; ">
	    <h2 style="margin-top: 15px" align="center" id="titulo">Empleados </h2>
        <form id="formEmpleados" style="width:400px;">
			<input type="hidden" name="accion" value="buscar">
			<input class="form-control" type="text" name="empleado" id="empleado" onkeyup="empleados('buscar')" placeholder="buscar por (Titulo/Nombre Apellido_P)">
		</form>
    </div>
    
	<!-- Contendor donde se retorna el resultado de la ejecucion de una accion en la clase-->
	<div id="IDEmpleados" style="border-radius:22px;overflow-y: hidden;height: auto;margin-top: 40px;background-color: ;margin-left:1%; margin-right:1%;" class="">
		
		<!-- Inclusion de recurso classEmpleados en recurso actual -->
		<? include "../class/classEmpleados.php" ?>
		
	</div>

</body>
</html>