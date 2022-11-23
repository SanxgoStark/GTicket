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

    <script src="controllers/ticket.js"></script>

	<script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/jquery-confirm.js"></script>
</head>
<body style="background-image: radial-gradient(circle at 0% 0%, #c2ff83 0, #a3ff8d 12.5%, #81ff96 25%, #5aff9d 37.5%, #1ef3a3 50%, #00e5a7 62.5%, #00d8ac 75%, #00cdb1 87.5%, #00c4b6 100%) !important;">

	<? include "menu.php" ?>

    <div id="cabecera"style="text-align: center;background-color:;margin-top: 15px;margin-left:1%; margin-right:1%; ">
	    <h2 style="margin-top: 15px" align="center" id="titulo">Ticket Recientes </h2>
        <form id="formTickets" style="width:400px;">
			<input type="hidden" name="accion" value="buscar_user">
			<input class="form-control" type="text" name="ticket" id="ticket" onkeyup="tickets('buscar_user')" placeholder="buscar por (Creado/Estatus/Atiende)">
		</form>
    </div>
    
    <script> setInterval("tickets('list_user')",240000);</script> <!--reload de tickets en 4 min-->
	<div id="IDTickets" style="border-radius:22px;overflow-y: hidden;height: auto;margin-top: 40px;background-color: rgba(255,255,255,0.7);margin-left:1%; margin-right:1%;" class="">

		<? include "class/classTickets.php" ?>
		
	</div>

</body>
</html>