<?
session_start(); // creacion de sesion en recurso

// verificacion para saber si se paso por el sistema de login
// isset permite saber si una variable existe
if(!isset($_SESSION['nombre_usuario']))
	{header("location: ../index.php?e=2"); // acceso ilegal
	exit; // no hagas nada
}

?>

<!DOCTYPE html>
<html>
<head>
	<!-- Importacion de recursos css -->
    <link rel="stylesheet" type="text/css" href="../css/custom.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstraplux.css">

	<!-- Importacion de recursos javascript -->
    <script src="controllers/ticket.js"></script>

	<script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/jquery-confirm.js"></script>
</head>
<body style="">
	<!-- Inclusion de recurso menu en recurso actual -->
	<? include "menu.php" ?>

	<!-- Contendor de titulo de recurso y barra de busqueda -->
    <div id="cabecera"style="text-align: center;background-color:;margin-top: 15px;margin-left:1%; margin-right:1%; ">
	    <h2 style="margin-top: 15px" align="center" id="titulo">Ticket Recientes </h2>
        <form id="formTickets" style="width:400px;">
			<input type="hidden" name="accion" value="buscar_user">
			<input class="form-control" type="text" name="ticket" id="ticket" onkeyup="tickets('buscar_user')" placeholder="buscar por (Creado/Estatus/Atiende)">
		</form>
    </div>
    
	<!-- funcion para recarga de recurso automatico se hace uso de funcion de controlador tickets-->
    <script> setInterval("tickets('list_user')",240000);</script> <!--reload de tickets en 4 min-->
	<!-- Contendor donde se retorna el resultado de la ejecucion de una accion en la clase-->
	<div id="IDTickets" style="border-radius:22px;overflow-y: hidden;height: auto;margin-top: 40px;background-color: rgba(255,255,255,0.7);margin-left:1%; margin-right:1%;" class="">
		
		<!-- Inclusion de recurso classTickets en recurso actual -->
		<? include "class/classTickets.php" ?>
		
	</div>

</body>
</html>