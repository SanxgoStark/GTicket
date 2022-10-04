<?
// archivo generico para base de datos


class BaseDatos
{
	// para atributos de clase usar var
	var $EstatusConexion;
	var $bloqueRegistros;
	// atributo para error
	var $error;
	// atributo para numero de registros
	var $numeroRegistros;

	function __construct(){

	}

	function iniciarConexion(){
		// $this->variable=valor, fora de usar un atributo de una clase
		// para hacer usu de elemento interno de la clase debo de utilizar this->

		// servidor,usuario,la clave,bd
		$this->EstatusConexion=mysqli_connect("localhost","root","","db_tickets");
	}

	function cerrarConexion(){
		// cierre de conexion
		mysqli_close($this->EstatusConexion);
	}


	function consulta($query){

		$this->iniciarConexion();
		// si algo de la consulta quedo , se queda aqui
		$this->bloqueRegistros = mysqli_query($this->EstatusConexion,$query); // regresa el bloque de registros 
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

	// FUNCION ECHA POR MI
	function consult($query){
		$this->iniciarConexion();
		$total = mysqli_query($this->EstatusConexion,$query);

		return $total;
	}

	function traeRegistro(){
	return mysqli_fetch_row($this->bloqueRegistros);
	}

	function sacaTupla($query){
		$this->consulta($query); 
		return mysqli_fetch_array($this->bloqueRegistros);
	}

	function numeCampos(){
		return mysqli_num_fields($this->bloqueRegistros);
	}

	function cajaDesplegable($table,$nombCampFormulario,$nombPK,$nombCampDesplegar,$seleccionado){
		
		$result='<select name="'.$nombCampFormulario.'" class="form-control">';
		$this->consulta("SELECT * FROM ".$table." order by ".$nombCampDesplegar);
		foreach ($this->bloqueRegistros as $registro) 
     $result.='<option value="'.$registro[$nombPK].'" '.(($seleccionado == $registro[$nombPK])?" selected ":"").' >'.$registro[$nombCampDesplegar].'</option>';
   $result.="</select>";
   return $result;
	}


	function infoCampo($columna){
		return mysqli_fetch_field_direct($this->bloqueRegistros,$columna);
	}

}

?>