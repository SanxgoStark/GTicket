
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
					$cad='INSERT INTO empleado 
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


					$result=$this->imprimeTabla($cad,true,array("formupdate","delete"));

					break;

				case 'delete':
					$this->consulta("DELETE FROM empleado WHERE Id ='".$_POST['idRegistro']."'");

					$this->consulta("DELETE FROM usuario WHERE Id ='".$_POST['idRegistro']."'");

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
					$result.='<div class="container" style="margin-top:40px">
					<form method="post">';
					if (isset($registro))
						$result.='
					<input type="hidden" name="accion" value="update">
					<input type="hidden" name="idRegistro" value="'.$registro['Id'].'">';
					else
						$result.='
					<input type="hidden" name="accion" value="insert">';
					$result.='
					<div class="row mt-4">

					<div class="col-md-6">
					<div class="row">

					<label class="col-md-4">Nombre * </label>
					<div class="col-md-8">
					<input placeholder="Nombre" required="" type="text" name="nomb_emp" class="form-control" value="'.(isset($registro)?$registro['nomb_emp']:"").'">
					</div>

					<label class="col-md-4">Primer Apellido * </label>
					<div class="col-md-8">
					<input placeholder="Apellido Paterno" required="" type="text" name="apepat_emp" class="form-control" value="'.(isset($registro)?$registro['apepat_emp']:"").'">
					</div>

					<label class="col-md-4">Segundo Apellido * </label>
					<div class="col-md-8">
					<input placeholder="Apellido materno" required="" type="text" name="apemat_emp" class="form-control" value="'.(isset($registro)?$registro['apemat_emp']:"").'">
					</div>

					<label class="col-md-4">Direccion * </label>
					<div class="col-md-8">
					<input placeholder="Ingrese su direccion" required="" type="text" name="direccion_emp" class="form-control" value="'.(isset($registro)?$registro['direccion_emp']:"").'">
					</div>

					<label class="col-md-4">NSS * </label>
					<div class="col-md-8">
					<input placeholder="Ingrese su NSS" required="" type="text" name="nss_emp" class="form-control" value="'.(isset($registro)?$registro['nss_emp']:"").'">
					</div>

					<label class="col-md-4">Nacimiento * </label>
					<div class="col-md-8">
					<input placeholder="Ingrese su año de nacimiento" required="" type="date" name="fechanac_emp" class="form-control" value="'.(isset($registro)?$registro['fechanac_emp']:"").'">
					</div>

					<label class="col-md-4">Genero * </label>
					<div class="col-md-8">
					<input placeholder="Ingrese su genero" required="" type="text" name="genero_emp" class="form-control" value="'.(isset($registro)?$registro['genero_emp']:"").'">
					</div>

					<label class="col-md-4">Telefono * </label>
					<div class="col-md-8">
					<input placeholder="Ingrese su genero" required="" type="text" name="telnum_emp" class="form-control" value="'.(isset($registro)?$registro['telnum_emp']:"").'">
					</div>

					<label class="col-md-4">Sueldo * </label>
					<div class="col-md-8">
					<input placeholder="Ingrese su sueldo" required="" type="num" name="sueldo_emp" class="form-control" value="'.(isset($registro)?$registro['sueldo_emp']:"").'">
					</div>

					<label class="col-md-4">CURP * </label>
					<div class="col-md-8">
					<input placeholder="Ingrese su CURP" required="" type="text" name="curp_emp" class="form-control" value="'.(isset($registro)?$registro['curp_emp']:"").'">
					</div>

					<label class="col-md-4">Usuario * </label>
					<div class="col-md-8">
					<input placeholder="Ingrese su CURP" required="" type="text" name="nomb_usua" class="form-control" value="'.(isset($registrou)?$registrou['nomb_usua']:"").'">
					</div>

					<label class="col-md-4">Contraseña * </label>
					<div class="col-md-8">
					<input placeholder="Ingrese su CURP" required="" type="text" name="pass_usua" class="form-control" value="'.(isset($registrou)?$registrou['pass_usua']:"").'">
					</div>

					<label class="col-md-4">Rol * </label>
					<div class="col-md-8">';
					$result.=$this->cajaDesplegable("rol","fk_id_rol","Id","nomb_rol",isset($registrou)?$registrou["fk_id_rol"]:0);
					$result.='
					</div>

					<label class="col-md-4">Clave X * </label>
					<div class="col-md-8">
					<input placeholder="Ingrese su CURP" required="" type="text" name="clave_cancelv" class="form-control" value="'.(isset($registrou)?$registrou['clave_cancelv']:"").'">
					</div>

					</div>
					</div>
					</div>
					

					<small>* Campo Obligatorio</small><br>
	
					

					<input style="margin-top:10px" type="submit" value="'.((isset($registro))?"Actualizar":"Registrar").'">
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