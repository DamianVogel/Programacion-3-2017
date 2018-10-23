<?php
//Incluimos la clase AccesoDatos.php que no estaba. La copiamos desde la Carpeta Clases de Clase06

class Juegos
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $Id_juego;
	public $Juego;
 	public $Jugador;
  	public $Gano;
	
//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	/*
	public function GetId_empleado()
	{
		return $this->Id_empleado;
	}
	
	public function GetNombre()
	{
		return $this->Nombre;
	}
	public function GetTurno()
	{
		return $this->Turno;
	}
	public function GetPassword()
	{
		return $this->Password;
	}
	public function GetTipo()
	{
		return $this->Tipo;
	}
	public function GetEstado()
	{
		return $this->Estado;
	}


	public function SetNombre($valor)
	{
		$this->Nombre = $valor;
	}
	public function SetTurno($valor)
	{
		$this->Turno = $valor;
	}
	public function SetPassword($valor)
	{
		$this->Password = $valor;
	}
	public function SetTipo($valor)
	{
		$this->Tipo = $valor;
	}
	public function SetEstado($valor)
	{
		$this->Estado = $valor;
	}
	*/

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
			
		
					$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
					$consulta = $objetoAcceso->RetornarConsulta('INSERT INTO juegos (JUEGO,JUGADOR,GANO) VALUES (:juego,:jugador,:gano)');
			
				//parametros
					$consulta->bindvalue(':juego', $juego['juego'], PDO::PARAM_STR);
					$consulta->bindvalue(':jugador', $juego['jugador'] , PDO::PARAM_STR);
					$consulta->bindvalue(':gano', $juego['gano'] , PDO::PARAM_BOOL);
					
					$resultado = $consulta->Execute();			
			
					//$resultado = false;
			


			return $resultado;	
		}

		/*
		public static function DeshabilitarEmp($id)
		{
			//query
			if(is_numeric($id))
			{
				$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
				$consulta = $objetoAcceso->RetornarConsulta('UPDATE `usuarios` SET `Estado`=:estado WHERE id_empleado=:id ');
				
				//parametros
				$consulta->bindvalue(':id', $id , PDO::PARAM_INT); 
				$consulta->bindvalue(':estado', "DESHABILITADO" , PDO::PARAM_STR); 
				$resultado = $consulta->Execute();
			
				$resultado = "El empleado fue DESHABILITADO";

				return $resultado;
			}
			else
			{
				return "El dato es invalido, debe ser un entero";
			}


		}
		*/
		public static function BajaEmp($id)
		{
			
			if(is_numeric($id))
			{
				$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
				$consulta = $objetoAcceso->RetornarConsulta('UPDATE `usuarios` 
															SET	ESTADO_BASE =0  
															WHERE 	id_empleado=:id ');
				
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


		public static function ModEmp($empleado)
		{
			if( sizeof($empleado) ==4 )
			{
				$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
				$consulta = $objetoAcceso->RetornarConsulta('UPDATE `usuarios` 
															SET `nombre`=:nombre,`Turno`=:turno,`Estado`=:estado  
															WHERE `id_empleado`=:id');
				
				//parametros
				$consulta->bindvalue(':id', $empleado['id'], PDO::PARAM_INT);
				$consulta->bindvalue(':nombre', $empleado['nombre'], PDO::PARAM_STR);
				$consulta->bindvalue(':turno', $empleado['turno'] , PDO::PARAM_STR);
				$consulta->bindvalue(':estado', $empleado['estado'] , PDO::PARAM_STR);
				
				$resultado = $consulta->Execute();
			
				

				if($resultado==TRUE)
				{
					$resultado = "Modifico";
				}
					else
						$resultado = "No se modifico";
			}		
			else
			{
					$resultado = "El empleado no se modifico, falta algun dato";
			}
					
			return $resultado; 
		
		}


	

    //////////////////////////////////ACCIONES//////////////////////////////////////    
		public static function SignIn($arrayParametros)
		{
				$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
				if(sizeof($arrayParametros)==2)
				{
					$consulta = $objetoAcceso->RetornarConsulta('SELECT id_empleado, nombre, tipo, turno, estado  FROM `usuarios` WHERE nombre=:nombre and password=:password');
					$consulta->bindvalue(':nombre', $arrayParametros['nombre'], PDO::PARAM_STR);
					$consulta->bindvalue(':password', $arrayParametros['password'] , PDO::PARAM_STR);
					
					$consulta->execute();

					
					$uno = $consulta->fetchObject("Usuario");
					
				

					if($uno==true)
					{
						/*
						if($arrayParametros['recordarme']=="true")
							{
								setcookie("registro",$arrayParametros['nombre'],  time()+36000 , '/');
								
							}else
							{
								setcookie("registro",$arrayParametros['nombre'],  time()-36000 , '/');
								
							}
								//session_start();
						*/
								$_SESSION['registrado']=$uno;						
								
								Usuario::LogInEmp($uno->id_empleado);
							
								$retorno="ingreso y es de tipo:".$uno->tipo;

					}
					else
					{
						$retorno= "No-esta";
					}
					
				}
				else
				{
						$retorno ="Debe completar todos los parametros";
				}
				return $retorno;
		}

		public static function ValidarTipoEmp ($id_empleado)
		{
					$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
					$consulta = $objetoAcceso->RetornarConsulta('SELECT tipo FROM usuarios WHERE id_empleado=:id');
					$consulta->bindParam("id",$id_empleado);  //Probar esto
					$consulta->execute();
					$dos= $consulta->fetchObject("Usuario");
				return $response_array['tipo_empleado']= $dos->tipo;
		}

	
	//////////////////////////////////LOGUEO///////////////////////////////////////////////
		public static function LogInEmp ($id)
		{
				$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();

				//Inserto en los LOGS generales
				$hoy = date('Y-m-d');
					
				$consulta = $objetoAcceso->RetornarConsulta('INSERT INTO logs_empleados
																(`ID_LOG_EMPLEADO`,`ID_EMPLEADO`,`FECHA`,`HORA_ENTRADA`,`HORA_SALIDA`)  
															 VALUES 
															 	(NULL			  ,:id			,:hoy	,NOW()	   	   ,NULL		 )');
				$consulta->bindParam("id",$id); 
				$consulta->bindParam("hoy",$hoy); 
				$consulta->execute();
			
				return true;
		}

			public static function LogOutEmp ($id)
		{
				$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
				$consulta = $objetoAcceso->RetornarConsulta('UPDATE logs_empleados 
															 SET `HORA_SALIDA`=NOW() 
															 WHERE ID_EMPLEADO=:id');
				$consulta->bindParam("id",$id);  
				$consulta->execute();
			
				return true;
		}
	

	/////////////////////////////////TRAER BD////////////////////////////////////////////
		public static function TraerTodosLosJuegos()
		{
			$arrayRetorno = array();
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
			$consulta = $objetoAcceso->RetornarConsulta('SELECT Id_juego, Juego, Jugador, Gano  
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