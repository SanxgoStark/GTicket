
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
					$cad = 'UPDATE empleado SET nomb_emp ="'.$_POST["nomb_emp"].'", 
											apepat_emp="'.$_POST['apepat_emp'].'",
											apemat_emp="'.$_POST['apemat_emp'].'",
									  direccion_emp="'.$_POST['direccion_emp'].'",
									  nss_emp="'.$_POST['nss_emp'].'",
									  fechanac_emp="'.$_POST['fechanac_emp'].'",
									  genero_emp="'.$_POST['genero_emp'].'",
									  telnum_emp="'.$_POST['telnum_emp'].'",
									  sueldo_emp="'.$_POST['sueldo_emp'].'",
									  curp_emp="'.$_POST['curp_emp'].'"
					WHERE Id = "'.$_POST["idRegistro"].'"';

					//ejecuta la cadena
					$this->consulta($cad);

					// Update para usuario
					$this->updateUsuario();


					$result.=$this->proceso('list');



					break;

				case 'formupdate':
					$registro=$this->sacaTupla("SELECT * FROM empleado WHERE Id=".$_POST['idRegistro']); 

					// registro usuario
					$registrou=$this->sacaTupla("SELECT * FROM usuario WHERE Id=".$_POST['idRegistro']);

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

					<div style="background-color:lightgrey;height:auto;float:left;width:50%">

					<div class="content-flexbox" style="background-color:;height:auto;float:left;width:100%">

						<div style="background-color:;height:auto;width:32.3%;display:inline-block;">
							<div>
							<input readonly="readonly" placeholder="F.Creacion" required="" type="text" name="nomb_emp" class="form-control" value="'.(isset($registro)?$registro['nomb_emp']:"").'">
							</div>
						</div>
						<div style="background-color:;height:auto;width:32.3%;display:inline-block;">
							<div>
							<input readonly="readonly" placeholder="F.Modificacion" required="" type="text" name="nomb_emp" class="form-control" value="'.(isset($registro)?$registro['nomb_emp']:"").'">
							</div>
						</div>
						<div style="text-align: center; background-color:lightgrey;height:auto;width:31.3%;float:right;">
							<div style="height:55px;">
								<h4 text-align="center" style="">NT:00000001</h4>
							</div>
						</div>

					</div>

					<div style="margin-top:8%"class="">

					<div style="margin-left:9%" class="col-md-10">
					<div class="row">

					<label class="col-md-3">Asunto * </label>
					<div class="col-md-8">
					<input placeholder="Asunto" required="" type="text" name="nomb_emp" class="form-control" value="'.(isset($registro)?$registro['nomb_emp']:"").'">
					</div>

					<label class="col-md-3">Descripcion * </label>
					<div class="col-md-8">
					<input placeholder="Descripcion" required="" type="text" name="apepat_emp" class="form-control" value="'.(isset($registro)?$registro['apepat_emp']:"").'">
					</div>

					<label class="col-md-3">Estatus * </label>
					<div class="col-md-8">
					<div class="form-group">
						<select class="form-select" id="exampleSelect1">
							<option>Abierto</option>
							<option>Cerrado</option>
						</select>
						</div>
					</div>

					<label class="col-md-3">Prioridad * </label>
					<div class="col-md-8">
					<div class="form-group">
						<select class="form-select" id="exampleSelect1">
							<option>Normal</option>
							<option>Media</option>
							<option>Alta</option>
						</select>
						</div>
					</div>

					<label class="col-md-3">Atiende * </label>
					<div class="col-md-8">
					<div class="form-group">
						<select class="form-select" id="exampleSelect1">
							<option>Normal</option>
							<option>Media</option>
							<option>Alta</option>
						</select>
						</div>
					</div>

					<label class="col-md-3">Nivel Soporte * </label>
					<div class="col-md-8">
					<div class="form-group">
						<select class="form-select" id="exampleSelect1">
							<option>N1</option>
							<option>N2</option>
						</select>
						</div>
					</div>

					<label class="col-md-3" class="form-group">Nota * </label>
					<div class="col-md-8">
      				<textarea class="form-control" id="exampleTextarea" rows="2"></textarea>
					</div>

    				<div class="form-group">
      				<input class="form-control" type="file" id="formFile">
   					</div>

					<small>* Campo Obligatorio</small><br>
					
					

					

					</div>
					</div>
					</div>
					</div>
					</div>


					<div style="background-color:pink;height:auto;float:right;width:50%">

						<div style="background-color:grey;height:50%;float:top;width:auto;">
							<div style="margin-top:"class="">
							<div style="margin-left:9%" class="col-md-10">
							<div class="row">

								<label class="col-md-3">Nombre Equipo * </label>
								<div class="col-md-8">
								<input placeholder="Nombre Equipo" required="" type="text" name="apepat_emp" class="form-control" value="'.(isset($registro)?$registro['apepat_emp']:"").'">
								</div>

								<label class="col-md-3">Fabricante * </label>
								<div class="col-md-8">
								<div class="form-group">
									<select class="form-select" id="exampleSelect1">
										<option>HP</option>
										<option>DELL</option>
										<option>Otro</option>
									</select>
									</div>
								</div>

								<label class="col-md-3">Modelo * </label>
								<div class="col-md-8">
								<div class="form-group">
									<select class="form-select" id="exampleSelect1">
										<option>N1XZS2</option>
										<option>67FR</option>
									</select>
									</div>
								</div>

								<label class="col-md-3">S.O * </label>
								<div class="col-md-8">
								<div class="form-group">
									<select class="form-select" id="exampleSelect1">
										<option>Windows 7 Enterprise</option>
										<option>Windows 10 Pro</option>
										<option>Windows 10 Home</option>
										<option>Windows 10 Enterprise</option>
										<option>Windows 11 Pro</option>
									</select>
									</div>
								</div>

							</div>
							</div>
							</div>

						</div>

						<div style=";background-color:yellow;height:50%;float:top;width:auto">

							<div style="margin-top:"class="">
							<div style="margin-left:9%" class="col-md-10">
							<div class="row">

							<label class="form-label mt-4">¿Que tipo de conexion tiene actualmente?</label>
								<div class="col-md-8">
								<div class="form-group">
									<select class="form-select" id="exampleSelect1">
										<option>Si</option>
										<option>No</option>
									</select>
									</div>
								</div>

								<label class="form-label mt-4">¿Que aplicacion usaba cuando sucedio el error?</label>
								<div class="col-md-8">
								<div class="form-group">
									<select class="form-select" id="exampleSelect1">
										<option>HP</option>
										<option>DELL</option>
										<option>Otro</option>
									</select>
									</div>
								</div>

								<label class="form-label mt-4">¿A instalado drivers o actualizaciones recientemente?</label>
								<div class="col-md-8">
									<div class="form-group">
									<select class="form-select" id="exampleSelect1">
									<option>Si</option>
									<option>No</option>
									</select>
									</div>
								</div>

							</div>
							</div>
							</div>

						</div>

					
					</div>

					<div style="background-color:;margin-top:10%">
						<div style="background-color:;margin-left: 80%;width: 313px;">
							<input style=";margin-left:; aling:" type="submit" class="btn btn-secondary" value="Guardar">
							<button style="margin-left:50px;width: auto" type="button" class="btn btn-secondary"><a href="../admin/gestion_emp.php">Cancelar</a></button>	
						</div>
					</div>
					
					</form>
					
					</div>';
					
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