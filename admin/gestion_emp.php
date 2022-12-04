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

    <script src="../controllers/empleados.js"></script>

	<script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery-confirm.js"></script>
</head>
<body style="">

	<? include "menu.php" ?>

    <div id="cabecera"style="text-align: center;background-color:;margin-top: 15px;margin-left:1%; margin-right:1%; ">
	    <h2 style="margin-top: 15px" align="center" id="titulo">Empleados </h2>
        <form id="formEmpleados" style="width:400px;">
			<input type="hidden" name="accion" value="buscar">
			<input class="form-control" type="text" name="empleado" id="empleado" onkeyup="empleados('buscar')" placeholder="buscar por (Titulo/Nombre Apellido_P)">
		</form>
    </div>
    

	<div id="IDEmpleados" style="border-radius:22px;overflow-y: hidden;height: auto;margin-top: 40px;background-color: rgba(255,255,255,0.7);margin-left:1%; margin-right:1%;" class="">

		<? include "../class/classEmpleados.php" ?>
		
	</div>

</body>
</html>