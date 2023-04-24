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
    <script src="../controllers/ticket.js"></script>

	<script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery-confirm.js"></script>
	
</head>
<body style="">

	<!-- Inclusion de recurso menu en recurso actual -->
	<? include "menu.php" ?>

	<!-- Contendor de titulo de recurso y barra de busqueda -->
	<div id="cabecera" style="text-align: center;background-color:;margin-top: 15px;margin-left:1%; margin-right:1%; ">
	<h2 style="margin-top:" align="center">Tickets Recientes</h2>
	<form id="formTickets" style="width:400px;">
			<input type="hidden" name="accion" value="buscar">
			<input class="form-control" type="text" name="ticket" id="ticket" onkeyup="tickets('buscar')" placeholder="buscar por (Creado/Estatus/Atiende)">
		</form>
		
	
	</div>

    <!-- funcion para recarga de recurso automatico se hace uso de funcion de controlador tickets-->
    <script> setInterval("tickets('list')",240000);</script> <!--reload de tickets en 4 min-->
	<!-- Contendor donde se retorna el resultado de la ejecucion de una accion en la clase-->
    <div id="IDTickets" style="border-radius:22px;overflow-y: hidden;height: auto;width;margin-top: 40px;margin-left:1%; margin-right:1%; background-color: " class="">

		<!-- Inclusion de recurso classTickets en recurso actual -->
		<? include "../class/classTickets.php" ?>
		
	</div>

</body>
</html>