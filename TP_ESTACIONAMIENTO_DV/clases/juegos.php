<?php
//Incluimos la clase AccesoDatos.php que no estaba. La copiamos desde la Carpeta Clases de Clase06

class Juegos
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $Id_juego;
	private $Juego;
 	private $Jugador;
  	private $Gano;
	
//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	
	public function GetId_juego()
	{
		return $this->Id_juego;
	}
	
	public function GetJuego()
	{
		return $this->Juego;
	}
	public function GetJugador()
	{
		return $this->Jugador;
	}
	public function GetGano()
	{
		return $this->Gano;
	}
	


	public function SetId_juego($valor)
	{
		$this->Id_juego = $valor;
	}
	public function SetJuego($valor)
	{
		$this->Juego = $valor;
	}
	public function SetJugador($valor)
	{
		$this->Jugador = $valor;
	}
	public function SetGano($valor)
	{
		$this->Gano = $valor;
	}
	
	

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	
	public function __construct( $Id_juego=NULL,$Juego=NULL, $Jugador=NULL, $Gano=NULL)
	{
		if( $Id_juego !== NULL && $Juego !== NULL && $Jugador !== NULL && $Gano !== NULL){
			
			$this->Id_juego = $Id_juego;
			$this->Juego = $Juego;
			$this->Jugador = $Jugador;
			$this->Gano = $Gano;
			
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
	/*
	public function ToString()
	{
	  	return $this->Nombre." - ".$this->Turno." - ".$this->Password."\r\n";
	}
	*/
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE

	///////////////////////////////////ABM//////////////////////////////////////
		public static function AltaJuego($juego)
		{
			
			try{
					$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
					$consulta = $objetoAcceso->RetornarConsulta('INSERT INTO juegos (JUEGO,JUGADOR,GANO) VALUES (:juego,:jugador,:gano)');
			
				//parametros
					$consulta->bindvalue(':juego', $juego['juego'], PDO::PARAM_STR);
					$consulta->bindvalue(':jugador', $juego['jugador'] , PDO::PARAM_STR);
					$consulta->bindvalue(':gano', $juego['gano'] , PDO::PARAM_INT);
					
					$resultado = $consulta->Execute();			
				}
				catch (Exception $e)
                        {
                                $resultado = "Error al ejecutar la sentencia en Alta. Clase Juegos (detalle del error:".$e->getMessage();
                        }


			return $resultado;	
		}

	
   
	

	/////////////////////////////////TRAER BD////////////////////////////////////////////
		public static function TraerTodosLosJuegos()
		{
			$arrayRetorno = array();
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
			$consulta = $objetoAcceso->RetornarConsulta('SELECT id_juego, juego, jugador, gano  
														 FROM `juegos`');
			$consulta->Execute();
			while ($fila = $consulta->fetchObject("Juegos")) {array_push($arrayRetorno,$fila);}
			
			return $arrayRetorno;
		}
		
		public static function TraerUnUsuario($id)
		{
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
			$consulta = $objetoAcceso->RetornarConsulta('SELECT nombre, password, tipo, turno, estado 
														 FROM usuarios 
														 WHERE id_empleado=:id');
			$consulta->bindParam("id", $id);
			$consulta->execute();
			$uno = $consulta->fetchObject("Usuario");
			
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

	

	

//--------------------------------------------------------------------------------//
}