
<?

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
	class Cuestionarios extends BaseDatos // clase referente a tabla espacios en la base de datos
	{


		// al poner extends la tabla podra heredar el conportamiento de la calse BaseDatos
		
		// funcion constructor por defecto
		function __construct(){

		}

		// $nomb_emp = $_POST["nomb_emp"];

		// que quiero hacer con esta tabla
		function proceso($accion){

            $tipo_cuestionario = $this->consultartipo();
			$arrayanswers;

			//arreglos de selects
			$selectboolean = array("Si","No");	

			$result=""; // variable para acumular el resultado
			switch ($accion) {

                case 'insert':

					if($tipo_cuestionario == "CCP"){
						$arrayanswers [0] = $_POST["r1"];
						$arrayanswers [1] = $_POST["r2"];
						$arrayanswers [2] = $_POST["r3"];
						$arrayanswers [3] = $_POST["r4"];
						$arrayanswers [4] = $_POST["r5"];
						$arrayanswers [5] = $_POST["r6"];
						$arrayanswers [6] = $_POST["r7"];
						$arrayanswers [7] = $_POST["r8"];
						$arrayanswers [8] = $_POST["r9"];
						$arrayanswers [9] = $_POST["r10"];
						$arrayanswers [10] = $_POST["r11"];
						$arrayanswers [11] = $_POST["r12"];
					}
					if($tipo_cuestionario == "SO"){
						$arrayanswers [0] = $_POST["r14"];
						$arrayanswers [1] = $_POST["r15"];
						$arrayanswers [2] = $_POST["r16"];
						$arrayanswers [3] = $_POST["r17"];
						$arrayanswers [4] = $_POST["r18"];
						$arrayanswers [5] = $_POST["r19"];
						$arrayanswers [6] = $_POST["r20"];
						$arrayanswers [7] = $_POST["r21"];
						$arrayanswers [8] = $_POST["r22"];
						$arrayanswers [9] = $_POST["r23"];
					}

                    

                    echo var_dump($arrayanswers);
                    //echo var_dump($_POST);
                    exit;
    
                    // armado de cadena de insersion
                        $cad='INSERT INTO tickets 
                        (fecha_creacion_ticket,fecha_modificacion_ticket,asunto_ticket,descripcion_ticket,estatus_ticket,prioridad_ticket,empledo_asignado_id,autor_id,nivel_ticket,nota_ticket,nombre_equipo_ticket,fabricante_ticket,modelo_equipo_ticket,tipo_conexion_ticket,nombre_aplicacion_ticket,si_driver_update,nombre_driver_update,sistema_operativo_ticket,tipo_cuestionario) 
                        values("'.$_POST["fecha_creacion_ticket"].'","'.$_POST['fecha_modificacion_ticket'].'"
                        ,"'.$_POST['asunto_ticket'].'","'.$_POST['descripcion_ticket'].'","'.$_POST['estatus_ticket'].'"
                        ,"'.$_POST['prioridad_ticket'].'","'.$_POST['empledo_asignado_id'].'","'.$_POST['autor_id'].'"
                        ,"'.$_POST['nivel_ticket'].'","'.$_POST['nota_ticket'].'","'.$_POST['nombre_equipo_ticket'].'"
                        ,"'.$_POST['fabricante_ticket'].'","'.$_POST['modelo_equipo_ticket'].'","'.$_POST['tipo_conexion_ticket'].'"
                        ,"'.$_POST['nombre_aplicacion_ticket'].'","'.$_POST['si_driver_update'].'","/*nombre_driver_update*/"
                        ,"'.$_POST['sistema_operativo_ticket'].'","'.$_POST['tipo_cuestionario'].'")';
    
                        //ejecuta la cadena
                        $this->consulta($cad);
    
                        // funcion para insertar imagen en bd
                        $this->insertarimagen();
                        
                        
                        $result.=$this->proceso('list');
                        
                        
                        break;


                case 'cuestionario':

                if($tipo_cuestionario == 'CCP'){

                    echo "formulario de Componentes de computadora portatil";

                    $result.='
                    <div style="width: auto;background:green; aling-items:right">
                    <span style="width:60px;height:25px;border-left:0px" class="badge bg-primary">'.$tipo_cuestionario.'</span>
                    </div>
                        
                    <div class="" style="">
					<form action="" method="post" enctype="multipart/form-data">

					<input type="hidden" name="idRegistro" value="'.$_POST["idRegistro"].'">
					<input type="hidden" name="accion" value="insert">

					<div style="background-color:;height:auto;float:left;width:100%">

					<div style="margin-top:"class="">

					<div style="margin-left:9%" class="col-md-10">
					<div class="row">

					<label style="margin-top:10px" class="col-md-5">¿Qué tipo de computadora tiene?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="1" name="pregunta_id">
					<input placeholder="Asunto" required="" type="text" name="r1" class="form-control" value="'.(isset($registro)?$registro['asunto_ticket']:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Cuales son la marca y modelo de la computadora?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="2" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r2" class="form-control" value="'.(isset($registro)?$registro['descripcion_ticket']:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Puede describir que ocurre al arrancar la computadora?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="3" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r3" class="form-control" value="'.(isset($registro)?$registro['descripcion_ticket']:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Con qué frecuencia presenta la computadora problemas al arrancar? </label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="4" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r4" class="form-control" value="'.(isset($registro)?$registro['descripcion_ticket']:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Cuál es la primera pantalla que ve al encender el equipo?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="5" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r5" class="form-control" value="'.(isset($registro)?$registro['descripcion_ticket']:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Qué sonidos emite la computadora al arrancar?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="6" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r6" class="form-control" value="'.(isset($registro)?$registro['descripcion_ticket']:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Se ha reparado recientemente la computadora?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r7",isset($registro)?$registro['estatus_ticket']:"");
									$result.='
									</div>
									</div>
 
					<label style="margin-top:10px" class="col-md-5">¿Alguien más ha utilizado la computadora?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r8",isset($registro)?$registro['prioridad_ticket']:"");
									$result.='
									</div>
									</div>
                    
                    <label style="margin-top:10px" class="col-md-5">¿Hay un disquete o un disco en la unidad de disquetes o en la unidad óptica?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r9",isset($registro)?$registro['prioridad_ticket']:"");
									$result.='
									</div>
									</div>

                    <label style="margin-top:10px" class="col-md-5">¿Tiene conectada la computadora una unidad USB?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r10",isset($registro)?$registro['prioridad_ticket']:"");
									$result.='
									</div>
									</div>

                    <label style="margin-top:10px" class="col-md-5">¿Puede utilizar la computadora para conectarse a una red inalámbrica?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r11",isset($registro)?$registro['prioridad_ticket']:"");
									$result.='
									</div>
									</div>

                    <label style="margin-top:10px" class="col-md-5">¿Está la computadora en una sala con cerradura por la noche?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r12",isset($registro)?$registro['prioridad_ticket']:"");
									$result.='
									</div>
									</div>

					</div>
					</div>
					</div>
					</div>

                    <div style="background-color:;">
						<div style="background-color:;margin-left:80%;width: 313px;">
							<input style=";margin-left:; aling:" type="submit" class="btn btn-secondary" value="Guardar">
							<button style="margin-left:50px;width: auto" type="button" class="btn btn-secondary"><a href="../admin/home_admin.php">Cancelar</a></button>	
						</div>
					</div>
					
					</form>

					</div>';

                }if($tipo_cuestionario == 'SO'){
                    echo "formulario de Sistemas operativos";
                }if($tipo_cuestionario == 'RED'){
                    echo "formulario de Redes";
                }if($tipo_cuestionario == 'CP'){
                    echo "formulario de Cumputadora portatil";
                }if($tipo_cuestionario == 'SEG'){
                    echo "formulario de Seguridad";
                }if($tipo_cuestionario == 'IMP'){
                    echo "formulario de Impresoras";
                }if($tipo_cuestionario == 'SOF'){
                    echo "formulario de software";
                }

                    return $result;
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
					//$registro=$this->sacaTupla("SELECT * FROM empleado WHERE Id=".$_POST['idRegistro']); 

					// registro usuario
					$registro=$this->sacaTupla("SELECT * FROM tickets WHERE id=".$_POST['idRegistro']);

				case 'formNew':

					
					
					//echo "formNew";
					//echo $registro["tipo_conexion_ticket"];
					//exit;
					$fechaActual = date('y-m-d h:i:s'); // obtencion de la fecha actual

					$result.='<div class="" style="margin-top:">
					<form action="" method="post" enctype="multipart/form-data">';
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
							<input readonly="readonly" placeholder="F.Creacion" required="" type="data" name="fecha_creacion_ticket" class="form-control" value="'.(isset($registro)?$registro['fecha_creacion_ticket']:"$fechaActual").'">
							</div>
						</div>
						<div style="background-color:;height:auto;width:32.3%;display:inline-block;">
							<div>
							<input readonly="readonly" placeholder="F.Modificacion" required="" type="data" name="fecha_modificacion_ticket" class="form-control" value="'.$fechaActual.'">
							</div>
						</div>
						<div  style=";background-color:;height:auto;width:31.3%;float:right;">
							<div style="height:55px;margin-top:15px">
								<h4 style="font-weight: 900; margin-top:" align="center">NT: "'.(isset($registro)?$registro['id']:"").'"</h4>
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

					<label style="margin-top:10px" class="col-md-3" class="form-group">Nota * </label>
					<div style="margin-top:10px" class="col-md-8">
      				<textarea type="text" name="nota_ticket" class="form-control" value="'.(isset($registro)?$registro['nota_ticket']:"").'" rows="2"></textarea>
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


					<div style="background-color:;height:auto;float:right;width:50%">

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

		function insertarimagen(){

			//echo var_dump($_POST);
			//exit;
			$carpeta = "../imagenes/";

			//echo "imagen cargada";
			$file = $_FILES["imagen"];
			$nombre = $file["name"];
			$tipo = $file["type"];
			$size = $file["size"];
			$ruta_provisional = $file["tmp_name"];
			//echo $nombre;
			//echo $tipo;
			//echo $size;
			$src = $carpeta.$nombre;
			move_uploaded_file($ruta_provisional,$src);
			//$picture = "imagenes/".$nombre;

			if(isset($_POST["idRegistro"])){
			 // cuando el ticket ya existe y se desea agregar una nueva imagen adicional

			 $cad='INSERT INTO imagenes 
			 (nombre_imagen,tipo_imagen,ticked_id) 
			 values("'.$file["name"].'"
			 ,"'.$file["type"].'","'.$_POST["idRegistro"].'")';

			}else{
			 // cuando el ticket es nuevo aun no existe idRegistro
			 $lastticket = $this->maxticket();

			 $cad='INSERT INTO imagenes 
			 (nombre_imagen,tipo_imagen,ticked_id) 
			 values("'.$file["name"].'"
			 ,"'.$file["type"].'","'.$lastticket.'")';

			}	

			$res = $this->consult($cad);	
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

        // funcion que cnsulta el tipo de cuestionario
        function consultartipo(){
            $tipo_cuestionario = "";

            $cad="SELECT tipo_cuestionario FROM tickets WHERE id = ".$_POST["idRegistro"]." ";


			$res = $this->consult($cad);
			// echo var_dump($res);

			// volcar datos, provenientes de una consulta mysql, dentro de un array php
			$volcadoarray = mysqli_fetch_array($res);
			$tipo_cuestionario = $volcadoarray['tipo_cuestionario'];

            echo $tipo_cuestionario;
			return $tipo_cuestionario;

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
$oCuestionarios = new Cuestionarios();

// echo var_dump($_REQUEST['accion']);
// enseguida puedo ejecutar una opcion
if (isset($_REQUEST['accion'])) // se ejecuta si se esta recibiendo una accion

	// como el switch se programo con un return a continucaion se agrega echo
	echo $oCuestionarios->proceso($_REQUEST['accion']);
	
else
	// echo 'se incluyo bien el archivo';
	echo $oCuestioarios->proceso("list");

// yo sobre este recurso puedo recibir sobre get o post

?>