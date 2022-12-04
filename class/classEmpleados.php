
<?

/**
 * MODELO , CONTROLADOR
 */

// las sesiones es el ecanismo de asegurarnos que el usuario se logio correctamente

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
	class Empleados extends BaseDatos // clase referente a tabla espacios en la base de datos
	{
		// al poner extends la tabla podra heredar el conportamiento de la calse BaseDatos
		
		// funcion constructor por defecto
		function __construct(){}

		// que quiero hacer con esta tabla
		function proceso($accion){

			$result=""; // variable para acumular el resultado
			switch ($accion) {

				// metodo para caja de busqueda de empleados (barra)
                case 'buscar':

					$consulta = "SELECT E.id,nombre_empleado as Nombre,apellido_paterno as Apellido_P,apellido_materno as Apellido_M,titulo_empleado as Titulo,numero_telefono as Telefono,correo_empleado as Correo,D.nombre_departamento as Departamento FROM empleados E
					INNER JOIN `departamentos` D ON E.`departamento_id` = D.`id` where (titulo_empleado like '%".$_REQUEST['empleado']."%' OR CONCAT(nombre_empleado,' ',apellido_paterno) like '%".$_REQUEST['empleado']."%') AND (estado_empleado = 0) order by id";
					$this->consulta($consulta);

					$result=$this->imprimeTabla($consulta,true,array("formupdate","delete","formuser"));

				break;

				case 'insert':

				// armado de cadena de insersion
					$cad='INSERT INTO empleados 
					(nombre_empleado,apellido_paterno,apellido_materno,titulo_empleado,numero_telefono,correo_empleado,departamento_id) 
					values("'.$_POST["nombre_empleado"].'","'.$_POST['apellido_paterno'].'","'.$_POST['apellido_materno'].'","'.$_POST['titulo_empleado'].'","'.$_POST['numero_telefono'].'","'.$_POST['correo_empleado'].'","'.$_POST['departamento_id'].'")';

					//ejecuta la cadena
					$this->consulta($cad);
					// se llama a funcion que crea usuario con el mismo id que el 
					// empleado y ademas crea la relacion de usuario con empleado
					//$this->creausuario();------------------------------------------ importante
					$result.=$this->proceso('list');
					
					break;

				// listado
				case 'list': 

				$cad = "SELECT E.id,nombre_empleado as Nombre,apellido_paterno as Apellido_P,apellido_materno as Apellido_M,titulo_empleado as Titulo,numero_telefono as Telefono,correo_empleado as Correo,D.nombre_departamento as Departamento FROM empleados E
				INNER JOIN `departamentos` D ON E.`departamento_id` = D.`id` WHERE estado_empleado = 0 ORDER BY E.id";

					$result=$this->imprimeTabla($cad,true,array("formupdate","delete","formuser"));

					break;

				case 'delete':
					//$this->consulta("DELETE FROM empleados WHERE id ='".$_POST['idRegistro']."'");

					$cad = 'UPDATE empleados SET estado_empleado = 1 WHERE id = "'.$_POST["idRegistro"].'"';

					//ejecuta la cadena
					$this->consulta($cad);

					$result.= $this->proceso('list');
					break;
		
				case 'update':

					// armado de cadena de insersion
					$cad = 'UPDATE empleados SET nombre_empleado ="'.$_POST["nombre_empleado"].'", 
											apellido_paterno="'.$_POST['apellido_paterno'].'",
											apellido_materno="'.$_POST['apellido_materno'].'",
									  titulo_empleado="'.$_POST['titulo_empleado'].'",
									  numero_telefono="'.$_POST['numero_telefono'].'",
									  correo_empleado="'.$_POST['correo_empleado'].'",
									  departamento_id="'.$_POST['departamento_id'].'"
					WHERE id = "'.$_POST["idRegistro"].'"';

					//ejecuta la cadena
					$this->consulta($cad);

					$result.=$this->proceso('list');

					break;

				case 'insertuser':

					// se llama a funcion que crea usuario con el mismo id que el 
					// empleado y ademas crea la relacion de usuario con empleado
					$this->creausuario();

					$result.=$this->proceso('list');
					break;

				case 'updateuser':
					//echo "entre a updateuser";
					//echo $_SESSION['password_usuarioold'];
					//echo "/----/";
					//echo $_POST['password_usuario'];
					//exit;

					// se compara el password, si fue modificado agrega la incriptacion MD5 al password y lo almacena en la bd
					if($_SESSION['password_usuarioold'] !== $_POST['password_usuario']){
						//echo "la contraseña es diferente a la anterior";
						$cad = 'UPDATE usuarios SET nombre_usuario ="'.$_POST["nombre_usuario"].'", 
						password_usuario=MD5("'.$_POST['password_usuario'].'"),
						rol_id="'.$_POST['rol_id'].'"WHERE id = "'.$_POST["idRegistro"].'"';
					}else{
						//echo "la contraseña no es diferente de la anterior";
						$cad = 'UPDATE usuarios SET nombre_usuario ="'.$_POST["nombre_usuario"].'", 
						password_usuario="'.$_POST['password_usuario'].'",
						rol_id="'.$_POST['rol_id'].'"WHERE id = "'.$_POST["idRegistro"].'"';
					}
					
					//ejecuta la cadena
					$this->consulta($cad);

					$result.=$this->proceso('list');
					break;
 
					
				case 'formuser':

					$registro=$this->sacaTupla("SELECT * FROM usuarios WHERE id=".$_POST['idRegistro']);
					//var_dump($registro);
					// seccion para comprobar si $registro['password_usuario'] contiene algo
					if(isset($registro['password_usuario'])){
						// si contiene algo lo salva en una variable de sesion
						$_SESSION['password_usuarioold'] = $registro['password_usuario'];
					}
					
					//echo $_SESSION['password_usuarioold'];
					//var_dump($_SESSION);
					
					//echo $_POST['idRegistro']; // id del empleado
					//echo var_dump($registro);
					// caso para form de creacion de nuevo usuario
					$result.='<div class="" style="margin-top:40px;margin-left:1%;margin-right:1%">
					<form method="post">';
					if (isset($registro))
						$result.='
					<script>document.getElementById("cabecera").innerHTML = "<h2>Modificacion Usuario</h2>";</script>
					<input type="hidden" name="accion" value="updateuser">
					<input type="hidden" name="idRegistro" value="'.$registro['id'].'">';
					
					else
					$result.='
					<script>document.getElementById("cabecera").innerHTML = "<h2>Nuevo Usuario</h2>";</script>
					<input type="hidden" name="accion" value="insertuser">';
					$result.='
					<div class="row mt-4">

					<div class="col-md-6">
					<div class="row">

					<label class="col-md-4">Usuario * </label>
					<div class="col-md-8">
					<input placeholder="Usuario" required="" type="text" name="nombre_usuario" class="form-control" value="'.(isset($registro)?$registro['nombre_usuario']:"").'">
					</div>

					<label class="col-md-4">Password * </label>
					<div class="col-md-8">
					<input placeholder="Password" required="" type="text" name="password_usuario" class="form-control" value="'.(isset($registro)?$registro['password_usuario']:"").'">
					</div>

					<label class="col-md-4">Rol * </label>
					<div class="col-md-8">';
					$result.=$this->cajaDesplegable("roles","rol_id","id","nombre_rol",isset($registro)?$registro['rol_id']:"");
					$result.='
					</div>

					</div>
					</div>
					</div>
					

					<small>* Campo Obligatorio</small><br>
	
					

					<div style="background-color:;margin-top:22%">
						<div style="background-color:;margin-left: 80%;width: 313px;">
							<input style=";margin-left:; aling:" type="submit" class="btn btn-secondary" value="Guardar">
							<button style="margin-left:50px;width: auto" type="button" class="btn btn-secondary"><a href="../admin/gestion_emp.php">Cancelar</a></button>	
						</div>
					</div>

					</form>
					</div>';
					
					break;

				case 'formupdate':

					$registro=$this->sacaTupla("SELECT * FROM empleados WHERE id=".$_POST['idRegistro']); 

				case 'formNew':
					
					$result.='<div class="" style="margin-top:40px;margin-left:1%;margin-right:1%">
					<form method="post">';
					if (isset($registro))
						$result.='

						<script>document.getElementById("cabecera").innerHTML = "<h2>Modificacion Empleado</h2>";</script>

					<input type="hidden" name="accion" value="update">
					<input type="hidden" name="idRegistro" value="'.$registro['id'].'">';
					else
						$result.='
					<script>document.getElementById("cabecera").innerHTML = "<h2>Nuevo Empleado</h2>";</script>
					<input type="hidden" name="accion" value="insert">';
					$result.='
					<div class="row mt-4">

					<div class="col-md-6">
					<div class="row">

					<label class="col-md-4">Nombre * </label>
					<div class="col-md-8">
					<input placeholder="Nombre" required="" type="text" name="nombre_empleado" class="form-control" value="'.(isset($registro)?$registro['nombre_empleado']:"").'">
					</div>

					<label class="col-md-4">Apellido P.* </label>
					<div class="col-md-8">
					<input placeholder="Apellido Paterno" required="" type="text" name="apellido_paterno" class="form-control" value="'.(isset($registro)?$registro['apellido_paterno']:"").'">
					</div>

					<label class="col-md-4">Apellido M.* </label>
					<div class="col-md-8">
					<input placeholder="Apellido materno" required="" type="text" name="apellido_materno" class="form-control" value="'.(isset($registro)?$registro['apellido_materno']:"").'">
					</div>

					<label class="col-md-4">Titulo* </label>
					<div class="col-md-8">
					<input placeholder="Ingrese su titulo" required="" type="text" name="titulo_empleado" class="form-control" value="'.(isset($registro)?$registro['titulo_empleado']:"").'">
					</div>

					<label class="col-md-4">Telefono* </label>
					<div class="col-md-8">
					<input placeholder="Ingrese su telefono" required="" type="text" name="numero_telefono" class="form-control" value="'.(isset($registro)?$registro['numero_telefono']:"").'">
					</div>

					<label class="col-md-4">Correo* </label>
					<div class="col-md-8">
					<input placeholder="Ingrese su correo" required="" type="text" name="correo_empleado" class="form-control" value="'.(isset($registro)?$registro['correo_empleado']:"").'">
					</div>

					<label class="col-md-4">Departamento * </label>
					<div class="col-md-8">';
					$result.=$this->cajaDesplegable("departamentos","departamento_id","id","nombre_departamento",isset($registro)?$registro['departamento_id']:"");
					$result.='
					</div>

					</div>
					</div>
					</div>
					

					<small>* Campo Obligatorio</small><br>
	
					
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
			$cad="SELECT * FROM empleadoS ORDER BY Id DESC LIMIT 1";


			$res = $this->consult($cad);
			// echo var_dump($res);

			// volcar datos, provenientes de una consulta mysql, dentro de un array php
			$volcadoarray = mysqli_fetch_array($res);
			$maxemp = $volcadoarray['id'];

			return $maxemp;
		}

		function creausuario(){

			// id maximo de empleado
			$maximoemp=$this->maxempleado();

			// echo var_dump($maxemp);

			$cad='INSERT INTO usuarios 
			(id,nombre_usuario,password_usuario,rol_id) 
				values('.$maximoemp.',"'.$_POST["nombre_usuario"].'","'.MD5($_POST["password_usuario"]).'","'.$_POST["rol_id"].'")';

					//ejecuta la cadena
					$this->consulta($cad);

					// creaciond e relacion usuario empleado
					// en empleado como en usuario se creo anterior mente un
					// registro con el mismo id, ahora se utliza el mismo id
					// para la relacion 
					$this->usuario_empleado($maximoemp,$maximoemp);

					
		}

		// creacion de relacion usuario y empleado
		function usuario_empleado($id_usuario,$id_empleado){

			$cad='INSERT INTO usuario_empleado 
			(usuario_id,empleado_id) 
				values('.$id_usuario.','.$id_empleado.')';

					//ejecuta la cadena
					$this->consulta($cad);
		}

		function imprimeTabla($query,$formNew=false,$iconos=array("")){
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

						// metodo para caja de busqueda de tickets (barra)
						case 'buscar':
							echo "entre";
							exit;
							$consulta ="SELECT T.id as Ticket,fecha_creacion_ticket as Creado,fecha_modificacion_ticket as Modificado,asunto_ticket as Asunto,estatus_ticket as Estatus,prioridad_ticket as Prioridad,nivel_ticket as Nivel, CONCAT(nombre_empleado,' ',apellido_paterno) as Atiende FROM tickets T
							join empleados E ON E.id = T.empledo_asignado_id where estatus_ticket like '%".$_REQUEST['ticket']."%' order by estatus_ticket";
							$this->consulta($consulta);
		
							$result=$this->imprimeTabla($consulta,true,array("formupdate","delete","formNewuser"));
						break;

		        		case 'delete':
		        		// echo $registro[0];
		        			$result.='<td width="6%">
							<form method="post"><input type="hidden" value="'.$value.'" name="accion"/>
                     		<input type="hidden" name="idRegistro" value = "'.$registro[0].'">
        					<button class="btn btn-danger">
							<i title="Borrar registro" class="fas fa-trash"></i>
							</button>
							</form></td>';
		        			break;

		        		case 'editar':
		        			$result.='<td colspan="'.count($iconos).'">'.(($formNew)?'<form method="post">
							<input type="hidden" value="formNew" name="accion"/>
							<button class="btn btn-success">
							<i title="Editar registro" class="fas fa-plus-circle"></i>
							</button>
							</form>':"&nbsp;").'</td>';
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

						case 'formuser':
							$result.='<td width="6%">
		        			<form method="post">
		        			<input type="hidden" value="'.$value.'" name="accion">
		        			<input type="hidden" value="'.$registro[0].'" name="idRegistro">
		        			<button class="btn btn-info">
		        			<i title="Editar registro" class="fa fa-user-circle"></i>
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
$oEmpleados = new Empleados();

// echo var_dump($_REQUEST['accion']);
// enseguida puedo ejecutar una opcion
if (isset($_REQUEST['accion'])) // se ejecuta si se esta recibiendo una accion

	// como el switch se programo con un return a continucaion se agrega echo
	echo $oEmpleados->proceso($_REQUEST['accion']);
	
else
	// echo 'se incluyo bien el archivo';
	echo $oEmpleados->proceso("list");

// yo sobre este recurso puedo recibir sobre get o post

?>