<?php
//Incluimos la clase AccesoDatos.php que no estaba. La copiamos desde la Carpeta Clases de Clase06

class Mascota
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $Id;
	private $Nombre;
 	private $Tipo;
	private $FechaDeNacimiento;
	private $rutaDeFoto;
      
	
//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function Getid()
	{
		return $this->id;
	}
	
	public function Getnombre()
	{
		return $this->nombre;
	}
	public function GetTipo()
	{
		return $this->tipo;
	}
	public function GetfechaDeNacimiento()
	{
		return $this->fechaDeNacimiento;
	}
	public function GetRutaDeFoto()
	{
		return $this->RutaDeFoto;
	}
	

	public function Setid($valor)
	{
		$this->id = $valor;
	}
	public function Setnombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetTipo($valor)
	{
		$this->tipo = $valor;
	}
	public function SetfechaDeNacimiento($valor)
	{
		$this->fechaDeNacimiento = $valor;
	}
	public function SetRutaDeFoto($valor)
	{
		$this->RutaDeFoto = $valor;
	}


//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	//DV PROBAR ID -> POSTMAN SIN LUZ -> AGREGADO EL ATRIBUTO ID PARA PODER MODIFICAR.
	public function __construct( $id=NULL,$nombre=NULL, $tipo=NULL, $fechaDeNacimiento=NULL, $RutaDeFoto=NULL)
	{
		if( $id !== NULL && $nombre !== NULL && $tipo !== NULL && $fechaDeNacimiento !== NULL && $RutaDeFoto !== NULL){
			
			$this->id = $id;
			$this->nombre = $nombre;
			$this->tipo = $tipo;
			$this->fechaDeNacimiento = $fechaDeNacimiento;
			$this->RutaDeFoto = $RutaDeFoto;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	// public function ToString()
	// {
	//   	return $this->id_Helado." - ".$this->sabor." - ".$this->tipo." - ".$this->kilos."\r\n";
	// }
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE

	///////////////////////////////////ABM//////////////////////////////////////
		public static function AltaMascota($mascota)
		{
			
			if( sizeof($mascota) == 3 )
			{
					$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
					$consulta = $objetoAcceso->RetornarConsulta('INSERT INTO mascotas(nombre,tipo,fechaDeNacimiento,RutaDeFoto) VALUES (:nombre,:tipo,:fechaDeNacimiento,:RutaDeFoto)');
			
				//parametros
					$consulta->bindvalue(':nombre', $mascota['nombre'], PDO::PARAM_STR);
					$consulta->bindvalue(':tipo', $mascota['tipo'] , PDO::PARAM_STR);
					$consulta->bindvalue(':fechaDeNacimiento', $mascota['fechaDeNacimiento'] , PDO::PARAM_STR);
					$consulta->bindvalue(':RutaDeFoto', 'prueba' , PDO::PARAM_STR);
					
					$resultado = $consulta->Execute();			
			}		
			else
			{
					$resultado = false;
			}


			return $resultado;	
		}

      
	/////////////////////////////////TRAER BD////////////////////////////////////////////
		public static function TraerTodasLasMascotas()
		{
			$arrayRetorno = array();
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
			$consulta = $objetoAcceso->RetornarConsulta('SELECT id, nombre, tipo, fechaDeNacimiento, RutaDeFoto FROM mascotas');
			$consulta->Execute();
			return $consulta->fetchAll(PDO::FETCH_CLASS,"Mascota");
			
		}
		
		public static function TraerUnaMascota($id)
		{
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
			$consulta = $objetoAcceso->RetornarConsulta('SELECT id, nombre, tipo, fechaDeNacimiento, RutaDeFoto FROM mascotas
														 WHERE id=:id');
			$consulta->bindParam("id", $id);
			$consulta->execute();
			$uno = $consulta->fetchObject("Mascota");
			
			if($uno == NULL)
			{ 
				$uno=0; 
				return $uno;
			}
			else 
			{ 
				return $uno; 
			}
		}

		public static function BajaMascota($id)
		{
			
			if(is_numeric($id))
			{
				$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
				$consulta = $objetoAcceso->RetornarConsulta('DELETE FROM `mascotas` 
															
															WHERE 	id=:id');
				
				//parametros
				$consulta->bindvalue(':id', $id , PDO::PARAM_INT); 
				$consulta->Execute();
				
				$resultado = $consulta->rowCount();
			
					if ($resultado==0)
					{
						$resultado = "El empleado no existe";
					}
					else
					{
						$resultado = "El empleado fue BORRADO";
					}

				return $resultado;
			}
			else
			{
				return "El dato es invalido, debe ser un entero";
			}
		
		
		}

	

	

//--------------------------------------------------------------------------------//
}