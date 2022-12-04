
<?
//echo var_dump($_POST);
//echo var_dump($_SESSION);
/**
 * MODELO , CONTROLADOR
 */

// las sesiones es el ecanismo de asegurarnos que el usuario se logeo correctamente
date_default_timezone_set('America/Mexico_City');
// asegurarme que la ssession existe
// isset permite saber si una variable existe
if(!isset($_SESSION['nombre_usuario'])) 
	{
		// si no esta el isset de la sesion has esto

		session_start(); // si no existe arracca las sesiones
		// si se inician las sesiones y aun asi no existe es acceso ilegal
		if(!isset($_SESSION['nombre_usuario'])) exit; // ya no hagas nada}
		//else // si es un administrador dejrlo pasar aqui con codigo
	}
	
	include "classBaseDatos.php";

	// si el usaurio se logeo correctamente pasa
	// clase de estatus de espacios
	class Tickets extends BaseDatos // clase referente a tabla espacios en la base de datos
	{
		// al poner extends la tabla podra heredar el conportamiento de la calse BaseDatos
		
		// funcion constructor por defecto
		function __construct(){}

		// que quiero hacer con esta tabla
		function proceso($accion){
			
			//arreglos de selects
			$estatusTickets = array("Abierto","Cerrado");
			$prioridadTickets = array("Normal","Media","Alta");
			$nivelesSoporte = array("N1","N2");
			$fabricantes = array("HP","DELL","Otro");
			$modelos = array("N1XZS2","67FR","Otro");
			$sistemasOperativos = array("Windows 7 Enterprise","Windows 10 Pro","Windows 10 Home","Windows 10 Enterprise","Windows 11 Pro");
			$tiposConexion = array("Alambrica","Inalambrica");
			$aplicaciones = array("Word","Excel","Power Point","SAP","JBA","Nonconformance","ninguna");
			$ifinstalldrivers = array("Si","No");
			$tiposCuestionario = array("CCP","SO","RED","CP","SEG","IMP","SOF");
		

			$result=""; // variable para acumular el resultado
			switch ($accion) {
                
                // metodo para caja de busqueda de tickets (barra)
                case 'buscar':
					//echo "entre";

					$consulta ="SELECT T.id as Ticket,fecha_creacion_ticket as Creado,fecha_modificacion_ticket as Modificado,asunto_ticket as Asunto,estatus_ticket as Estatus,prioridad_ticket as Prioridad,nivel_ticket as Nivel, CONCAT(nombre_empleado,' ',apellido_paterno) as Atiende, tipo_cuestionario FROM tickets T
                    	join empleados E ON E.id = T.empledo_asignado_id where estatus_ticket like '%".$_REQUEST['ticket']."%' OR fecha_creacion_ticket like '%".$_REQUEST['ticket']."%' OR CONCAT(nombre_empleado,' ',apellido_paterno) like '%".$_REQUEST['ticket']."%' AND estado_ticket = 0 order by estatus_ticket";
						$this->consulta($consulta);

						$result=$this->imprimeTabla($consulta,true,array("formupdate","delete","cuestionario"));
					

				break;

				case 'buscar_user':

					$cadUser = "SELECT T.id as Ticket,fecha_creacion_ticket as Creado,fecha_modificacion_ticket as Modificado,asunto_ticket as Asunto,estatus_ticket as Estatus,prioridad_ticket as Prioridad,nivel_ticket as Nivel, CONCAT(nombre_empleado,' ',apellido_paterno) as Atiende, tipo_cuestionario FROM tickets T
					join empleados E ON E.id = T.empledo_asignado_id where (estatus_ticket like '%".$_REQUEST['ticket']."%' OR fecha_creacion_ticket like '%".$_REQUEST['ticket']."%' OR CONCAT(nombre_empleado,' ',apellido_paterno) like '%".$_REQUEST['ticket']."%') AND (estado_ticket = 0 AND autor_id like '%".$_SESSION["id"]."%') order by estatus_ticket";

						$result=$this->imprimeTablauser($cadUser,true,array("cuestionario"));

					break;

				case 'insert':
				
				//echo var_dump($_POST);
				//exit;

				if($_SESSION["rol_id"] == 1){
					//user

					// el 1 en la consulta refiere al epleado con id 1 que es Ulises Estrada (IT/Sistemas)
					// S/A = Sin asignar

					$cad='INSERT INTO tickets 
					(fecha_creacion_ticket,fecha_modificacion_ticket,asunto_ticket,descripcion_ticket,estatus_ticket,prioridad_ticket,empledo_asignado_id,autor_id,nivel_ticket,nota_ticket,nombre_equipo_ticket,fabricante_ticket,modelo_equipo_ticket,tipo_conexion_ticket,nombre_aplicacion_ticket,si_driver_update,nombre_driver_update,sistema_operativo_ticket,tipo_cuestionario) 
					values("'.$_POST["fecha_creacion_ticket"].'","'.$_POST['fecha_modificacion_ticket'].'"
					,"'.$_POST['asunto_ticket'].'","'.$_POST['descripcion_ticket'].'","Abierto","Normal","1","'.$_SESSION['id'].'"
					,"N1","'.$_POST['nota_ticket'].'","'.$_POST['nombre_equipo_ticket'].'"
					,"'.$_POST['fabricante_ticket'].'","'.$_POST['modelo_equipo_ticket'].'","'.$_POST['tipo_conexion_ticket'].'"
					,"'.$_POST['nombre_aplicacion_ticket'].'","'.$_POST['si_driver_update'].'","/*nombre_driver_update*/"
					,"'.$_POST['sistema_operativo_ticket'].'","S/A")';
				}else{
					//admin

					$cad='INSERT INTO tickets 
					(fecha_creacion_ticket,fecha_modificacion_ticket,asunto_ticket,descripcion_ticket,estatus_ticket,prioridad_ticket,empledo_asignado_id,autor_id,nivel_ticket,nota_ticket,nombre_equipo_ticket,fabricante_ticket,modelo_equipo_ticket,tipo_conexion_ticket,nombre_aplicacion_ticket,si_driver_update,nombre_driver_update,sistema_operativo_ticket,tipo_cuestionario) 
					values("'.$_POST["fecha_creacion_ticket"].'","'.$_POST['fecha_modificacion_ticket'].'"
					,"'.$_POST['asunto_ticket'].'","'.$_POST['descripcion_ticket'].'","'.$_POST['estatus_ticket'].'"
					,"'.$_POST['prioridad_ticket'].'","'.$_POST['empledo_asignado_id'].'","'.$_POST['autor_id'].'"
					,"'.$_POST['nivel_ticket'].'","'.$_POST['nota_ticket'].'","'.$_POST['nombre_equipo_ticket'].'"
					,"'.$_POST['fabricante_ticket'].'","'.$_POST['modelo_equipo_ticket'].'","'.$_POST['tipo_conexion_ticket'].'"
					,"'.$_POST['nombre_aplicacion_ticket'].'","'.$_POST['si_driver_update'].'","/*nombre_driver_update*/"
					,"'.$_POST['sistema_operativo_ticket'].'","'.$_POST['tipo_cuestionario'].'")';
				}
					
					

					//ejecuta la cadena
					$this->consulta($cad);

					// funcion para insertar imagen en bd
					$this->insertarimagen();
					
					$result.=$this->proceso('list');
					
					break;

				// listado 
				case 'list': 
				
                $cadAdmin = "SELECT T.id as Ticket,fecha_creacion_ticket as Creado,fecha_modificacion_ticket as Modificado,asunto_ticket as Asunto,estatus_ticket as Estatus,prioridad_ticket as Prioridad,nivel_ticket as Nivel, CONCAT(nombre_empleado,' ',apellido_paterno) as Atiende, tipo_cuestionario FROM tickets T
                    join empleados E ON E.id = T.empledo_asignado_id WHERE estado_ticket = 0 ORDER BY fecha_creacion_ticket";

				$cadUser = "SELECT T.id as Ticket,fecha_creacion_ticket as Creado,fecha_modificacion_ticket as Modificado,asunto_ticket as Asunto,estatus_ticket as Estatus,prioridad_ticket as Prioridad,nivel_ticket as Nivel, CONCAT(nombre_empleado,' ',apellido_paterno) as Atiende, tipo_cuestionario FROM tickets T
					join empleados E ON E.id = T.empledo_asignado_id WHERE estado_ticket = 0 AND autor_id = ".$_SESSION["id"]." ORDER BY T.id";

					if($_SESSION["rol_id"] == 1){
						//user
						$result=$this->imprimeTablauser($cadUser,true,array("cuestionario"));
					}else{
						//admin
						$result=$this->imprimeTabla($cadAdmin,true,array("formupdate","delete","cuestionario"));
					}
					
					break;

				case 'list_user':
					$cadUser = "SELECT T.id as Ticket,fecha_creacion_ticket as Creado,fecha_modificacion_ticket as Modificado,asunto_ticket as Asunto,estatus_ticket as Estatus,prioridad_ticket as Prioridad,nivel_ticket as Nivel, CONCAT(nombre_empleado,' ',apellido_paterno) as Atiende, tipo_cuestionario FROM tickets T
					join empleados E ON E.id = T.empledo_asignado_id WHERE estado_ticket = 0 AND autor_id = ".$_SESSION["id"]." ORDER BY T.id";
					
					$result=$this->imprimeTablauser($cadUser,true,array("cuestionario"));
					break;

				case 'delete':

					// armado de cadena de actualizacion de estado
					$cad = 'UPDATE tickets SET estado_ticket = 1 WHERE id = "'.$_POST["idRegistro"].'"';

					//ejecuta la cadena
					$this->consulta($cad);

					$result.= $this->proceso('list');
					break;
				
				case 'update':

					$cad = 'UPDATE tickets SET fecha_creacion_ticket ="'.$_POST["fecha_creacion_ticket"].'", 
								fecha_modificacion_ticket="'.$_POST['fecha_modificacion_ticket'].'",
											asunto_ticket="'.$_POST['asunto_ticket'].'",
									  descripcion_ticket="'.$_POST['descripcion_ticket'].'",
									  estatus_ticket="'.$_POST['estatus_ticket'].'",
									  prioridad_ticket="'.$_POST['prioridad_ticket'].'",
									  autor_id="'.$_POST['autor_id'].'",
									  empledo_asignado_id="'.$_POST['empledo_asignado_id'].'",
									  nivel_ticket="'.$_POST['nivel_ticket'].'",
									  nota_ticket="'.$_POST['nota_ticket'].'",
									  nombre_equipo_ticket="'.$_POST['nombre_equipo_ticket'].'",
									  fabricante_ticket="'.$_POST['fabricante_ticket'].'",
									  modelo_equipo_ticket="'.$_POST['modelo_equipo_ticket'].'",
									  tipo_conexion_ticket="'.$_POST['tipo_conexion_ticket'].'",
									  nombre_aplicacion_ticket="'.$_POST['nombre_aplicacion_ticket'].'",
									  si_driver_update="'.$_POST['si_driver_update'].'",
									  sistema_operativo_ticket="'.$_POST['sistema_operativo_ticket'].'",
									  tipo_cuestionario="'.$_POST['tipo_cuestionario'].'"
					WHERE id = "'.$_POST["idRegistro"].'"';

					//ejecuta la cadena
					$this->consulta($cad);

					// funcion para insertar imagen en bd
					$this->insertarimagen();

					$result.=$this->proceso('list');

					break;


				case 'formupdate':

					$registro=$this->sacaTupla("SELECT * FROM tickets WHERE id=".$_POST['idRegistro']);

				case 'formNew':

					//echo "formNew";
					//echo $registro["tipo_conexion_ticket"];
					//exit;
					
					$fechaActual = date('y-m-d h:i:s'); // obtencion de la fecha actual

					if($_SESSION["rol_id"] == 1){
						//user

						$result.='<div class="" style="margin-top:">
					<form action="" method="post" enctype="multipart/form-data">';
					if (isset($registro))
						$result.='
					<script>document.getElementById("cabecera").innerHTML = "<h2>Modificacion Ticket</h2>";</script>
					<input type="hidden" name="accion" value="update">
					<input type="hidden" name="idRegistro" value="'.$registro['id'].'">';
					else
						$result.='
					<script>document.getElementById("cabecera").innerHTML = "<h2>Nuevo Ticket</h2>";</script>
					<input type="hidden" name="accion" value="insert">';
					$result.='

					<div style="background-color:;height:auto;float:left;width:50%">

					<div class="content-flexbox" style="background-color:;height:auto;float:left;width:100%;margin-top:2%">

						<div style="background-color:;height:auto;width:32.3%;display:inline-block;">
							<div>
							<input readonly="readonly" placeholder="F.Creacion" required="" type="data" name="fecha_creacion_ticket" class="form-control" value="'.(isset($registro)?$registro['fecha_creacion_ticket']:"$fechaActual").'">
							</div>
						</div>
						<div style="background-color:;height:auto;width:32.3%;display:inline-block;">
							<div>
							<input readonly="readonly" placeholder="F.Modificacion" required="" type="data" name="fecha_modificacion_ticket" class="form-control" value="'.$fechaActual.'">
							</div>
						</div>
						<div  style=";background-color:;height:auto;width:31.3%;float:right;">
							<div style="backgroundcolor:;height:55px;margin-top:15px">
								<h4 style="font-weight: 900; margin-top:" align="center">NT:'.(isset($registro)?$registro['id']:"").'</h4>
							</div>
						</div>

					</div>

					<div style="margin-top:8%"class="">

					<div style="margin-left:9%" class="col-md-10">
					<div class="row">

					<label style="margin-top:10px" class="col-md-3">Asunto * </label>
					<div style="margin-top:10px" class="col-md-8">
					<input placeholder="Asunto" required="" type="text" name="asunto_ticket" class="form-control" value="'.(isset($registro)?$registro['asunto_ticket']:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-3">Descripcion * </label>
					<div style="margin-top:10px" class="col-md-8">
					<input placeholder="Descripcion" required="" type="text" name="descripcion_ticket" class="form-control" value="'.(isset($registro)?$registro['descripcion_ticket']:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-3">Estatus *</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-8">';
									$result.=$this->cajaDesplegablelocalbloq($estatusTickets,"estatus_ticket",isset($registro)?$registro['estatus_ticket']:"");
									$result.='
									</div>
									</div>
 
					<label style="margin-top:10px" class="col-md-3">Prioridad *</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-8">';
									$result.=$this->cajaDesplegablelocalbloq($prioridadTickets,"prioridad_ticket",isset($registro)?$registro['prioridad_ticket']:"");
									$result.='
									</div>
									</div>

					<label style="margin-top:10px" class="col-md-3">Atiende * </label>
					<div style="margin-top:10px" class="col-md-8">
					<div class="col-md-8">';
					$result.=$this->cajaDesplegablebloq("usuarios","empledo_asignado_id","id","nombre_usuario",isset($registro)?$registro['empledo_asignado_id']:"");
					$result.='
					</div>
					</div>

					<label style="margin-top:10px" class="col-md-3">Nivel Soporte *</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-8">';
									$result.=$this->cajaDesplegablelocalbloq($nivelesSoporte,"nivel_ticket",isset($registro)?$registro['nivel_ticket']:"");
									$result.='
									</div>
									</div>

					<label style="margin-top:10px" class="col-md-3">Nota * </label>
						<div style="margin-top:10px" class="col-md-8">
							<input readonly="readonly" placeholder="Notas" required="" type="text" name="nota_ticket" class="form-control" value="'.(isset($registro)?$registro['nota_ticket']:"").'">
						</div>

					<small style="margin-top:10px" >* Campo Obligatorio</small><br>

    				<div style="float:right;width:500px;margin-top:3%" class="form-group">
      				<input class="form-control" type="file" name="imagen">
   					</div>

					</div>
					</div>
					</div>
					</div>
					</div>


					<div style="margin-top:2%;background-color:;height:auto;float:right;width:50%">

						<div style="background-color:;height:50%;float:top;width:auto;">
							<div style="margin-top:"class="">
							<div style="margin-left:9%" class="col-md-10">
							<div class="row">

								<label class="col-md-3">Nombre Equipo * </label>
								<div class="col-md-8">
								<input placeholder="Nombre Equipo" required="" type="text" name="nombre_equipo_ticket" class="form-control" value="'.(isset($registro)?$registro['nombre_equipo_ticket']:"").'">
								</div>

								<label style="margin-top:10px" class="col-md-3">Fabricante *</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-8">';
									$result.=$this->cajaDesplegablelocal($fabricantes,"fabricante_ticket",isset($registro)?$registro['fabricante_ticket']:"");
									$result.='
									</div>
									</div>

								<label style="margin-top:10px" class="col-md-3">Modelo *</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-8">';
									$result.=$this->cajaDesplegablelocal($modelos,"modelo_equipo_ticket",isset($registro)?$registro['modelo_equipo_ticket']:"");
									$result.='
									</div>
									</div>

								<label style="margin-top:10px" class="col-md-3">S.O *</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-8">';
									$result.=$this->cajaDesplegablelocal($sistemasOperativos,"sistema_operativo_ticket",isset($registro)?$registro['sistema_operativo_ticket']:"");
									$result.='
									</div>
									</div>

							</div>
							</div>
							</div>

						</div>

						<div style=";background-color:;height:50%;float:top;width:auto">

							<div style="margin-top:"class="">
							<div style="margin-left:9%" class="col-md-10">
							<div class="row">

								<label class="form-label mt-4">¿Que tipo de conexion tiene actualmente?</label>
									<div class="col-md-5">
									<div class="form-group">';
									$result.=$this->cajaDesplegablelocal($tiposConexion,"tipo_conexion_ticket",isset($registro)?$registro['tipo_conexion_ticket']:"");
									$result.='
									</div>
									</div>

								<label class="form-label mt-4">¿Que aplicacion usaba cuando sucedio el error?</label>
									<div class="col-md-5">
									<div class="form-group">';
									$result.=$this->cajaDesplegablelocal($aplicaciones,"nombre_aplicacion_ticket",isset($registro)?$registro['nombre_aplicacion_ticket']:"");
									$result.='
									</div>
									</div>

								<label class="form-label mt-4">¿A instalado drivers o actualizaciones recientemente?</label>
									<div class="col-md-5">
									<div class="form-group">';
									$result.=$this->cajaDesplegablelocal($ifinstalldrivers,"si_driver_update",isset($registro)?$registro['si_driver_update']:"");
									$result.='
									</div>
									</div>

							</div>
							</div>
							
							</div>

							

						</div>

					
					</div>

					<div style="background-color:;margin-top:30%">
						<div style="background-color:;margin-left: 80%;width: 313px;">
							<input style=";margin-left:; aling:" type="submit" class="btn btn-primary" value="Guardar">
							<button style="margin-left:50px;width: auto" type="button" class="btn btn-primary"><a style="color:white" href="home_user.php">Cancelar</a></button>	
						</div>
					</div>
					
					</form>
					
					</div>';

					}else{
						//admin

						$result.='<div class="" style="margin-top:">
					<form action="" method="post" enctype="multipart/form-data">';
					if (isset($registro))
						$result.='
					<script>document.getElementById("cabecera").innerHTML = "<h2>Modificacion Ticket</h2>";</script>
					<input type="hidden" name="accion" value="update">
					<input type="hidden" name="idRegistro" value="'.$registro['id'].'">';
					else
						$result.='
					<script>document.getElementById("cabecera").innerHTML = "<h2>Nuevo Ticket</h2>";</script>
					<input type="hidden" name="accion" value="insert">';
					$result.='

					<div style="background-color:;height:auto;float:left;width:50%">

					<div class="content-flexbox" style="background-color:;height:auto;float:left;width:100%;margin-top:2%">

						<div style="background-color:;height:auto;width:32.3%;display:inline-block;">
							<div>
							<input readonly="readonly" placeholder="F.Creacion" required="" type="data" name="fecha_creacion_ticket" class="form-control" value="'.(isset($registro)?$registro['fecha_creacion_ticket']:"$fechaActual").'">
							</div>
						</div>
						<div style="background-color:;height:auto;width:32.3%;display:inline-block;">
							<div>
							<input readonly="readonly" placeholder="F.Modificacion" required="" type="data" name="fecha_modificacion_ticket" class="form-control" value="'.$fechaActual.'">
							</div>
						</div>
						<div  style=";background-color:;height:auto;width:31.3%;float:right;">
							<div style="backgroundcolor:;height:55px;margin-top:15px">
								<h4 style="font-weight: 900; margin-top:" align="center">NT:'.(isset($registro)?$registro['id']:"").'</h4>
							</div>
						</div>

					</div>

					<div style="margin-top:8%"class="">

					<div style="margin-left:9%" class="col-md-10">
					<div class="row">

					<label style="margin-top:10px" class="col-md-3">Asunto * </label>
					<div style="margin-top:10px" class="col-md-8">
					<input placeholder="Asunto" required="" type="text" name="asunto_ticket" class="form-control" value="'.(isset($registro)?$registro['asunto_ticket']:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-3">Descripcion * </label>
					<div style="margin-top:10px" class="col-md-8">
					<input placeholder="Descripcion" required="" type="text" name="descripcion_ticket" class="form-control" value="'.(isset($registro)?$registro['descripcion_ticket']:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-3">Estatus *</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-8">';
									$result.=$this->cajaDesplegablelocal($estatusTickets,"estatus_ticket",isset($registro)?$registro['estatus_ticket']:"");
									$result.='
									</div>
									</div>
 
					<label style="margin-top:10px" class="col-md-3">Prioridad *</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-8">';
									$result.=$this->cajaDesplegablelocal($prioridadTickets,"prioridad_ticket",isset($registro)?$registro['prioridad_ticket']:"");
									$result.='
									</div>
									</div>

					<label style="margin-top:10px" class="col-md-3">Atiende * </label>
					<div style="margin-top:10px" class="col-md-8">
					<div class="col-md-8">';
					$result.=$this->cajaDesplegable("usuarios","empledo_asignado_id","id","nombre_usuario",isset($registro)?$registro['empledo_asignado_id']:"");
					$result.='
					</div>
					</div>

					<label style="margin-top:10px" class="col-md-3">Nivel Soporte *</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-8">';
									$result.=$this->cajaDesplegablelocal($nivelesSoporte,"nivel_ticket",isset($registro)?$registro['nivel_ticket']:"");
									$result.='
									</div>
									</div>

					<label style="margin-top:10px" class="col-md-3">Nota * </label>
						<div style="margin-top:10px" class="col-md-8">
							<input placeholder="Notas" required="" type="text" name="nota_ticket" class="form-control" value="'.(isset($registro)?$registro['nota_ticket']:"").'">
						</div>

					<small style="margin-top:10px" >* Campo Obligatorio</small><br>

    				<div style="float:right;width:500px;margin-top:3%" class="form-group">
      				<input class="form-control" type="file" name="imagen">
   					</div>

					</div>
					</div>
					</div>
					</div>
					</div>


					<div style="margin-top:2%;background-color:;height:auto;float:right;width:50%">

						<div style="background-color:;height:50%;float:top;width:auto;">
							<div style="margin-top:"class="">
							<div style="margin-left:9%" class="col-md-10">
							<div class="row">

								<label class="col-md-3">Nombre Equipo * </label>
								<div class="col-md-8">
								<input placeholder="Nombre Equipo" required="" type="text" name="nombre_equipo_ticket" class="form-control" value="'.(isset($registro)?$registro['nombre_equipo_ticket']:"").'">
								</div>

								<label style="margin-top:10px" class="col-md-3">Fabricante *</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-8">';
									$result.=$this->cajaDesplegablelocal($fabricantes,"fabricante_ticket",isset($registro)?$registro['fabricante_ticket']:"");
									$result.='
									</div>
									</div>

								<label style="margin-top:10px" class="col-md-3">Modelo *</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-8">';
									$result.=$this->cajaDesplegablelocal($modelos,"modelo_equipo_ticket",isset($registro)?$registro['modelo_equipo_ticket']:"");
									$result.='
									</div>
									</div>

								<label style="margin-top:10px" class="col-md-3">S.O *</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-8">';
									$result.=$this->cajaDesplegablelocal($sistemasOperativos,"sistema_operativo_ticket",isset($registro)?$registro['sistema_operativo_ticket']:"");
									$result.='
									</div>
									</div>

							</div>
							</div>
							</div>

						</div>

						<div style=";background-color:;height:50%;float:top;width:auto">

							<div style=";background-color:;height:auto;float:right;width:50%;height:auto">
							
								<div style="margin-top:"class="">
								<div style="margin-left:" class="col-md-10">
								<div class="row">

									<label class="form-label mt-4">Autor</label>
									<div style="" class="col-md-8">
									<div class="col-md-8">';
									$result.=$this->cajaDesplegable("usuarios","autor_id","id","nombre_usuario",isset($registro)?$registro['autor_id']:"");
									$result.='
									</div>
									</div>


									<label class="form-label mt-4">Tipo de cuestionario *</label>
									<div class="col-md-8">
									<div class="form-group">';
									$result.=$this->cajaDesplegablelocal($tiposCuestionario,"tipo_cuestionario",isset($registro)?$registro['tipo_cuestionario']:"");
									$result.='
									</div>
									</div>

								</div>
								</div>
								</div>
							</div>

							<div style="margin-top:"class="">
							<div style="margin-left:9%" class="col-md-10">
							<div class="row">

								<label class="form-label mt-4">¿Que tipo de conexion tiene actualmente?</label>
									<div class="col-md-8">
									<div class="form-group">';
									$result.=$this->cajaDesplegablelocal($tiposConexion,"tipo_conexion_ticket",isset($registro)?$registro['tipo_conexion_ticket']:"");
									$result.='
									</div>
									</div>

								<label class="form-label mt-4">¿Que aplicacion usaba cuando sucedio el error?</label>
									<div class="col-md-8">
									<div class="form-group">';
									$result.=$this->cajaDesplegablelocal($aplicaciones,"nombre_aplicacion_ticket",isset($registro)?$registro['nombre_aplicacion_ticket']:"");
									$result.='
									</div>
									</div>

								<label class="form-label mt-4">¿A instalado drivers o actualizaciones recientemente?</label>
									<div class="col-md-8">
									<div class="form-group">';
									$result.=$this->cajaDesplegablelocal($ifinstalldrivers,"si_driver_update",isset($registro)?$registro['si_driver_update']:"");
									$result.='
									</div>
									</div>

							</div>
							</div>
							
							</div>

							

						</div>

					
					</div>

					<div style="background-color:;margin-top:30%">
						<div style="background-color:;margin-left: 80%;width: 313px;">
							<input style=";margin-left:; aling:" type="submit" class="btn btn-primary" value="Guardar">
							<button style="margin-left:50px;width: auto" type="button" class="btn btn-primary"><a style="color:white" href="../admin/home_admin.php">Cancelar</a></button>	
						</div>
					</div>
					
					</form>
					
					</div>';
					}
					

					

					//echo var_dump($_POST);
					
					break;

			}
			// puede retirnar el resultado o imprimirlo con echo
			return $result;
		}

		function insertarimagen(){

			if($_SESSION["rol_id"] == 1){
				//user
				$carpeta = "imagenes/";
			}else{
				//admin
				$carpeta = "../imagenes/";
			}
			

			$file = $_FILES["imagen"];
			$nombre = $file["name"];
			$tipo = $file["type"];
			$size = $file["size"];
			$ruta_provisional = $file["tmp_name"];

		    //echo var_dump($_POST);
			//exit;
			//$picture = "imagenes/".$nombre;

			if(isset($_POST["idRegistro"])){
			 // cuando el ticket ya existe y se desea agregar una nueva imagen adicional

				// si la longitud del nombre del archivo es diferente de 0 entonces se cargo una imagen
				// se procede a guardarla en la ruta especificada
				if(strlen($file["name"]) != 0){
					$src = $carpeta.$nombre;
					move_uploaded_file($ruta_provisional,$src);

					$cad='INSERT INTO imagenes 
					(nombre_imagen,tipo_imagen,ticked_id) 
					values("'.$file["name"].'"
					,"'.$file["type"].'","'.$_POST["idRegistro"].'")';

					$res = $this->consult($cad);
				}	

			}else{
				// cuando el ticket es nuevo aun no existe idRegistro
				$lastticket = $this->maxticket();

				// si la longitud del nombre del archivo es diferente de 0 entonces se cargo una imagen
				// se procede a guardarla en la ruta especificada
				if(strlen($file["name"]) != 0){
					$src = $carpeta.$nombre;
					move_uploaded_file($ruta_provisional,$src);

					$cad='INSERT INTO imagenes 
					(nombre_imagen,tipo_imagen,ticked_id) 
					values("'.$file["name"].'"
					,"'.$file["type"].'","'.$lastticket.'")';

					$res = $this->consult($cad);
				}
				

			}	

				
		}

		// funcion para obtener el ultimo ticket creado (solo se usa en el insert de ticket)
		function maxticket(){
			$cad="SELECT * FROM tickets ORDER BY id DESC LIMIT 1";


			$res = $this->consult($cad);
			// echo var_dump($res);

			// volcar datos, provenientes de una consulta mysql, dentro de un array php
			$volcadoarray = mysqli_fetch_array($res);
			$idmaxticket = $volcadoarray['id'];

			return $idmaxticket;
		}

		// creacion de relacion usuario y empleado
		function usuario_emp($id_usuario,$id_empleado){

			$cad='INSERT INTO usuario_emp 
			(fk_id_usua,Id) 
				values('.$id_usuario.','.$id_empleado.')';

					//ejecuta la cadena
					$this->consulta($cad);
		}

		function imprimeTabla($query,$formNew=false,$iconos=array()){

			$result="";
			$this->consulta($query);
			$result.='<table style="margin-top:" class="table table-hover table-ligh table-striped">';
			//Cabecera
		    $result.='<tr>';
		    $result.='<td colspan="'.count($iconos).'" >'.(($formNew)?'<form method="post"><input type="hidden" value="formNew" name="accion"/><button class = "btn btn-sm btn-success"><i title="Agregar Registro" class="fa fa-plus-circle"></i></button></form>':"&nbsp;").'</td>';

		    for($c=0; $c < $this->numeCampos();$c++){
		    $campo=$this->infoCampo($c);
		    $result.='<td>'.$campo->name.'</td>';
		    }
		    $result.='</tr>';

			for ($i=0; $i < $this->numeroRegistros; $i++) { 
				$registro=$this->traeRegistro();
				$result.='<tr>';
		        
		        foreach ($iconos as $value) {
		        	switch ($value) {
		        		case 'delete':
		        		// echo $registro[0];
		        			$result.='<td width="6%"><form method="post"><input type="hidden" value="'.$value.'" name="accion"/>
                     <input type="hidden" name="idRegistro" value = "'.$registro[0].'">
        			<button class="btn btn-danger"><i title="Borrar registro" class="fas fa-trash"></i></button></form></td>';
		        			break;
		        		case 'editar':
		        			$result.='<td colspan="'.count($iconos).'">'.(($formNew)?'<form method="post"><input type="hidden" value="formNew" name="accion"/><button class="btn btn-success"><i title="Editar registro" class="fas fa-plus-circle"></i></button></form>':"&nbsp;").'</td>';
		        			break;
		        		case 'formupdate':
		        		
		        			$result.='<td width="6%">
		        			<form method="post">
		        			<input type="hidden" value="'.$value.'" name="accion">
		        			<input type="hidden" value="'.$registro[0].'" name="idRegistro">
		        			<button class="btn btn-primary">
		        			<i title="Editar registro" class="fas fa-edit"></i>
		        			</button>
		        			</form>
		        			</td>';
		        			break;
						
						case 'cuestionario':
		        		
							if($registro[8] == "S/A"){
								$result.='<td width="6%">
								<form method="post" action="cuestionario.php">
								<input type="hidden" value="'.$value.'" name="accion">
								<input type="hidden" value="'.$registro[0].'" name="idRegistro">
								<button type="button" disabled class="btn btn-warning">
								<i title="Cuestionario" class="fa fa-list-alt"></i>
								</button>
								</form>
								</td>';
							}else{
								$result.='<td width="6%">
								<form method="post" action="cuestionario.php">
								<input type="hidden" value="'.$value.'" name="accion">
								<input type="hidden" value="'.$registro[0].'" name="idRegistro">
								<button class="btn btn-warning">
								<i title="Cuestionario" class="fa fa-list-alt"></i>
								</button>
								</form>
								</td>';
							}
		        			
		        			break;	
		        	}
		        	
		        }

				for ($col=0; $col < count($registro); $col++) { 
					$result.='<td>'.$registro[$col].'</td>';
					
				}$result.='</tr>';
				
			}
			$result.='</table>';
		    return $result;
		}

		function imprimeTablauser($query,$formNew=false,$iconos=array()){

			$result="";
			$this->consulta($query);
			$result.='<table style="margin-top:" class="table table-hover table-ligh table-striped">';
			//Cabecera
		    $result.='<tr>';
		    $result.='<td colspan="'.count($iconos).'" >'.(($formNew)?'<form method="post"><input type="hidden" value="formNew" name="accion"/><button class = "btn btn-sm btn-success"><i title="Agregar Registro" class="fa fa-plus-circle"></i></button></form>':"&nbsp;").'</td>';

		    for($c=0; $c < $this->numeCampos();$c++){
		    $campo=$this->infoCampo($c);

			/*if($campo->name != "tipo_cuestionario"){
				$result.='<td>'.$campo->name.'</td>';
			}**/
		    $result.='<td>'.$campo->name.'</td>';
		    }
		    $result.='</tr>';

			for ($i=0; $i < $this->numeroRegistros; $i++) { 
				$registro=$this->traeRegistro();
				//echo var_dump($registro);

				$result.='<tr>';

				// por es un refiere a "Por asignar" solo que en la base de datos solo se pueden guardar 3 caracteres

				if($registro[8] == "S/A"){
					// S/A = Sin asignar
					// si el tipo de cuestionario aun no esta definido

					foreach ($iconos as $value) {
						switch ($value) {
	
							case 'cuestionario':
							
								$result.='<td width="6%">
								<form method="post" action="cuestionario.php">
								<input type="hidden" value="'.$value.'" name="accion">
								<input type="hidden" value="'.$registro[0].'" name="idRegistro">
								<button type="button" disabled class="btn btn-warning">
								<i title="Cuestionario" class="fa fa-list-alt"></i>
								</button>
								</form>
								</td>';
								
								break;	
						}
						
					}
					
				}else{
					foreach ($iconos as $value) {
						switch ($value) {
	
							case 'cuestionario':
							
								$result.='<td width="6%">
								<form method="post" action="cuestionario.php">
								<input type="hidden" value="'.$value.'" name="accion">
								<input type="hidden" value="'.$registro[0].'" name="idRegistro">
								<button class="btn btn-warning">
								<i title="Cuestionario" class="fa fa-list-alt"></i>
								</button>
								</form>
								</td>';
								break;	
						}
						
					}
				}
				
		        
		        

				for ($col=0; $col < count($registro); $col++) { 
					$result.='<td>'.$registro[$col].'</td>';
					
				}$result.='</tr>';
				
			}
			$result.='</table>';
		    return $result;
		}
	}

// construccion de objeto
$oTickets = new Tickets();

// echo var_dump($_REQUEST['accion']);
// enseguida puedo ejecutar una opcion
if (isset($_REQUEST['accion'])) // se ejecuta si se esta recibiendo una accion

	// como el switch se programo con un return a continucaion se agrega echo
	echo $oTickets->proceso($_REQUEST['accion']);
	
else
	// echo 'se incluyo bien el archivo';
	echo $oTickets->proceso("list");

// yo sobre este recurso puedo recibir sobre get o post

?>