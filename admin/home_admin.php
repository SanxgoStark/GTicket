<?
session_start();
//var_dump($_SESSION);
//exit; // ya no hagas nada}

// por cada recurso restringido,debemos preguntar si paso porel sistema de logeo
// isset permite saber si una variable existe
if(!isset($_SESSION['usuario_usu']))
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
<body style="background-image: radial-gradient(circle at 0% 0%, #c2ff83 0, #a3ff8d 12.5%, #81ff96 25%, #5aff9d 37.5%, #1ef3a3 50%, #00e5a7 62.5%, #00d8ac 75%, #00cdb1 87.5%, #00c4b6 100%) !important;">

	<? include "menu.php" ?>
    
	<h2 style="margin-top: 15px" align="center">Tickets Recientes</h2>

    <div style="position:absolute">
    <form class="d-flex">
        <input class="form-control me-sm-2" type="text" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>

    <div style="overflow-y: scroll;height: 485px;margin-top: 70px;background-color: rgba(255,255,255,0.7);" class="container">

		<? include "../class/classTickets.php" ?>
		
	</div>

</body>
</html>