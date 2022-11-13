
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
			//echo var_dump($_POST);
			$idRegistro = $_POST["idRegistro"];
            $tipo_cuestionario = $this->consultartipo($idRegistro);
			$arrayanswers;
			$arrayidquestions;

			//arreglos de selects
			$selectboolean = array("Si","No");	

			$result=""; // variable para acumular el resultado
			switch ($accion) {

                case 'insert':


					if($tipo_cuestionario == "CCP"){
						// IDAREA = 1

						$arrayidquestions = [1,2,3,4,5,6,7,8,9,10,11,12];

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
						
						// FUNCION PARA HACER INSERCION EN LA BASE DE DATOS (ARRAYANWERS,ARRAYIDPREGUNTA,idRegistro)
						// $this->insertcuestionario($arrayidquestions,$arrayanswers,$idRegistro);

						$cad='INSERT INTO cuestionarios 
                        (respuesta_pregunta,ticket_id,pregunta_id) 
                        values("'.$_POST["r1"].'",'.$idRegistro.','.$arrayidquestions[0].'),
							  ("'.$_POST["r2"].'",'.$idRegistro.','.$arrayidquestions[1].'),
							  ("'.$_POST["r3"].'",'.$idRegistro.','.$arrayidquestions[2].'),
							  ("'.$_POST["r4"].'",'.$idRegistro.','.$arrayidquestions[3].'),
							  ("'.$_POST["r5"].'",'.$idRegistro.','.$arrayidquestions[4].'),
							  ("'.$_POST["r6"].'",'.$idRegistro.','.$arrayidquestions[5].'),
							  ("'.$_POST["r7"].'",'.$idRegistro.','.$arrayidquestions[6].'),
							  ("'.$_POST["r8"].'",'.$idRegistro.','.$arrayidquestions[7].'),
							  ("'.$_POST["r9"].'",'.$idRegistro.','.$arrayidquestions[8].'),
							  ("'.$_POST["r10"].'",'.$idRegistro.','.$arrayidquestions[9].'),
							  ("'.$_POST["r11"].'",'.$idRegistro.','.$arrayidquestions[10].'),
							  ("'.$_POST["r12"].'",'.$idRegistro.','.$arrayidquestions[11].')';
    
                        //ejecuta la cadena
                        $this->consulta($cad);

						echo "<META  HTTP-EQUIV ='REFRESH' CONTENT='1; URL=../admin/home_admin.php'>"; 
						
					}
					if($tipo_cuestionario == "SO"){
						// IDAREA = 2

						$arrayidquestions = [14,15,16,17,18,19,20,21,22,23];

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

						$cad='INSERT INTO cuestionarios 
                        (respuesta_pregunta,ticket_id,pregunta_id) 
                        values("'.$_POST["r14"].'",'.$idRegistro.','.$arrayidquestions[0].'),
							  ("'.$_POST["r15"].'",'.$idRegistro.','.$arrayidquestions[1].'),
							  ("'.$_POST["r16"].'",'.$idRegistro.','.$arrayidquestions[2].'),
							  ("'.$_POST["r17"].'",'.$idRegistro.','.$arrayidquestions[3].'),
							  ("'.$_POST["r18"].'",'.$idRegistro.','.$arrayidquestions[4].'),
							  ("'.$_POST["r19"].'",'.$idRegistro.','.$arrayidquestions[5].'),
							  ("'.$_POST["r20"].'",'.$idRegistro.','.$arrayidquestions[6].'),
							  ("'.$_POST["r21"].'",'.$idRegistro.','.$arrayidquestions[7].'),
							  ("'.$_POST["r22"].'",'.$idRegistro.','.$arrayidquestions[8].'),
							  ("'.$_POST["r23"].'",'.$idRegistro.','.$arrayidquestions[9].')';

						//ejecuta la cadena
                        $this->consulta($cad);

						echo "<META  HTTP-EQUIV ='REFRESH' CONTENT='1; URL=../admin/home_admin.php'>"; 
					}
					if($tipo_cuestionario == "RED"){
						// IDAREA = 3

						$arrayidquestions = [24,25,26,27,28,31,33];

						$arrayanswers [0] = $_POST["r24"];
						$arrayanswers [1] = $_POST["r25"];
						$arrayanswers [2] = $_POST["r26"];
						$arrayanswers [3] = $_POST["r27"];
						$arrayanswers [4] = $_POST["r28"];
						$arrayanswers [5] = $_POST["r31"];
						$arrayanswers [6] = $_POST["r33"];

						$cad='INSERT INTO cuestionarios 
                        (respuesta_pregunta,ticket_id,pregunta_id) 
                        values("'.$_POST["r24"].'",'.$idRegistro.','.$arrayidquestions[0].'),
							  ("'.$_POST["r25"].'",'.$idRegistro.','.$arrayidquestions[1].'),
							  ("'.$_POST["r26"].'",'.$idRegistro.','.$arrayidquestions[2].'),
							  ("'.$_POST["r27"].'",'.$idRegistro.','.$arrayidquestions[3].'),
							  ("'.$_POST["r28"].'",'.$idRegistro.','.$arrayidquestions[4].'),
							  ("'.$_POST["r31"].'",'.$idRegistro.','.$arrayidquestions[5].'),
							  ("'.$_POST["r33"].'",'.$idRegistro.','.$arrayidquestions[6].')';

						//ejecuta la cadena
                        $this->consulta($cad);

						echo "<META  HTTP-EQUIV ='REFRESH' CONTENT='1; URL=../admin/home_admin.php'>"; 
					}
					if($tipo_cuestionario == "CP"){
						// IDAREA = 4

						$arrayidquestions = [34,35,36,37,38,39,40,41,42,43,44];

						$arrayanswers [0] = $_POST["r34"];
						$arrayanswers [1] = $_POST["r35"];
						$arrayanswers [2] = $_POST["r36"];
						$arrayanswers [3] = $_POST["r37"];
						$arrayanswers [4] = $_POST["r38"];
						$arrayanswers [5] = $_POST["r39"];
						$arrayanswers [6] = $_POST["r40"];
						$arrayanswers [7] = $_POST["r41"];
						$arrayanswers [8] = $_POST["r42"];
						$arrayanswers [9] = $_POST["r43"];
						$arrayanswers [10] = $_POST["r44"];

						$cad='INSERT INTO cuestionarios 
                        (respuesta_pregunta,ticket_id,pregunta_id) 
                        values("'.$_POST["r34"].'",'.$idRegistro.','.$arrayidquestions[0].'),
							  ("'.$_POST["r35"].'",'.$idRegistro.','.$arrayidquestions[1].'),
							  ("'.$_POST["r36"].'",'.$idRegistro.','.$arrayidquestions[2].'),
							  ("'.$_POST["r37"].'",'.$idRegistro.','.$arrayidquestions[3].'),
							  ("'.$_POST["r38"].'",'.$idRegistro.','.$arrayidquestions[4].'),
							  ("'.$_POST["r39"].'",'.$idRegistro.','.$arrayidquestions[5].'),
							  ("'.$_POST["r40"].'",'.$idRegistro.','.$arrayidquestions[6].'),
							  ("'.$_POST["r41"].'",'.$idRegistro.','.$arrayidquestions[7].'),
							  ("'.$_POST["r42"].'",'.$idRegistro.','.$arrayidquestions[8].'),
							  ("'.$_POST["r43"].'",'.$idRegistro.','.$arrayidquestions[9].'),
							  ("'.$_POST["r44"].'",'.$idRegistro.','.$arrayidquestions[10].')';

						//ejecuta la cadena
                        $this->consulta($cad);

						echo "<META  HTTP-EQUIV ='REFRESH' CONTENT='1; URL=../admin/home_admin.php'>"; 
					}
					if($tipo_cuestionario == "SEG"){
						// IDAREA = 5

						$arrayidquestions = [61,62,63,65,66,67,69,70,71,72,73,74,75,76];

						$arrayanswers [0] = $_POST["r61"];
						$arrayanswers [1] = $_POST["r62"];
						$arrayanswers [2] = $_POST["r63"];
						$arrayanswers [3] = $_POST["r65"];
						$arrayanswers [4] = $_POST["r66"];
						$arrayanswers [5] = $_POST["r67"];
						$arrayanswers [6] = $_POST["r69"];
						$arrayanswers [7] = $_POST["r70"];
						$arrayanswers [8] = $_POST["r71"];
						$arrayanswers [9] = $_POST["r72"];
						$arrayanswers [10] = $_POST["r73"];
						$arrayanswers [11] = $_POST["r74"];
						$arrayanswers [12] = $_POST["r75"];
						$arrayanswers [13] = $_POST["r76"];

						$cad='INSERT INTO cuestionarios 
                        (respuesta_pregunta,ticket_id,pregunta_id) 
                        values("'.$_POST["r61"].'",'.$idRegistro.','.$arrayidquestions[0].'),
							  ("'.$_POST["r62"].'",'.$idRegistro.','.$arrayidquestions[1].'),
							  ("'.$_POST["r63"].'",'.$idRegistro.','.$arrayidquestions[2].'),
							  ("'.$_POST["r65"].'",'.$idRegistro.','.$arrayidquestions[3].'),
							  ("'.$_POST["r66"].'",'.$idRegistro.','.$arrayidquestions[4].'),
							  ("'.$_POST["r67"].'",'.$idRegistro.','.$arrayidquestions[5].'),
							  ("'.$_POST["r69"].'",'.$idRegistro.','.$arrayidquestions[6].'),
							  ("'.$_POST["r70"].'",'.$idRegistro.','.$arrayidquestions[7].'),
							  ("'.$_POST["r71"].'",'.$idRegistro.','.$arrayidquestions[8].'),
							  ("'.$_POST["r72"].'",'.$idRegistro.','.$arrayidquestions[9].'),
							  ("'.$_POST["r73"].'",'.$idRegistro.','.$arrayidquestions[10].'),
							  ("'.$_POST["r74"].'",'.$idRegistro.','.$arrayidquestions[11].'),
							  ("'.$_POST["r75"].'",'.$idRegistro.','.$arrayidquestions[12].'),
							  ("'.$_POST["r76"].'",'.$idRegistro.','.$arrayidquestions[13].')';

						//ejecuta la cadena
                        $this->consulta($cad);

						echo "<META  HTTP-EQUIV ='REFRESH' CONTENT='1; URL=../admin/home_admin.php'>"; 
					}
					if($tipo_cuestionario == "IMP"){
						// IDAREA = 6

						$arrayidquestions = [46,47,48,49,50,51,53,54,55,56,57,58,59,60];

						$arrayanswers [0] = $_POST["r46"];
						$arrayanswers [1] = $_POST["r47"];
						$arrayanswers [2] = $_POST["r48"];
						$arrayanswers [3] = $_POST["r49"];
						$arrayanswers [4] = $_POST["r50"];
						$arrayanswers [5] = $_POST["r51"];
						$arrayanswers [6] = $_POST["r53"];
						$arrayanswers [7] = $_POST["r54"];
						$arrayanswers [8] = $_POST["r55"];
						$arrayanswers [9] = $_POST["r56"];
						$arrayanswers [10] = $_POST["r57"];
						$arrayanswers [11] = $_POST["r58"];
						$arrayanswers [12] = $_POST["r59"];
						$arrayanswers [13] = $_POST["r60"];

						$cad='INSERT INTO cuestionarios 
                        (respuesta_pregunta,ticket_id,pregunta_id) 
                        values("'.$_POST["r46"].'",'.$idRegistro.','.$arrayidquestions[0].'),
							  ("'.$_POST["r47"].'",'.$idRegistro.','.$arrayidquestions[1].'),
							  ("'.$_POST["r48"].'",'.$idRegistro.','.$arrayidquestions[2].'),
							  ("'.$_POST["r49"].'",'.$idRegistro.','.$arrayidquestions[3].'),
							  ("'.$_POST["r50"].'",'.$idRegistro.','.$arrayidquestions[4].'),
							  ("'.$_POST["r51"].'",'.$idRegistro.','.$arrayidquestions[5].'),
							  ("'.$_POST["r53"].'",'.$idRegistro.','.$arrayidquestions[6].'),
							  ("'.$_POST["r54"].'",'.$idRegistro.','.$arrayidquestions[7].'),
							  ("'.$_POST["r55"].'",'.$idRegistro.','.$arrayidquestions[8].'),
							  ("'.$_POST["r56"].'",'.$idRegistro.','.$arrayidquestions[9].'),
							  ("'.$_POST["r57"].'",'.$idRegistro.','.$arrayidquestions[10].'),
							  ("'.$_POST["r58"].'",'.$idRegistro.','.$arrayidquestions[11].'),
							  ("'.$_POST["r59"].'",'.$idRegistro.','.$arrayidquestions[12].'),
							  ("'.$_POST["r60"].'",'.$idRegistro.','.$arrayidquestions[13].')';

						//ejecuta la cadena
                        $this->consulta($cad);

						echo "<META  HTTP-EQUIV ='REFRESH' CONTENT='1; URL=../admin/home_admin.php'>"; 
					}
					if($tipo_cuestionario == "SOF"){
						// IDAREA = 7

						$arrayidquestions = [77,78,79,80,81,82,83,84];

						$arrayanswers [0] = $_POST["r77"];
						$arrayanswers [1] = $_POST["r78"];
						$arrayanswers [2] = $_POST["r79"];
						$arrayanswers [3] = $_POST["r80"];
						$arrayanswers [4] = $_POST["r81"];
						$arrayanswers [5] = $_POST["r82"];
						$arrayanswers [6] = $_POST["r83"];
						$arrayanswers [7] = $_POST["r84"];

						$cad='INSERT INTO cuestionarios 
                        (respuesta_pregunta,ticket_id,pregunta_id) 
                        values("'.$_POST["r77"].'",'.$idRegistro.','.$arrayidquestions[0].'),
							  ("'.$_POST["r78"].'",'.$idRegistro.','.$arrayidquestions[1].'),
							  ("'.$_POST["r79"].'",'.$idRegistro.','.$arrayidquestions[2].'),
							  ("'.$_POST["r80"].'",'.$idRegistro.','.$arrayidquestions[3].'),
							  ("'.$_POST["r81"].'",'.$idRegistro.','.$arrayidquestions[4].'),
							  ("'.$_POST["r82"].'",'.$idRegistro.','.$arrayidquestions[5].'),
							  ("'.$_POST["r83"].'",'.$idRegistro.','.$arrayidquestions[6].'),
							  ("'.$_POST["r84"].'",'.$idRegistro.','.$arrayidquestions[7].')';

						//ejecuta la cadena
                        $this->consulta($cad);

						echo "<META  HTTP-EQUIV ='REFRESH' CONTENT='1; URL=../admin/home_admin.php'>"; 
					}

                    //echo var_dump($arrayanswers);
                    //echo var_dump($_POST);
                     
						
                        
                        //$result.=$this->proceso('list');
                        
                        
                        break;


                case 'cuestionario':

					$cad = "SELECT respuesta_pregunta FROM cuestionarios WHERE ticket_id=".$_POST['idRegistro']."";
					
					$reg = $this->consult($cad);

					$nreg = mysqli_num_rows($reg);

					if ($nreg > 0)
					{
						for ($i=0; $i<$nreg; $i++)
						{
							$array = mysqli_fetch_array($reg);
							$registro[$i] = $array["respuesta_pregunta"];
						}
			
					}
					
					//echo count($registro);
					//echo var_dump($registro);
					//exit;

                if($tipo_cuestionario == 'CCP'){

                    //echo "formulario de Componentes de computadora portatil";
					//echo $_POST["idRegistro"];

                    $result.='
                    <div style="height:auto;margin-top:30%px;margin-left:; margin-right:;float:right">
                    <span style="width:60px;height:25px;" class="badge bg-primary">'.$tipo_cuestionario.'</span>
                    </div>
                        
                    <div class="" style="">
					<form action="" method="post" enctype="multipart/form-data">';
					if (isset($registro))
						$result.='
					<input type="hidden" name="accion" value="update">
					<input type="hidden" name="idRegistro" value="'.$_POST["idRegistro"].'">';
					else
						$result.='
					<input type="hidden" name="accion" value="insert">
					<input type="hidden" name="idRegistro" value="'.$_POST["idRegistro"].'">';
					
					$result.='
					
					<div style="background-color:;height:auto;float:left;width:100%">

					<div style="margin-top:"class="">

					<div style="margin-left:9%" class="col-md-10">
					<div class="row">

					<label style="margin-top:10px" class="col-md-5">¿Qué tipo de computadora tiene?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="1" name="pregunta_id">
					<input placeholder="Asunto" required="" type="text" name="r1" class="form-control" value="'.(isset($registro)?$registro[0]:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Cuales son la marca y modelo de la computadora?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="2" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r2" class="form-control" value="'.(isset($registro)?$registro[1]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Puede describir que ocurre al arrancar la computadora?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="3" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r3" class="form-control" value="'.(isset($registro)?$registro[2]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Con qué frecuencia presenta la computadora problemas al arrancar? </label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="4" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r4" class="form-control" value="'.(isset($registro)?$registro[3]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Cuál es la primera pantalla que ve al encender el equipo?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="5" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r5" class="form-control" value="'.(isset($registro)?$registro[4]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Qué sonidos emite la computadora al arrancar?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="6" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r6" class="form-control" value="'.(isset($registro)?$registro[5]:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Se ha reparado recientemente la computadora?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r7",isset($registro)?$registro[6]:"");
									$result.='
									</div>
									</div>
 
					<label style="margin-top:10px" class="col-md-5">¿Alguien más ha utilizado la computadora?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r8",isset($registro)?$registro[7]:"");
									$result.='
									</div>
									</div>
                    
                    <label style="margin-top:10px" class="col-md-5">¿Hay un disquete o un disco en la unidad de disquetes o en la unidad óptica?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r9",isset($registro)?$registro[8]:"");
									$result.='
									</div>
									</div>

                    <label style="margin-top:10px" class="col-md-5">¿Tiene conectada la computadora una unidad USB?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r10",isset($registro)?$registro[9]:"");
									$result.='
									</div>
									</div>

                    <label style="margin-top:10px" class="col-md-5">¿Puede utilizar la computadora para conectarse a una red inalámbrica?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r11",isset($registro)?$registro[10]:"");
									$result.='
									</div>
									</div>

                    <label style="margin-top:10px" class="col-md-5">¿Está la computadora en una sala con cerradura por la noche?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r12",isset($registro)?$registro[11]:"");
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

                }else if($tipo_cuestionario == 'SO'){
                    //echo "formulario de Sistemas operativos";

					$result.='
					<div style="height:auto;margin-top:30%px;margin-left:; margin-right:;float:right">
                    <span style="width:60px;height:25px;" class="badge bg-primary">'.$tipo_cuestionario.'</span>
                    </div>
                        
                    <div class="" style="">
					<form action="" method="post" enctype="multipart/form-data">';
					if (isset($registro))
						$result.='
					<input type="hidden" name="accion" value="update">
					<input type="hidden" name="idRegistro" value="'.$_POST["idRegistro"].'">';
					else
						$result.='
					<input type="hidden" name="accion" value="insert">
					<input type="hidden" name="idRegistro" value="'.$_POST["idRegistro"].'">';
					$result.='
					
					<div style="background-color:;height:auto;float:left;width:100%">

					<div style="margin-top:"class="">

					<div style="margin-left:9%" class="col-md-10">
					<div class="row">

					<label style="margin-top:10px" class="col-md-5">¿Qué sistema operativo está instalado en la computadora?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="14" name="pregunta_id">
					<input placeholder="Asunto" required="" type="text" name="r14" class="form-control" value="'.(isset($registro)?$registro[0]:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Qué programas ha instalado recientemente?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="15" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r15" class="form-control" value="'.(isset($registro)?$registro[1]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5"> ¿Qué actualizaciones o paquetes de servicios se han instalado?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="16" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r16" class="form-control" value="'.(isset($registro)?$registro[2]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Qué mensajes de error ha recibido?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="17" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r17" class="form-control" value="'.(isset($registro)?$registro[3]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Qué estaba haciendo cuando descubrió el problema?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="18" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r18" class="form-control" value="'.(isset($registro)?$registro[4]:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Alguien más ha tenido el mismo problema?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r19",isset($registro)?$registro[5]:"");
									$result.='
									</div>
									</div>
 
					<label style="margin-top:10px" class="col-md-5">¿Ha cambiado la contraseña últimamente?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r20",isset($registro)?$registro[6]:"");
									$result.='
									</div>
									</div>
                    
                    <label style="margin-top:10px" class="col-md-5">¿Ha realizado cambios en su equipo?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r21",isset($registro)?$registro[7]:"");
									$result.='
									</div>
									</div>

                    <label style="margin-top:10px" class="col-md-5"> ¿Alguien más tiene acceso a esta computadora?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r22",isset($registro)?$registro[8]:"");
									$result.='
									</div>
									</div>

                    <label style="margin-top:10px" class="col-md-5">¿Ha ocurrido anteriormente este problema?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r23",isset($registro)?$registro[9]:"");
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

                }else if($tipo_cuestionario == 'RED'){
                    //echo "formulario de Redes";

					$result.='
                    <div style="height:auto;margin-top:30%px;margin-left:; margin-right:;float:right">
                    <span style="width:60px;height:25px;" class="badge bg-primary">'.$tipo_cuestionario.'</span>
                    </div>
                        
                    <div class="" style="">
					<form action="" method="post" enctype="multipart/form-data">';
					if (isset($registro))
						$result.='
					<input type="hidden" name="accion" value="update">
					<input type="hidden" name="idRegistro" value="'.$_POST["idRegistro"].'">';
					else
						$result.='
					<input type="hidden" name="accion" value="insert">
					<input type="hidden" name="idRegistro" value="'.$_POST["idRegistro"].'">';
					$result.='
					
					<div style="background-color:;height:auto;float:left;width:100%">

					<div style="margin-top:"class="">

					<div style="margin-left:9%" class="col-md-10">
					<div class="row">

					<label style="margin-top:10px" class="col-md-5">¿Cuándo se ha iniciado el problema?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="24" name="pregunta_id">
					<input placeholder="Asunto" required="" type="text" name="r24" class="form-control" value="'.(isset($registro)?$registro[0]:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Qué indicadores LED de red están encendidos?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="25" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r25" class="form-control" value="'.(isset($registro)?$registro[1]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Qué problemas está experimentando?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="26" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r26" class="form-control" value="'.(isset($registro)?$registro[2]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Hay algo más que pueda decirme acerca del problema?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="27" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r27" class="form-control" value="'.(isset($registro)?$registro[3]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Qué otros usuarios están teniendo problemas?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="28" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r28" class="form-control" value="'.(isset($registro)?$registro[4]:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Ha añadido algún periférico a su computadora?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r31",isset($registro)?$registro[5]:"");
									$result.='
									</div>
									</div>
 
					<label style="margin-top:10px" class="col-md-5">¿Ha reiniciado su computadora?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r33",isset($registro)?$registro[6]:"");
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
                }else if($tipo_cuestionario == 'CP'){
                    //echo "formulario de Cumputadora portatil";

					$result.='
                    <div style="height:auto;margin-top:30%px;margin-left:; margin-right:;float:right">
                    <span style="width:60px;height:25px;" class="badge bg-primary">'.$tipo_cuestionario.'</span>
                    </div>
                        
                    <div class="" style="">
					<form action="" method="post" enctype="multipart/form-data">';
					if (isset($registro))
						$result.='
					<input type="hidden" name="accion" value="update">
					<input type="hidden" name="idRegistro" value="'.$_POST["idRegistro"].'">';
					else
						$result.='
					<input type="hidden" name="accion" value="insert">
					<input type="hidden" name="idRegistro" value="'.$_POST["idRegistro"].'">';
					$result.='
					
					<div style="background-color:;height:auto;float:left;width:100%">

					<div style="margin-top:"class="">

					<div style="margin-left:9%" class="col-md-10">
					<div class="row">

					<label style="margin-top:10px" class="col-md-5">¿En qué entorno está utilizando la computadora portátil?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="34" name="pregunta_id">
					<input placeholder="Asunto" required="" type="text" name="r34" class="form-control" value="'.(isset($registro)?$registro[0]:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Cuándo ha comenzado el problema?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="35" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r35" class="form-control" value="'.(isset($registro)?$registro[1]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Qué problemas está experimentando?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="36" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r36" class="form-control" value="'.(isset($registro)?$registro[2]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Qué ocurre al arrancar la computadora portátil?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="37" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r37" class="form-control" value="'.(isset($registro)?$registro[3]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Qué es lo que ve en la pantalla?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="38" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r38" class="form-control" value="'.(isset($registro)?$registro[4]:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Hay algo más que pueda decirme acerca del problema?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="39" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r39" class="form-control" value="'.(isset($registro)?$registro[5]:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5"> ¿Ha llevado alguien a cabo algún trabajo de reparación en la computadora portátil recientemente?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r40",isset($registro)?$registro[6]:"");
									$result.='
									</div>
									</div>
 
					<label style="margin-top:10px" class="col-md-5">¿Ha utilizado alguien más la computadora portátil?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r41",isset($registro)?$registro[7]:"");
									$result.='
									</div>
									</div>

					<label style="margin-top:10px" class="col-md-5">¿Puede la computadora portátil conectarse a Internet?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r42",isset($registro)?$registro[8]:"");
									$result.='
									</div>
									</div>

					<label style="margin-top:10px" class="col-md-5">¿Dispone la computadora portátil de una NIC inalámbrica?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r43",isset($registro)?$registro[9]:"");
									$result.='
									</div>
									</div>
                    
					<label style="margin-top:10px" class="col-md-5">¿Ha experimentado anteriormente problemas de este tipo?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r44",isset($registro)?$registro[10]:"");
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
                }else if($tipo_cuestionario == 'SEG'){
                    //echo "formulario de Seguridad";

					$result.='
                    <div style="height:auto;margin-top:30%px;margin-left:; margin-right:;float:right">
                    <span style="width:60px;height:25px;" class="badge bg-primary">'.$tipo_cuestionario.'</span>
                    </div>
                        
                    <div class="" style="">
					<form action="" method="post" enctype="multipart/form-data">';
					if (isset($registro))
						$result.='
					<input type="hidden" name="accion" value="update">
					<input type="hidden" name="idRegistro" value="'.$_POST["idRegistro"].'">';
					else
						$result.='
					<input type="hidden" name="accion" value="insert">
					<input type="hidden" name="idRegistro" value="'.$_POST["idRegistro"].'">';
					$result.='
					
					<div style="background-color:;height:auto;float:left;width:100%">

					<div style="margin-top:"class="">

					<div style="margin-left:9%" class="col-md-10">
					<div class="row">

					<label style="margin-top:10px" class="col-md-5">¿Qué problemas está experimentando?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="61" name="pregunta_id">
					<input placeholder="Asunto" required="" type="text" name="r61" class="form-control" value="'.(isset($registro)?$registro[0]:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Cuándo comenzó el problema?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="62" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r62" class="form-control" value="'.(isset($registro)?$registro[1]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Cómo se conecta a Internet?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="63" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r63" class="form-control" value="'.(isset($registro)?$registro[2]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Qué software de seguridad tiene instalado en la computadora?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="65" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r65" class="form-control" value="'.(isset($registro)?$registro[3]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿A qué recursos de la red puede acceder empleando una conexión inalámbrica?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="66" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r66" class="form-control" value="'.(isset($registro)?$registro[4]:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Qué permisos tiene para utilizar los recursos?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="67" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r67" class="form-control" value="'.(isset($registro)?$registro[5]:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Alguien más ha utilizado la computadora?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r69",isset($registro)?$registro[6]:"");
									$result.='
									</div>
									</div>
 
					<label style="margin-top:10px" class="col-md-5">¿Está actualizado su software de seguridad?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r70",isset($registro)?$registro[7]:"");
									$result.='
									</div>
									</div>

					<label style="margin-top:10px" class="col-md-5">¿Ha examinado recientemente la computadora en busca de virus?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r71",isset($registro)?$registro[8]:"");
									$result.='
									</div>
									</div>

					<label style="margin-top:10px" class="col-md-5">¿Ha tenido este problema anteriormente?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r72",isset($registro)?$registro[9]:"");
									$result.='
									</div>
									</div>
                    
					<label style="margin-top:10px" class="col-md-5">¿Ha cambiado recientemente la contraseña?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r73",isset($registro)?$registro[10]:"");
									$result.='
									</div>
									</div>

					<label style="margin-top:10px" class="col-md-5">¿Ha recibido mensajes de error de su computadora?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r74",isset($registro)?$registro[11]:"");
									$result.='
									</div>
									</div>

					<label style="margin-top:10px" class="col-md-5">¿Ha compartido su contraseña?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r75",isset($registro)?$registro[12]:"");
									$result.='
									</div>
									</div>

					<label style="margin-top:10px" class="col-md-5">¿Tiene los permisos necesarios para utilizar los recursos?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r76",isset($registro)?$registro[13]:"");
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
                }else if($tipo_cuestionario == 'IMP'){
                    //echo "formulario de Impresoras";

					$result.='
					<div style="height:auto;margin-top:30%px;margin-left:; margin-right:;float:right">
                    <span style="width:60px;height:25px;" class="badge bg-primary">'.$tipo_cuestionario.'</span>
                    </div>
                        
                    <div class="" style="">
					<form action="" method="post" enctype="multipart/form-data">';
					if (isset($registro))
						$result.='
					<input type="hidden" name="accion" value="update">
					<input type="hidden" name="idRegistro" value="'.$_POST["idRegistro"].'">';
					else
						$result.='
					<input type="hidden" name="accion" value="insert">
					<input type="hidden" name="idRegistro" value="'.$_POST["idRegistro"].'">';
					$result.='
					
					<div style="background-color:;height:auto;float:left;width:100%">

					<div style="margin-top:"class="">

					<div style="margin-left:9%" class="col-md-10">
					<div class="row">

					<label style="margin-top:10px" class="col-md-5">¿Cuáles son la marca y el modelo de su impresora?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="46" name="pregunta_id">
					<input placeholder="Asunto" required="" type="text" name="r46" class="form-control" value="'.(isset($registro)?$registro[0]:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Qué tipo de papel utiliza?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="47" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r47" class="form-control" value="'.(isset($registro)?$registro[1]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Qué problemas está experimentando con la impresora?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="48" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r48" class="form-control" value="'.(isset($registro)?$registro[2]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5"> ¿Qué software o hardware ha cambiado recientemente en la computadora?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="49" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r49" class="form-control" value="'.(isset($registro)?$registro[3]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Qué estaba haciendo cuando se produjo el problema?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="50" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r50" class="form-control" value="'.(isset($registro)?$registro[4]:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Qué mensajes de error ha recibido?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="51" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r51" class="form-control" value="'.(isset($registro)?$registro[5]:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Puede imprimir una página de prueba?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r53",isset($registro)?$registro[6]:"");
									$result.='
									</div>
									</div>
 
					<label style="margin-top:10px" class="col-md-5">¿Se trata de una impresora nueva?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r54",isset($registro)?$registro[7]:"");
									$result.='
									</div>
									</div>

					<label style="margin-top:10px" class="col-md-5">¿Está encendida la impresora?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r55",isset($registro)?$registro[8]:"");
									$result.='
									</div>
									</div>

					<label style="margin-top:10px" class="col-md-5">¿Aparece el problema en todas las páginas?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r56",isset($registro)?$registro[9]:"");
									$result.='
									</div>
									</div>
                    
					<label style="margin-top:10px" class="col-md-5">¿Ha cambiado de tipo de papel recientemente?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r57",isset($registro)?$registro[10]:"");
									$result.='
									</div>
									</div>

					<label style="margin-top:10px" class="col-md-5">¿El problema se produce únicamente en esta impresora?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r58",isset($registro)?$registro[11]:"");
									$result.='
									</div>
									</div>

					<label style="margin-top:10px" class="col-md-5"> ¿Se produce el problema cuando utiliza otras aplicaciones?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r59",isset($registro)?$registro[12]:"");
									$result.='
									</div>
									</div>

					<label style="margin-top:10px" class="col-md-5">¿Está la impresora conectada a la red mediante una conexión inalámbrica?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r60",isset($registro)?$registro[13]:"");
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
                }else if($tipo_cuestionario == 'SOF'){
                    //echo "formulario de software";

					$result.='
                    <div style="height:auto;margin-top:30%px;margin-left:; margin-right:;float:right">
                    <span style="width:60px;height:25px;" class="badge bg-primary">'.$tipo_cuestionario.'</span>
                    </div>
                        
                    <div class="" style="">
					<form action="" method="post" enctype="multipart/form-data">';
					if (isset($registro))
						$result.='
					<input type="hidden" name="accion" value="update">
					<input type="hidden" name="idRegistro" value="'.$_POST["idRegistro"].'">';
					else
						$result.='
					<input type="hidden" name="accion" value="insert">
					<input type="hidden" name="idRegistro" value="'.$_POST["idRegistro"].'">';
					$result.='
					
					<div style="background-color:;height:auto;float:left;width:100%">

					<div style="margin-top:"class="">

					<div style="margin-left:9%" class="col-md-10">
					<div class="row">

					<label style="margin-top:10px" class="col-md-5">¿Cuándo ha comenzado el problema?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="77" name="pregunta_id">
					<input placeholder="Asunto" required="" type="text" name="r77" class="form-control" value="'.(isset($registro)?$registro[0]:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Cómo se llama el programa que está utilizando?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="78" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r78" class="form-control" value="'.(isset($registro)?$registro[1]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Qué versión del programa está usando?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="79" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r79" class="form-control" value="'.(isset($registro)?$registro[2]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Qué problemas está experimentando?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="80" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r80" class="form-control" value="'.(isset($registro)?$registro[3]:"").'">
					</div>

                    <label style="margin-top:10px" class="col-md-5">¿Qué estaba haciendo antes de que se presentara el problema?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="81" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r81" class="form-control" value="'.(isset($registro)?$registro[4]:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Qué acción deseaba realizar antes de que se presentara el problema?</label>
					<div style="margin-top:10px" class="col-md-8">
                    <input type="hidden" value="82" name="pregunta_id">
					<input placeholder="Descripcion" required="" type="text" name="r82" class="form-control" value="'.(isset($registro)?$registro[5]:"").'">
					</div>

					<label style="margin-top:10px" class="col-md-5">¿Ha reiniciado el programa?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r83",isset($registro)?$registro[6]:"");
									$result.='
									</div>
									</div>
 
					<label style="margin-top:10px" class="col-md-5"> ¿Conoce a alguien más que haya experimentado el mismo problema?</label>
									<div style="margin-top:10px" class="col-md-8">
									<div class="col-md-1">';
									$result.=$this->cajaDesplegablelocal($selectboolean,"r84",isset($registro)?$registro[7]:"");
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
                }

                    return $result;
                break;
				
				case 'update':

					echo "pase por update";

					// armado de cadena de insersion
					$cad = 'UPDATE cuestionarios SET respuesta_pregunta ="'.$_POST["r1"].'", 
													 ticket_id="'.$idRegistro.'",
											pregunta_id="'.$arrayanswers[0].'"
					WHERE (ticket_id,pregunta_id) = "('.$idRegistro.','.$arrayanswers[0].')"';

					//ejecuta la cadena
					$this->consulta($cad);

					//$result.=$this->proceso('list');

					break;

				

			}
			// puede retirnar el resultado o imprimirlo con echo
			return $result;
		}

		

        // funcion que cnsulta el tipo de cuestionario
        function consultartipo($idRegistro){
			
            $tipo_cuestionario = "";

            $query="SELECT tipo_cuestionario FROM tickets WHERE id = ".$idRegistro." ";


			$res = $this->consult($query);
			// echo var_dump($res);

			// volcar datos, provenientes de una consulta mysql, dentro de un array php
			$volcadoarray = mysqli_fetch_array($res);
			$tipo_cuestionario = $volcadoarray['tipo_cuestionario'];

            //echo $tipo_cuestionario;
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