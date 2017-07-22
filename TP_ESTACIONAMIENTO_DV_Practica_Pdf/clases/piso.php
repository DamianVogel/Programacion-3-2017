<?php
//Incluimos la clase AccesoDatos.php que no estaba. La copiamos desde la Carpeta Clases de Clase06
require "AccesoDatos.php";
class Piso
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $id_piso;
	private $habilitado;
//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetIdPiso()
	{
		return $this->NroCochera;
	}
	public function GetHabilitado()
	{
		return $this->Tipo;
	}

	public function SetIdPiso($valor)
	{
		$this->IdPiso = $valor;
	}
	public function SetHabilitado($valor)
	{
		$this->Habilitado = $valor;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct( $IdPiso=NULL, $Habilitado=NULL)
	{
		if($Habilitado !== NULL && $IdPiso !== NULL  ){
			$this->IdPiso = $IdPiso;
			$this->Habilitado = $Habilitado;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->IdPiso." - ".$this->Habilitado."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE

	public static function Alta($obj)
	{
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta('INSERT INTO `pisos`(`habilitado`) VALUES (1)');
		$consulta->Execute();
	}

	public static function Baja($aux)
	{
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta('UPDATE `pisos` SET `habilitado`=0 WHERE `id_piso`=:idpiso ');
		$consulta->bindvalue(':idpiso', $aux , PDO::PARAM_INT);
		$consulta->Execute();
	}

	public static function TraerTodosLosPisos()
	{
		$arrayRetorno = array();
		//Este Metodo esta creado por nosotros este.
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta('SELECT id_piso, habilitado  FROM `pisos`');
		$consulta->Execute();
		while ($fila = $consulta->fetchObject("Piso"))
		{
			 array_push($arrayRetorno,$fila);
		 }
		 
		 return $arrayRetorno;
	}

	public static function TraerUnaPiso($aux)
    {
        $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAcceso->RetornarConsulta('SELECT id_piso, habilitado FROM pisos WHERE id_piso=:idpiso');
        $consulta->bindParam("idpiso", $aux);
        $consulta->execute();
        $uno = $consulta->fetchAll();
         if($uno == NULL)
          {
              $uno="no existe";
              return $uno;
          }
        return $uno;
    }
//--------------------------------------------------------------------------------//
}