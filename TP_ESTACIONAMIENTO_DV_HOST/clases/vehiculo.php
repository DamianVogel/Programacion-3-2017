<?php

class Vehiculo
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $Id_vehiculo;
	private $Marca;
 	private $Patente;
  	private $Color;
	private $Estado;
//--------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($Id_vehiculo=NULL, $Marca=NULL, $Patente=NULL, $Color=NULL, $Estado=NULL)
	{
		if($Id_vehiculo !== NULL && $Marca !== NULL && $Patente !== NULL && $Color !== NULL && $Estado !== NULL ){
			
			$this->Id_vehiculo = $Id_vehiculo;
			$this->Marca = $Marca;
			$this->Patente = $Patente;
			$this->Color = $Color;
			$this->Estado = $Estado;
		}
	}

//--------------------------------------------------------------------------------//



//--GETTERS Y SETTERS
	public function GetId_vehiculo()
	{
		return $this->Id_vehiculo;
	}
	
	public function GetMarca()
	{
		return $this->Marca;
	}
	public function GetPatente()
	{
		return $this->Patente;
	}
	public function GetColor()
	{
		return $this->Color;
	}
	public function GetEstado()
	{
		return $this->Estado;
	}

	public function SetId_vehiculo($valor)
	{
		$this->Id_vehiculo = $valor;
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



//--TOSTRING	
  	public function ToString()
	{
		$respuesta= "Marca: " . $this->marca . '<br />'. 
					"Patente: " . $this->patente . '<br />'.
					"Color: " . $this->color . '<br />';
	  	return $respuesta;
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE

	//--METODOS DE CLASE
	public static function Alta($ArrayDeParametros)
	{			
		//if( sizeof($ArrayDeParametros) ==3 ||sizeof($ArrayDeParametros) ==4  )
		if(!is_null($ArrayDeParametros['patente']) && !is_null($ArrayDeParametros['color']) && !is_null($ArrayDeParametros['marca']))
		{	
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
			$consulta = $objetoAcceso->RetornarConsulta('INSERT INTO `vehiculos`(`Patente`, `Color`, `Marca`,`Estado`) VALUES (:patente,:color,:marca,:estado)');
			
				//parametros
				$consulta->bindvalue(':patente', $ArrayDeParametros['patente'], PDO::PARAM_STR);
				$consulta->bindvalue(':color', $ArrayDeParametros['color'] , PDO::PARAM_STR);
				$consulta->bindvalue(':marca', $ArrayDeParametros['marca'] , PDO::PARAM_STR);
				$consulta->bindvalue(':estado', 1 , PDO::PARAM_INT);

				$resultado = $consulta->Execute();
		}		
		else
		{
				$resultado = "El vehiculo no se dio de alta, falta algun dato";
		}
		return $resultado;
	}

	
	public static function Baja($aux)
	{
		if($aux!=null)
		{
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
			$consulta = $objetoAcceso->RetornarConsulta('UPDATE `vehiculos` SET `estado`=0 WHERE `patente`=:patente ');
			$consulta->bindvalue(':patente', $aux , PDO::PARAM_STR);
			$consulta->Execute();
		}
		else
		{
			return "El dato debe ser distinto de null";
		}

	}


	//Corregir ->Faltan los parametros
	public static function Modificacion($vehiculo) //PATENTE, MARCA, COLOR 
	{
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta('UPDATE `vehiculos` 
													 SET `marca`=:marca,`color`=:color,`estado`=:estado  
													 WHERE `patente`=:patente');
		
		//parametros
		$consulta->bindvalue(':patente', $vehiculo['patente'], PDO::PARAM_STR);
		$consulta->bindvalue(':marca', $vehiculo['marca'], PDO::PARAM_STR);
		$consulta->bindvalue(':color', $vehiculo['color'] , PDO::PARAM_STR);
		$consulta->bindvalue(':estado', $vehiculo['estado'] , PDO::PARAM_INT);
		
		$resultado = $consulta->Execute();
				
		return $resultado; 
	
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


	
	public static function TraerUnVehiculo($aux)
    {
    
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAcceso->RetornarConsulta('SELECT id_vehiculo, patente,  color, marca, estado FROM vehiculos WHERE patente=:patente');
        $consulta->bindParam("patente", $aux);
		
		$consulta->execute();

	    $uno = $consulta->fetchObject("Vehiculo");
        
		
		 if($uno == NULL)
          {
              return false;
          }
		  else 
		  {
			return true;			  
		  }
    }

	public static function ConstruirVehiculo($aux)
    {
    
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAcceso->RetornarConsulta('SELECT id_vehiculo, patente,  color, marca, estado FROM vehiculos WHERE patente=:patente');
        $consulta->bindParam("patente", $aux);
		
		$consulta->execute();

	    $uno = $consulta->fetchObject("Vehiculo");
        
		
		 if($uno == NULL)
          {
              return false;
          }
		  else 
		  {
			return $uno;			  
		  }
    }

	public static function TraerIdVehiculo($aux)
    {
    
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAcceso->RetornarConsulta('SELECT id_vehiculo FROM vehiculos WHERE patente=:patente');
        $consulta->bindParam("patente", $aux);
		
		$consulta->execute();

	    $uno = $consulta->fetchAll();
        
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
					v.`PATENTE`,
					`FECHA_HORA_INGRESO`, 
					`FECHA_HORA_SALIDA`, 
					`CANT_HORAS`, 
					`IMPORTE` 
				FROM vehiculos AS v 
				INNER JOIN operaciones AS op 
				WHERE v.ID_VEHICULO=op.ID_VEHICULO
				AND   v.PATENTE= :patente
				AND ISNULL(FECHA_HORA_SALIDA) 
				'
				);
        $consulta->bindParam("patente", $aux);
        $consulta->execute();
        $uno = $consulta->fetchAll(); 
         if($uno == NULL)
          {
			  $uno = "SIN OPERACIONES";
              return $uno;
          }
		return $uno;
    }

	public static function TraerCantHoras($idOperacion)
    {
        $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
        $consulta = 
			$objetoAcceso->RetornarConsulta
				('SELECT 
					`CANT_HORAS` 
				FROM  operaciones AS op 
				WHERE op.ID_OPERACION= :idOperacion
				'
				);
        $consulta->bindParam("idOperacion", $idOperacion);
        $consulta->execute();
        $uno = $consulta->fetchAll(); 
		$cant_horas = $uno[0]["CANT_HORAS"];

		return $cant_horas;
    }

	public static function InsertoOperacion ($nro_cochera,$idVehiculo,$idEmpleado)
	{
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();

	  		$consulta = $objetoAcceso->RetornarConsulta('INSERT INTO operaciones(`ID_COCHERA`,`ID_VEHICULO`,`ID_EMPLEADO`,`FECHA_HORA_INGRESO`)  VALUES  (:idcochera,:idvehiculo,:idempleado,NOW())');
			$consulta->bindvalue(':idcochera', $nro_cochera, PDO::PARAM_INT);
			$consulta->bindvalue(':idvehiculo', $idVehiculo, PDO::PARAM_INT);
			$consulta->bindvalue(':idempleado', $idEmpleado, PDO::PARAM_INT);

            $consulta->execute();
			
			$resultado = $consulta->rowCount();
			return $resultado; 
	}

	public static function BajaOperacion ($vehiculo)
	{
			//ASIGNACION DE VARIABLES
				$idOperacion = $vehiculo[0]["ID_OPERACION"];
				$nroCochera  = $vehiculo[0]["ID_COCHERA"];
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
			//SQL
				//SQL - DECLARACIONES
					//INSERTAR FECHA_HORA_SALIDA
						$consulta1= $objetoAcceso->RetornarConsulta('UPDATE operaciones
																	SET FECHA_HORA_SALIDA=NOW()  
																	WHERE id_operacion = :idOperacion');
					
						$consulta1->bindvalue(':idOperacion', $idOperacion, PDO::PARAM_INT);
						$consulta1->execute();
					
					//CALCULAR TIEMPO
						$consulta2= $objetoAcceso->RetornarConsulta('UPDATE operaciones
																	SET CANT_HORAS=TIMESTAMPDIFF(MINUTE,FECHA_HORA_INGRESO,FECHA_HORA_SALIDA)/60   
																	WHERE id_operacion = :idOperacion');
						$consulta2->bindvalue(':idOperacion', $idOperacion, PDO::PARAM_INT);
						
						$consulta2->execute();
					
					//HABILITAR LA COCHERA
						$consulta3= $objetoAcceso->RetornarConsulta('UPDATE cocheras
																	SET HABILITADA=1   
																	WHERE id_cochera = :idCochera');
				
						$consulta3->bindvalue(':idCochera', $nroCochera, PDO::PARAM_INT);
						$consulta3->execute();
				

				
					
					
					
			
			//LOGICAS
                                
				//CALCULO IMPORTE
				 	$tarifas = $objetoAcceso -> RetornarConsulta('SELECT IMPORTE FROM tarifas');
					$tarifas->Execute();

					while ($fila = $tarifas->fetchAll())
					{	
						$arrayRetorno = [];
						array_push($arrayRetorno,$fila);
					}

					$tarifaHora = 			$arrayRetorno[0][0]["IMPORTE"];
					$tarifaFijaMediaEST = 	$arrayRetorno[0][1]["IMPORTE"];
					$tarifaFijaComplEST = 	$arrayRetorno[0][2]["IMPORTE"];

					$cantHoras = ceil(Vehiculo::TraerCantHoras($idOperacion)); 

					switch ($cantHoras)
					{
						case ($cantHoras<=8):
							$importe = $cantHoras * $tarifaHora;
							break;
						case ($cantHoras>8 && $cantHoras<=12):
							$importe = $tarifaFijaMediaEST;
							break;
						case ($cantHoras>12 && $cantHoras<=19):
							$importe = $tarifaFijaMediaEST + ($cantHoras - 12)*$tarifaHora;
							break;
						case ($cantHoras>=20):
							$importe = $tarifaFijaComplEST;
							break;
					}
				//UPDATE de IMPORTE
					 $consulta4 = $objetoAcceso -> RetornarConsulta('UPDATE operaciones
				 												 	 SET	importe=:importe
																 	 WHERE 	id_operacion = :idOperacion 
				 								');
					 $consulta4->bindvalue(':idOperacion', $idOperacion, PDO::PARAM_INT);
					 $consulta4->bindvalue(':importe', $importe, PDO::PARAM_STR);
					 $consulta4->execute();

			return $importe; 
	}


//--------------------------------------------------------------------------------//
}