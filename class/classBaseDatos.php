<?

class BaseDatos
{
	// atributo para almacenar el estatus de la conexion
	var $EstatusConexion;
	// atributo para almacenar un bloque de registros
	var $bloqueRegistros;
	// atributo para almacenamiento de error
	var $error;
	// atributo para numero de registros
	var $numeroRegistros;

	// constructor vacio
	function __construct(){}

	// funcion para iniciar conexion a la base de datos
	function iniciarConexion(){

		//ejecucion de funcion parametros (servidor,usuario,la clave,bd)
		$this->EstatusConexion=mysqli_connect("localhost","root","","db_ticketsv2");
	}

	// funcion para cierre de conexion a la base de datos
	function cerrarConexion(){
		// ejecucion de funcion para cierre
		mysqli_close($this->EstatusConexion);
	}

	// funcion para ejecucion de consulta
	function consulta($query){

		// inicio de conexion
		$this->iniciarConexion();
		// regresa el bloque de registros resultado de la ejecucion de la consulta
		$this->bloqueRegistros = mysqli_query($this->EstatusConexion,$query);
		// alamacenamiento de error si existe
		$this->error=mysqli_error($this->EstatusConexion);
		if ($this->error>""){
			echo $query." ".$this->error;
			exit;
		}
		if(strpos(strtolower($query),"select") !== false)
			$this->numeroRegistros=mysqli_num_rows($this->bloqueRegistros);
		else $this->numeroRegistros = 0;
		$this->cerrarConexion();
	}

	// funcion para ejecucion de consulta
	function consult($query){
		// estableciminto de conexion 
		$this->iniciarConexion();
		// ejecucion de consulta
		$total = mysqli_query($this->EstatusConexion,$query);

		// retorno de resultado
		return $total;
	}
	
	// funcion para traer un regristro de un bloque
	function traeRegistro(){
	return mysqli_fetch_row($this->bloqueRegistros);
	}

	// funcion para traer un regristro de un bloque
	function sacaTupla($query){
		$this->consulta($query); 
		return mysqli_fetch_array($this->bloqueRegistros);
	}

	// funcion para traer el numero de columnas de un bloque de registros
	function numeCampos(){
		return mysqli_num_fields($this->bloqueRegistros);
	}

	// funcion para rellenar caja desplegable
	function cajaDesplegable($table,$nombCampFormulario,$nombPK,$nombCampDesplegar,$seleccionado){
		
		$result='<select name="'.$nombCampFormulario.'" class="form-control">';
		$this->consulta("SELECT * FROM ".$table." order by ".$nombCampDesplegar);
		foreach ($this->bloqueRegistros as $registro) 
     $result.='<option value="'.$registro[$nombPK].'" '.(($seleccionado == $registro[$nombPK])?" selected ":"").' >'.$registro[$nombCampDesplegar].'</option>';
   $result.="</select>";
   return $result;
	}

	// funcion para rellenar caja desplegable
	function cajaDesplegablebloq($table,$nombCampFormulario,$nombPK,$nombCampDesplegar,$seleccionado){
		
		$result='<select name="'.$nombCampFormulario.'" class="form-control" disabled>';
		$this->consulta("SELECT * FROM ".$table." order by ".$nombCampDesplegar);
		foreach ($this->bloqueRegistros as $registro) 
     $result.='<option value="'.$registro[$nombPK].'" '.(($seleccionado == $registro[$nombPK])?" selected ":"").' >'.$registro[$nombCampDesplegar].'</option>';
   $result.="</select>";
   return $result;
	}

	// funcion para rellenar caja desplegable
	function cajaDesplegablelocal($arreglo,$campoFormulario,$registro){

		$result='<select name="'.$campoFormulario.'" class="form-control">';
		foreach ((array)$arreglo as $elemento) 
     $result.='<option value="'.$elemento.'" '.(($registro == $elemento)?" selected ":"").'>'.$elemento.'</option>';
   $result.="</select>";

   return $result;
	}

	// funcion para rellenar caja desplegable
	function cajaDesplegablelocalbloq($arreglo,$campoFormulario,$registro){

		$result='<select name="'.$campoFormulario.'" class="form-control" disabled>';
		foreach ((array)$arreglo as $elemento) 
     $result.='<option value="'.$elemento.'" '.(($registro == $elemento)?" selected ":"").'>'.$elemento.'</option>';
   $result.="</select>";

   return $result;
	}

	// funcion para devolucion de metadatos de una columna
	function infoCampo($columna){
		return mysqli_fetch_field_direct($this->bloqueRegistros,$columna);
	}

}

?>