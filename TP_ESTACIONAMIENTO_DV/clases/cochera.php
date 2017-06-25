<?php
//Incluimos la clase AccesoDatos.php que no estaba. La copiamos desde la Carpeta Clases de Clase06
class Cochera
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $NroCochera;
 	private $Tipo;
  	private $Reservado;
	private $Estado_Actual;
	private $Habilitada;
//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetNroCochera()
	{
		return $this->NroCochera;
	}
	public function GetTipo()
	{
		return $this->Tipo;
	}
	public function GetReservado()
	{
		return $this->Reservado;
	}
	public function GetEstado_Actual()
	{
		return $this->Estado_Actual;
	}
	public function GetHabilitada()
	{
		return $this->Habilitada;
	}


	public function SetNroCochera($valor)
	{
		$this->NroCochera = $valor;
	}
	public function SetTipo($valor)
	{
		$this->Tipo = $valor;
	}
	public function SetReservado($valor)
	{
		$this->Reservado = $valor;
	}
	public function SetEstado_Actual($valor)
	{
		$this->Estado_Actual = $valor;
	}
	public function SetHabilitada($valor)
	{
		$this->Habilitada = $valor;
	}


//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct( $NroCochera=NULL, $Tipo=NULL, $Reservado=NULL, $Estado_Actual=NULL, $Habilitada=NULL)
	{
		if($NroCochera !== NULL && $Tipo !== NULL && $Reservado !== NULL && $Estado_Actual !== NULL && $Habilitada !== NULL ){
			$this->NroCochera = $NroCochera;
			$this->Tipo = $Tipo;
			$this->Reservado = $Reservado;
			$this->Estado_Actual = $Estado_Actual;
			$this->Habilitada = $Habilitada;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->NroCochera." - ".$this->Tipo." - ".$this->Reservado."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE

	public static function Alta($obj)
	{
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta('INSERT INTO `cocheras`(`nro_cochera`, `tipo`, `Reservado`, `Estado_Actual`,`Habilitada`) VALUES ($obj[0],$obj[1],$obj[2],`DISPONIBLE`,1)');
		$consulta->Execute();
	}

	public static function BajaCochera($aux)
	{
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta('UPDATE `cocheras` SET `habilitada`=0 WHERE `nrocochera`=:nrocochera ');
		$consulta->bindvalue(':nrocochera', $aux , PDO::PARAM_INT);
		$consulta->Execute();
	}

	public static function BajaEstadoCochera($aux)
	{
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta('UPDATE `cocheras` SET `Estado_Actual`=[OCUPADA] WHERE `nrocochera`=:nrocochera ');
		$consulta->bindvalue(':nrocochera', $aux , PDO::PARAM_INT);
		$consulta->Execute();
	}

	public static function Modificacion($obj) //PATENTE, nro_cochera, Reservado 
	{
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta('UPDATE `cocheras` SET `nro_cochera`=$obj[0],`reservado`=$obj[1],`tipo`=$obj[2],`habilitada`=$obj[3]  WHERE `nro_cochera`=:nro_cochera ');
		$consulta->bindvalue(':nro_cochera',$obj[0], PDO::PARAM_INT); //ARREGLAR
		$consulta->Execute();
	}

	public static function TraerTodasLasCocheras()
	{
		$arrayRetorno = array();
		//Este Metodo esta creado por nosotros este.
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta('SELECT nro_cochera, Reservado, Estado_Actual, tipo, habilitada  FROM `cocheras`');
		$consulta->Execute();
		while ($fila = $consulta->fetchObject("Cochera"))
		{
			 array_push($arrayRetorno,$fila);
		 }
		 
		 return $arrayRetorno;
	}

	public static function TraerUnaCocheraVacia()
    {
        $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAcceso->RetornarConsulta('SELECT nro_cochera FROM cocheras WHERE estado_actual=:estado ');
        $estado = 'Libre';
		$consulta->bindParam("estado",$estado );
		$consulta->execute();
        $uno = $consulta->fetchAll();
         if($uno == NULL)
          {
              $uno="NO HAY";
              return $uno;
          }
        return $uno;
    }
//--------------------------------------------------------------------------------//
}