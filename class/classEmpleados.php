
<?
// Modelo y controlador de Empleado

// verificacion de sesion existente
// isset permite saber si una variable existe
if(!isset($_SESSION['nombre_usuario'])) 
	{
		// si no esta el isset de la sesion

		session_start(); // si no existe arracca las sesiones
		// si se inician las sesiones y aun asi no existe es acceso ilegal
		if(!isset($_SESSION['nombre_usuario'])) exit;
	}
	
	// Inclusion de recurso base de datos en recurso actual
	include "classBaseDatos.php";

	// si el usuario inicio sesion correctamente pasa

	// clase Empleados hereda comportamiento de la clase BaseDatos
	class Empleados extends BaseDatos
	{
		
		// funcion constructor por defecto
		function __construct(){}

		// que quiero hacer con esta tabla
		function proceso($accion){

			$result=""; // variable para acumular el resultado

			// Switch para ejecutar accion enviada
			switch ($accion) {

				// caso para caja de busqueda de tickets admin (barra de busqueda)
                case 'buscar':

					// consulta para buscar empleados con las caracteristicas de busqueda
					$consulta = "SELECT E.id,nombre_empleado as Nombre,apellido_paterno as Apellido_P,apellido_materno as Apellido_M,titulo_empleado as Titulo,numero_telefono as Telefono,correo_empleado as Correo,D.nombre_departamento as Departamento FROM empleados E
					INNER JOIN `departamentos` D ON E.`departamento_id` = D.`id` where (titulo_empleado like '%".$_REQUEST['empleado']."%' OR CONCAT(nombre_empleado,' ',apellido_paterno) like '%".$_REQUEST['empleado']."%') AND (estado_empleado = 0) order by id";
					
					// ejecucion de consulta
					$this->consulta($consulta);

					// despliegue de tabla
					$result=$this->imprimeTabla($consulta,true,array("formupdate","delete","formuser"));

				break;

				// caso para insercion de empleado en base de datos
				case 'insert':

					// consulta para insertar empleado en la base de datos
					$cad='INSERT INTO empleados 
					(nombre_empleado,apellido_paterno,apellido_materno,titulo_empleado,numero_telefono,correo_empleado,departamento_id) 
					values("'.$_POST["nombre_empleado"].'","'.$_POST['apellido_paterno'].'","'.$_POST['apellido_materno'].'","'.$_POST['titulo_empleado'].'","'.$_POST['numero_telefono'].'","'.$_POST['correo_empleado'].'","'.$_POST['departamento_id'].'")';

					// ejecucion de consulta
					$this->consulta($cad);
					
					// ejecucion de proceso de listado 
					$result.=$this->proceso('list');
					
					break;

				// caso para listar o desplegar tabla
				case 'list': 

					// consulta para listado de tabla
					$cad = "SELECT E.id,nombre_empleado as Nombre,apellido_paterno as Apellido_P,apellido_materno as Apellido_M,titulo_empleado as Titulo,numero_telefono as Telefono,correo_empleado as Correo,D.nombre_departamento as Departamento FROM empleados E
					INNER JOIN `departamentos` D ON E.`departamento_id` = D.`id` WHERE estado_empleado = 0 ORDER BY E.id";

					// despliegue de tabla
					$result=$this->imprimeTabla($cad,true,array("formupdate","delete","formuser"));

					break;

				// caso para eliminacion de empleados (por solicitud de asesor interno el registro no se borra solo de oculta de la vista del usuario final)
				case 'delete':
					
					// consulta para actualizar estado de empleado (1 = oculto)
					$cad = 'UPDATE empleados SET estado_empleado = 1 WHERE id = "'.$_POST["idRegistro"].'"';

					// ejecucion de consulta
					$this->consulta($cad);

					// ejecucion de proceso de listado 
					$result.= $this->proceso('list');
					break;
				
				// caso para actualizacion de empleado
				case 'update':

					// consulta para actualizacion de empleados
					$cad = 'UPDATE empleados SET nombre_empleado ="'.$_POST["nombre_empleado"].'", 
											apellido_paterno="'.$_POST['apellido_paterno'].'",
											apellido_materno="'.$_POST['apellido_materno'].'",
									  titulo_empleado="'.$_POST['titulo_empleado'].'",
									  numero_telefono="'.$_POST['numero_telefono'].'",
									  correo_empleado="'.$_POST['correo_empleado'].'",
									  departamento_id="'.$_POST['departamento_id'].'"
					WHERE id = "'.$_POST["idRegistro"].'"';

					// ejecucion de consulta
					$this->consulta($cad);

					// ejecucion de proceso de listado 
					$result.=$this->proceso('list');

					break;

				// caso para creacion de usuario
				case 'insertuser':

					// se llama a funcion que crea usuario con el mismo id que el 
					// empleado y ademas crea la relacion de usuario con empleado
					$this->creausuario();

					// ejecucion de proceso de listado 
					$result.=$this->proceso('list');
					break;
				
				// caso para actualizacion de usuario
				case 'updateuser':

					// se compara el password, si fue modificado agrega la incriptacion MD5 al password y lo almacena en la bd
					if($_SESSION['password_usuarioold'] !== $_POST['password_usuario']){
						// consulta para actualizacion de usuario
						$cad = 'UPDATE usuarios SET nombre_usuario ="'.$_POST["nombre_usuario"].'", 
						password_usuario=MD5("'.$_POST['password_usuario'].'"),
						rol_id="'.$_POST['rol_id'].'"WHERE id = "'.$_POST["idRegistro"].'"';
					}else{
						// consulta para actualizacion de usuario
						$cad = 'UPDATE usuarios SET nombre_usuario ="'.$_POST["nombre_usuario"].'", 
						password_usuario="'.$_POST['password_usuario'].'",
						rol_id="'.$_POST['rol_id'].'"WHERE id = "'.$_POST["idRegistro"].'"';
					}
					
					// ejecucion de consulta
					$this->consulta($cad);

					// ejecucion de proceso de listado 
					$result.=$this->proceso('list');
					break;
 
				// caso para despliegue de formulario de usuario
				case 'formuser':

					// se optienen los datos de un registro
					$registro=$this->sacaTupla("SELECT * FROM usuarios WHERE id=".$_POST['idRegistro']);

					// seccion para comprobar si $registro['password_usuario'] contiene algo
					if(isset($registro['password_usuario'])){
						// si contiene algo lo salva en una variable de sesion
						$_SESSION['password_usuarioold'] = $registro['password_usuario'];
					}
					
					// formulario de creacion de nuevo usuario
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
							<input style=";margin-left:; aling:" type="submit" class="btn btn-primary" value="Guardar">
							<button style="margin-left:50px;width: auto" type="button" class="btn btn-primary"><a style="color:white" href="../admin/gestion_emp.php">Cancelar</a></button>	
						</div>
					</div>

					</form>
					</div>';
					
					break;
				
				// caso para actualizacion de empleado
				case 'formupdate':

					// consulta para extraer datos de registro si existe
					$registro=$this->sacaTupla("SELECT * FROM empleados WHERE id=".$_POST['idRegistro']); 
				
				// caso para nuevo empleado
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
							<input style=";margin-left:; aling:" type="submit" class="btn btn-primary" value="Guardar">
							<button style="margin-left:50px;width: auto" type="button" class="btn btn-primary"><a style="color:white" href="../admin/gestion_emp.php">Cancelar</a></button>	
						</div>
					</div>
					
					</form>
					</div>';
					break;

			}
			// se retorna el resultado
			return $result;
		}

		// funcion para actualizar usuario
		function updateUsuario(){
			// consulta para actualizar usuario
			$cad = 'UPDATE usuario SET nomb_usua="'.$_POST["nomb_usua"].'",
									   pass_usua="'.$_POST["pass_usua"].'",
									   fk_id_rol="'.$_POST["fk_id_rol"].'",
									   clave_cancelv="'.$_POST["clave_cancelv"].'"
			WHERE Id = "'.$_POST["idRegistro"].'"';
			$res = $this->consult($cad);
		}

		// funcion para obtener el ultimo empleado
		function maxempleado(){

			// consulta para extraer el ultimo registro
			$cad="SELECT * FROM empleadoS ORDER BY Id DESC LIMIT 1";

			// ejecucion de consulta
			$res = $this->consult($cad);

			// volcar datos, provenientes de una consulta mysql, dentro de un array php
			$volcadoarray = mysqli_fetch_array($res);

			// extracion y almacenamiento de id de registro
			$maxemp = $volcadoarray['id'];

			// retorno de ultimo id
			return $maxemp;
		}

		// funcion para crear usuario en la base de datos
		function creausuario(){

			// almacenamiento de id maximo de empleado
			$maximoemp=$this->maxempleado();

			// consulta para insertar usuario
			$cad='INSERT INTO usuarios 
			(id,nombre_usuario,password_usuario,rol_id) 
				values('.$maximoemp.',"'.$_POST["nombre_usuario"].'","'.MD5($_POST["password_usuario"]).'","'.$_POST["rol_id"].'")';

			// ejecucion de consulta
			$this->consulta($cad);

			/* creacion de relacion usuario empleado
			   en empleado como en usuario se creo anterior mente un
			   registro con el mismo id, ahora se utliza el mismo id
			   para la relacion */ 
			$this->usuario_empleado($maximoemp,$maximoemp);
		
		}

		// funcion para creacion de relacion usuario y empleado
		function usuario_empleado($id_usuario,$id_empleado){

			// consulta insertar la relacion en la base de datos
			$cad='INSERT INTO usuario_empleado 
			(usuario_id,empleado_id) 
				values('.$id_usuario.','.$id_empleado.')';

			// ejecucion de la consulta
			$this->consulta($cad);
		}

		// funcion para imprimir tabla
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

						// metodo para caja de busqueda de tickets (barra de busqueda)
						case 'buscar':
							echo "entre";
							exit;
							$consulta ="SELECT T.id as Ticket,fecha_creacion_ticket as Creado,fecha_modificacion_ticket as Modificado,asunto_ticket as Asunto,estatus_ticket as Estatus,prioridad_ticket as Prioridad,nivel_ticket as Nivel, CONCAT(nombre_empleado,' ',apellido_paterno) as Atiende FROM tickets T
							join empleados E ON E.id = T.empledo_asignado_id where estatus_ticket like '%".$_REQUEST['ticket']."%' order by estatus_ticket";
							$this->consulta($consulta);
		
							$result=$this->imprimeTabla($consulta,true,array("formupdate","delete","formNewuser"));
						break;
						
						// caso para agregacion de boton de borrado a registro
		        		case 'delete':
		        			$result.='<td width="6%">
							<form method="post"><input type="hidden" value="'.$value.'" name="accion"/>
                     		<input type="hidden" name="idRegistro" value = "'.$registro[0].'">
        					<button class="btn btn-danger">
							<i title="Borrar registro" class="fas fa-trash"></i>
							</button>
							</form></td>';
		        			break;

						// caso para agregacion de boton de edicion a registro
		        		case 'editar':
		        			$result.='<td colspan="'.count($iconos).'">'.(($formNew)?'<form method="post">
							<input type="hidden" value="formNew" name="accion"/>
							<button class="btn btn-success">
							<i title="Editar registro" class="fas fa-plus-circle"></i>
							</button>
							</form>':"&nbsp;").'</td>';
		        			break;

						// caso para agregacion de boton de actualizacion a registro
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
						
						// caso para agregacion de boton de usuario a registro
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

				// despliegue de las demas columnas de un registro
				for ($col=0; $col < count($registro); $col++) { 
					$result.='<td>'.$registro[$col].'</td>';
					
				}$result.='</tr>';
				
			}
			$result.='</table>';
		    return $result;
		}
	}

// construccion de objeto de clase
$oEmpleados = new Empleados();

if (isset($_REQUEST['accion'])) // se ejecuta si se esta recibiendo una accion

	// como el switch se programo con un return a continucaion se agrega echo
	echo $oEmpleados->proceso($_REQUEST['accion']);
	
else
	// por defecto se ejecuta la accion de list que despliega la tabla de registros
	echo $oEmpleados->proceso("list");

// este recurso puedo recibir sobre get o post

?>