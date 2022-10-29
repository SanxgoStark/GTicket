
<?

/**
 * MODELO , CONTROLADOR
 */

// las sesiones es el ecanismo de asegurarnos que el usuario se logeo correctamente

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

		// $nomb_emp = $_POST["nomb_emp"];

		// que quiero hacer con esta tabla
		function proceso($accion){
			// echo "pase por proceso";

			$result=""; // variable para acumular el resultado
			switch ($accion) {
                
                // metodo para caja de busqueda de tickets (barra)
                case 'buscar':
					//echo "entre";
					$consulta ="SELECT T.id as Ticket,fecha_creacion_ticket as Creado,fecha_modificacion_ticket as Modificado,asunto_ticket as Asunto,estatus_ticket as Estatus,prioridad_ticket as Prioridad,nivel_ticket as Nivel, CONCAT(nombre_empleado,' ',apellido_paterno) as Atiende FROM tickets T
                    join empleados E ON E.id = T.empledo_asignado_id where estatus_ticket like '%".$_REQUEST['ticket']."%' order by estatus_ticket";
					$this->consulta($consulta);

					$result=$this->imprimeTabla($consulta,true,array("formupdate","delete"));


				break;

				case 'insert':
				
				echo var_dump($_POST);
				exit;
				// echo var_dump($_POST['idRegistro']);

				// armado de cadena de insersion
					$cad='INSERT INTO tickets 
					(nomb_emp,apepat_emp,apemat_emp,direccion_emp,nss_emp,fechanac_emp,genero_emp,telnum_emp,sueldo_emp,curp_emp) 
					values("'.$_POST["nomb_emp"].'","'.$_POST['apepat_emp'].'","'.$_POST['apemat_emp'].'","'.$_POST['direccion_emp'].'","'.$_POST['nss_emp'].'","'.$_POST['fechanac_emp'].'","'.$_POST['genero_emp'].'","'.$_POST['telnum_emp'].'","'.$_POST['sueldo_emp'].'","'.$_POST['curp_emp'].'")';



					//ejecuta la cadena
					$this->consulta($cad);
					// se llama a funcion que crea usuario con el mismo id que el 
					// empleado y ademas crea la relacion de usuario con empleado
					$this->creausuario();
					$result.=$this->proceso('list');
					
					break;

				// listado que me permite hacer cosas	
				case 'list': 

				// $cad = "SELECT IdFactura,`IdCita`,EF.Estatus, FP.FormaPago, `Descripcion` from `facturacion` F  
				// INNER JOIN `estatusfactura` EF ON F.`IdEstatus` = EF.`IdEstatusFactura`
				// INNER JOIN `formapago` FP ON F.`idFormaPago` = FP.`IdFormaPago`ORDER BY IdFactura";

				//$cad = "SELECT E.Id,CONCAT(nombre_emp,' ',apellidop_emp,' ',apellidom_emp)as Empleado,direccion_emp as Direccion,fechanac_emp as Nacimiento,telnum_emp as Telefono,nomb_usua as Usuario,nomb_rol as Rol FROM empleado E
    				//join usuario_emp U ON E.Id = U.Id join usuario US ON U.fk_id_usua = US.Id join rol R ON US.fk_id_rol = R.Id ORDER BY E.Id";

                //$cad = "select * from ticket";
				
                $cad = "SELECT T.id as Ticket,fecha_creacion_ticket as Creado,fecha_modificacion_ticket as Modificado,asunto_ticket as Asunto,estatus_ticket as Estatus,prioridad_ticket as Prioridad,nivel_ticket as Nivel, CONCAT(nombre_empleado,' ',apellido_paterno) as Atiende FROM tickets T
                    join empleados E ON E.id = T.empledo_asignado_id";


					$result=$this->imprimeTabla($cad,true,array("formupdate","delete","cuestionario"));

					break;

				case 'delete':
					$this->consulta("DELETE FROM tickets WHERE Id ='".$_POST['idRegistro']."'");

					$result.= $this->proceso('list');
					break;
				
				case 'update':

					// armado de cadena de insersion
					$cad = 'UPDATE tickets SET fecha_creacion_ticket ="'.$_POST["fecha_creacion_ticket"].'", 
								fecha_modificacion_ticket="'.$_POST['fecha_modificacion_ticket'].'",
											asunto_ticket="'.$_POST['asunto_ticket'].'",
									  descripcion_ticket="'.$_POST['descripcion_ticket'].'",
									  estatus_ticket="'.$_POST['estatus_ticket'].'",
									  prioridad_ticket="'.$_POST['prioridad_ticket'].'",
									  autor_id="'.$_POST['autor_id'].'",
									  empleado_asignado_id="'.$_POST['empleado_asignado_id'].'",
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

					// Update para usuario
					$this->updateUsuario();


					$result.=$this->proceso('list');



					break;

				case 'formupdate':
					//$registro=$this->sacaTupla("SELECT * FROM empleado WHERE Id=".$_POST['idRegistro']); 

					// registro usuario
					$registro=$this->sacaTupla("SELECT * FROM tickets WHERE id=".$_POST['idRegistro']);

				case 'formNew':
					//echo "formNew";
					//var_dump($registro);
					//exit;
					$result.='<div class="" style="margin-top:">
					<form method="post">';
					if (isset($registro))
						$result.='
					<input type="hidden" name="accion" value="update">
					<input type="hidden" name="idRegistro" value="'.$registro['id'].'">';
					else
						$result.='
					<input type="hidden" name="accion" value="insert">';
					$result.='

					<div style="background-color:;height:auto;float:left;width:50%">

					<div class="content-flexbox" style="background-color:;height:auto;float:left;width:100%">

						<div style="background-color:;height:auto;width:32.3%;display:inline-block;">
							<div>
							<input readonly="readonly" placeholder="F.Creacion" required="" type="text" name="fecha_creacion_ticket" class="form-control" value="'.(isset($registro)?$registro['fecha_creacion_ticket']:"").'">
							</div>
						</div>
						<div style="background-color:;height:auto;width:32.3%;display:inline-block;">
							<div>
							<input readonly="readonly" placeholder="F.Modificacion" required="" type="text" name="fecha_modificacion_ticket" class="form-control" value="'.(isset($registro)?$registro['fecha_modificacion_ticket']:"").'">
							</div>
						</div>
						<div  style=";background-color:;height:auto;width:31.3%;float:right;">
							<div style="height:55px;margin-top:15px">
								<h4 style="font-weight: 900; margin-top:" align="center">NT: "'.(isset($registro)?$registro['id']:" ").'"</h4>
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

					<label style="margin-top:10px" class="col-md-3">Estatus * </label>
					<div style="margin-top:10px" class="col-md-8">
					<div class="form-group">
						<select class="form-select" name="estatus_ticket">
							<option value="Abierto">Abierto</option>
							<option value="Cerrado">Cerrado</option>
						</select>
						</div>
					</div>

					<label style="margin-top:10px" class="col-md-3">Prioridad * </label>
					<div style="margin-top:10px" class="col-md-8">
					<div class="form-group">
						<select class="form-select" name="prioridad_ticket">
							<option value="Normal">Normal</option>
							<option value="Media">Media</option>
							<option value="Alta">Alta</option>
						</select>
						</div>
					</div>

					<label style="margin-top:10px" class="col-md-3">Atiende * </label>
					<div style="margin-top:10px" class="col-md-8">
					<div class="col-md-8">';
					$result.=$this->cajaDesplegable("usuarios","empleado_asignado_id","id","nombre_usuario",isset($registro)?$registro['empleado_asignado_id']:"");
					$result.='
					</div>
					</div>

					

					<label style="margin-top:10px" class="col-md-3">Nivel Soporte * </label>
					<div style="margin-top:10px" class="col-md-8">
					<div class="form-group">
						<select class="form-select" name="nivel_ticket">
							<option value="N1">N1</option>
							<option value="N2">N2</option>
						</select>
						</div>
					</div>

					<label style="margin-top:10px" class="col-md-3" class="form-group">Nota * </label>
					<div style="margin-top:10px" class="col-md-8">
      				<textarea type="text" name="nota_ticket" class="form-control" value="'.(isset($registro)?$registro['nota_ticket']:"").'" rows="2"></textarea>
					</div>

					<small style="margin-top:10px" >* Campo Obligatorio</small><br>

    				<div style="float:right;width:500px;margin-top:3%" class="form-group">
      				<input class="form-control" type="file" name="formFile">
   					</div>

					</div>
					</div>
					</div>
					</div>
					</div>


					<div style="background-color:;height:auto;float:right;width:50%">

						<div style="background-color:;height:50%;float:top;width:auto;">
							<div style="margin-top:"class="">
							<div style="margin-left:9%" class="col-md-10">
							<div class="row">

								<label class="col-md-3">Nombre Equipo * </label>
								<div class="col-md-8">
								<input placeholder="Nombre Equipo" required="" type="text" name="nombre_equipo_ticket" class="form-control" value="'.(isset($registro)?$registro['nombre_equipo_ticket']:"").'">
								</div>

								<label style="margin-top:10px" class="col-md-3">Fabricante * </label>
								<div style="margin-top:10px" class="col-md-8">
								<div class="form-group">
									<select class="form-select" name="fabricante_ticket">
										<option value="HP">HP</option>
										<option value="DELL">DELL</option>
										<option value="Otro">Otro</option>
									</select>
									</div>
								</div>

								<label style="margin-top:10px" class="col-md-3">Modelo * </label>
								<div style="margin-top:10px" class="col-md-8">
								<div class="form-group">
									<select class="form-select" name="modelo_equipo_ticket">
										<option value="N1XZS2">N1XZS2</option>
										<option value="67FR">67FR</option>
									</select>
									</div>
								</div>

								<label style="margin-top:10px" class="col-md-3">S.O * </label>
								<div style="margin-top:10px" class="col-md-8">
								<div class="form-group">
									<select class="form-select" name="sistema_operativo_ticket">
										<option value="Windows 7 Enterprise">Windows 7 Enterprise</option>
										<option value="Windows 10 Pro">Windows 10 Pro</option>
										<option value="Windows 10 Home">Windows 10 Home</option>
										<option value="Windows 10 Enterprise">Windows 10 Enterprise</option>
										<option value="Windows 11 Pro">Windows 11 Pro</option>
									</select>
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
					

									<label class="form-label mt-4">Tipo de cuestionario</label>
									<div class="col-md-8">
									<div class="form-group">
										<select class="form-select" name="tipo_cuestionario">
											<option value="CCP">CCP</option>
											<option value="SO">SO</option>
											<option value="RED">RED</option>
											<option value="CP">CP</option>
											<option value="SEG">SEG</option>
											<option value="IMP">IMP</option>
											<option value="SOF">SOF</option>
										</select>
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
								<div class="form-group">
									<select class="form-select" name="tipo_conexion_ticket">
										<option value="Alambrica">Alambrica</option>
										<option value="Inalambrica">Inalambrica</option>
									</select>
									</div>
								</div>

								<label class="form-label mt-4">¿Que aplicacion usaba cuando sucedio el error?</label>
								<div class="col-md-8">
								<div class="form-group">
									<select class="form-select" name="nombre_aplicacion_ticket">
										<option value="Word">Word</option>
										<option value="Excel">Excel</option>
										<option value="Powerpoint">Power Point</option>
										<option value="SAP">SAP</option>
										<option value="JBA">JBA</option>
										<option value="Nonconformance">Nonconformance</option>
									</select>
									</div>
								</div>

								<label class="form-label mt-4">¿A instalado drivers o actualizaciones recientemente?</label>
								<div class="col-md-8">
									<div class="form-group">
									<select class="form-select" name="si_driver_update">
									<option value="Si">Si</option>
									<option value="No">No</option>
									</select>
									</div>
								</div>

							</div>
							</div>
							
							</div>

							

						</div>

					
					</div>

					<div style="background-color:;margin-top:30%">
						<div style="background-color:;margin-left: 80%;width: 313px;">
							<input style=";margin-left:; aling:" type="submit" class="btn btn-secondary" value="Guardar">
							<button style="margin-left:50px;width: auto" type="button" class="btn btn-secondary"><a href="../admin/home_admin.php">Cancelar</a></button>	
						</div>
					</div>
					
					</form>
					
					</div>';

					//echo var_dump($_POST);
					
					break;

			}
			// puede retirnar el resultado o imprimirlo con echo
			return $result;
		}

		function updateUsuario(){
			$cad = 'UPDATE usuario SET nomb_usua="'.$_POST["nomb_usua"].'",
									   pass_usua="'.$_POST["pass_usua"].'",
									   fk_id_rol="'.$_POST["fk_id_rol"].'",
									   clave_cancelv="'.$_POST["clave_cancelv"].'"
			WHERE Id = "'.$_POST["idRegistro"].'"';
			$res = $this->consult($cad);
		}

		// funcion para obtener el ultimo empleado
		function maxempleado(){
			$cad="SELECT * FROM empleado ORDER BY Id DESC LIMIT 1";


			$res = $this->consult($cad);
			// echo var_dump($res);

			// volcar datos, provenientes de una consulta mysql, dentro de un array php
			$volcadoarray = mysqli_fetch_array($res);
			$maxemp = $volcadoarray['Id'];

			return $maxemp;
		}

		function creausuario(){

			// id maximo de empleado
			$maximoemp=$this->maxempleado();

			// echo var_dump($maxemp);

			$cad='INSERT INTO usuario 
			(Id,nomb_usua,pass_usua,fk_id_rol,clave_cancelv) 
				values('.$maximoemp.',"'.$_POST["nomb_usua"].'","'.$_POST["pass_usua"].'","'.$_POST["fk_id_rol"].'","'.$_POST["clave_cancelv"].'")';

					//ejecuta la cadena
					$this->consulta($cad);

					// creaciond e relacion usuario empleado
					// en empleado como en usuario se creo anterior mente un
					// registro con el mismo id, ahora se utliza el mismo id
					// para la relacion 
					$this->usuario_emp($maximoemp,$maximoemp);

					
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
		        		
		        			$result.='<td width="6%">
		        			<form method="post">
		        			<input type="hidden" value="'.$value.'" name="accion">
		        			<input type="hidden" value="'.$registro[0].'" name="idRegistro">
		        			<button class="btn btn-warning">
		        			<i title="Editar registro" class="fa fa-list-alt"></i>
		        			</button>
		        			</form>
		        			</td>';
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