<?php
//Incluimos la clase AccesoDatos.php que no estaba. La copiamos desde la Carpeta Clases de Clase06
class Cochera
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $id_cochera;
	private $nro_cochera;
	private $reservado;
	private $habilitada;
//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetId_Cochera()
	{
		return $this->id_cochera;
	}
	
	public function GetNroCochera()
	{
		return $this->nro_cochera;
	}
	
	public function GetReservado()
	{
		return $this->reservado;
	}
	
	public function GetHabilitada()
	{
		return $this->habilitada;
	}


	public function SetNroCochera($valor)
	{
		$this->nro_cochera = $valor;
	}
	
	public function SetReservado($valor)
	{
		$this->reservado = $valor;
	}
	
	public function SetHabilitada($valor)
	{
		$this->habilitada = $valor;
	}


//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct( $nro_cochera=NULL,  $reservado=NULL,  $habilitada=NULL)
	{
		if($nro_cochera !== NULL &&  $reservado !== NULL &&  $habilitada !== NULL ){
		
			$this->nro_cochera = $nro_cochera;
			
			$this->reservado = $reservado;
			
			$this->habilitada = $habilitada;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->nro_cochera." - ".$this->reservado." - ".$this->habilitada."\r\n";
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
		$consulta = $objetoAcceso->RetornarConsulta('UPDATE `cocheras` SET HABILITADA = 0 WHERE `nro_cochera`=:nrocochera');
		$consulta->bindvalue(':nrocochera', $aux, PDO::PARAM_INT);
	
		$consulta->Execute();
		
		$resultado = $consulta->rowCount();
	
		return $resultado;
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

	public static function TraerUnaCocheraVaciaNormales()
    {
        $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAcceso->RetornarConsulta('SELECT id_cochera, nro_cochera FROM cocheras WHERE habilitada=1 and reservado=0 LIMIT 1');
		$consulta->execute();
        
		$uno = $consulta->fetchAll();
         if($uno == NULL)
          {
            
              return $uno;
          }
		  else
		  	{
					return $uno;
			}					
	
	}

	public static function TraerUnaCocheraVaciaReservadas()
    {
        $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAcceso->RetornarConsulta('SELECT nro_cochera FROM cocheras WHERE habilitada=1');
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