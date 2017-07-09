<?php

class Vehiculo
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $id_vehiculo;
	private $marca;
 	private $patente;
  	private $color;
	private $estado;
//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetId()
	{
		return $this->id_vehiculo;
	}
	
	public function GetMarca()
	{
		return $this->marca;
	}
	public function GetPatente()
	{
		return $this->patente;
	}
	public function GetColor()
	{
		return $this->color;
	}
	public function GetEstado()
	{
		return $this->estado;
	}

	public function SetId_vehiculo($valor)
	{
		$this->id_vehiculo = $valor;
	}
	
	public function SetMarca($valor)
	{
		$this->marca = $valor;
	}
	public function SetPatente($valor)
	{
		$this->patente = $valor;
	}
	public function SetColor($valor)
	{
		$this->color = $valor;
	}
	public function SetEstado($valor)
	{
		$this->estado = $valor;
	}


//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($id_vehiculo=NULL, $marca=NULL, $patente=NULL, $color=NULL, $estado=NULL)
	{
		if($id_vehiculo !== NULL && $marca !== NULL && $patente !== NULL && $color !== NULL && $estado !== NULL ){
			
			$this->id_vehiculo = $id_vehiculo;
			$this->marca = $marca;
			$this->patente = $patente;
			$this->color = $color;
			$this->estado = $estado;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->marca." - ".$this->patente." - ".$this->color."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE

	//--METODOS DE CLASE


	//Probar
	public static function Alta($ArrayDeParametros)
	{				
		
		
		
		//query de alta
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta('INSERT INTO `vehiculos`(`Patente`, `Color`, `Marca`,`Estado`) VALUES (:patente,:turno,:password,:estado)');
		
			//parametros
			$consulta->bindvalue(':patente', $ArrayDeParametros['patente'], PDO::PARAM_STR);
			$consulta->bindvalue(':turno', $ArrayDeParametros['color'] , PDO::PARAM_STR);
			$consulta->bindvalue(':password', $ArrayDeParametros['marca'] , PDO::PARAM_STR);
			$consulta->bindvalue(':estado', 1 , PDO::PARAM_STR);

			$resultado = $consulta->Execute();
							
			
			return $resultado;
		
	
	}

	//Probar estado=DESHABILITADO??
	public static function Baja($aux)
	{
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta('UPDATE `vehiculos` SET `estado`=[DESHABILITADO] WHERE `patente`=:patente ');
		$consulta->bindvalue(':patente', $aux , PDO::PARAM_STRING);
		$consulta->Execute();
	}


	//Corregir ->Faltan los parametros
	public static function Modificacion($obj) //PATENTE, MARCA, COLOR 
	{
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta('UPDATE `vehiculos` SET `patente`=$obj[0],`marca`=$obj[1],`color`=$obj[2] WHERE `patente`=:patente ');
		$consulta->bindvalue(':patente',$obj[0], PDO::PARAM_STRING);
		//Faltan los parametros de modificacion
			
		$consulta->Execute();
	}

	public static function TraerTodosLosVehiculos()
	{
		$arrayRetorno = array();
		//Este Metodo esta creado por nosotros este.
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta('SELECT *  FROM `vehiculos`'); //Chequear si debe traer los vehiculos que estan estacionados.
		$consulta->Execute();
		
		
		//Probar esto.. no se si flashearon.
		while ($fila = $consulta->fetchObject("Vehiculo")) //devuelve true o false depende si encuentra o no el objeto. 
		 {
			 array_push($arrayRetorno,$fila);
		 }
		 
		 return $arrayRetorno;
	}


	//DV probar en postman -> Sin Luz
	public static function TraerUnVehiculo($aux)
    {
    
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAcceso->RetornarConsulta('SELECT id_vehiculo, patente,  color, marca, estado FROM vehiculos WHERE patente=:patente');
        $consulta->bindParam("patente", $aux);
		
		$consulta->execute();

	    $uno = $consulta->fetchObject("Vehiculo");
        
		
		 if($uno == NULL)
          {
			  $uno="No se encontro vehiculo";
              return $uno;
          }
		return $uno;
    }

	
	
	public static function TraerUnVehiculoOperaciones($aux)
    {
        $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
        $consulta = 
			$objetoAcceso->RetornarConsulta
				('SELECT 
					`ID_OPERACION`, 
					`ID_COCHERA`,  
					`HORA_INGRESO`, 
					`HORA_SALIDA`, 
					`CANT_HORAS`, 
					`ID_TARIFA`, 
					`IMPORTE` 
				FROM vehiculos AS v 
				INNER JOIN operaciones AS op 
				WHERE v.ID_VEHICULO=op.ID_VEHICULO
				AND   v.PATENTE= :patente');
        $consulta->bindParam("patente", $aux);
        $consulta->execute();
        $uno = $consulta->fetchAll(); // CHEQUEAR SI TIENE QUE SER LA OPERACION TIENE QUE SER UN OBJETO... 
         if($uno == NULL)
          {
			  $uno = "SIN OPERACIONES";
              return $uno;
          }
		return $uno;
    }

	public static function InsertoOperacion ($nro_cochera,$hora,$idVehiculo,$idEmpleado)
	{
			
			
			
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
			//Ver que este estacionado (Hora salida)
			//Traer datos del vehiculo, con hora salida dsp del insert
	  		$consulta = $objetoAcceso->RetornarConsulta('INSERT INTO operaciones(`ID_COCHERA`,`ID_VEHICULO`,`ID_EMPLEADO`,`HORA_INGRESO`)  VALUES  (:idcochera,:idvehiculo,:idempleado,:horaingreso)');
            
			$consulta->bindvalue(':idcochera', $nro_cochera->GetNroCochera(), PDO::PARAM_INT);
			$consulta->bindvalue(':idvehiculo', $idVehiculo, PDO::PARAM_INT);
			$consulta->bindvalue(':idempleado', $idEmpleado, PDO::PARAM_INT);
			$consulta->bindvalue(':horaingreso', $hora , PDO::PARAM_STR);
						//VALUES (:idcochera,:idvehiculo,:idempleado,:horaingreso)
            $consulta->execute();
			
			$resultado = $consulta->rowCount();
			//$obj = $consulta->fetchAll();
			
			return $resultado;
		   
	}
//--------------------------------------------------------------------------------//
}