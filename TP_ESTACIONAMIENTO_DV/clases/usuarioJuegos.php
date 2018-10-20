<?php
//Incluimos la clase AccesoDatos.php que no estaba. La copiamos desde la Carpeta Clases de Clase06
require_once "AutentificadorJWT.php";

class UsuarioJuegos{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $Id_usuario;
	public $email;
  	public $password;
	
//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
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


//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	
	public function __construct( $Id_usuario=NULL,$email=NULL, $password=NULL)
	{
		if( $Id_usuario !== NULL && $email !== NULL && $password !== NULL ){
			
			$this->Id_usuario = $Id_usuario;
			$this->email = $email;
			$this->password = $password;
		
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->Nombre." - ".$this->Turno." - ".$this->Password."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE

	///////////////////////////////////ABM//////////////////////////////////////
		public static function Alta($usuario)
		{
			try{
					$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
					$consulta = $objetoAcceso->RetornarConsulta('INSERT INTO usuarios(EMAIL,PASSWORD) VALUES (:email,:password)');
			
				//parametros
					$consulta->bindvalue(':email', $usuario['email'], PDO::PARAM_STR);
					$consulta->bindvalue(':password', $usuario['password'] , PDO::PARAM_STR);
					

					$resultado = $consulta->Execute();			
				}
				catch (Exception $e)
                        {
                                $resultado = "Error al ejecutar la sentencia en Alta. Clase UsuarioJuegos (detalle del error:".$e->getMessage();
                        }




			return $resultado;	
		}

		public static function SignIn($arrayParametros)
		{
				$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
				if(sizeof($arrayParametros)==2)
				{
					$consulta = $objetoAcceso->RetornarConsulta('SELECT ID_EMPLEADO, EMAIL, PASSWORD   FROM `usuarios` WHERE email=:email and password=:password');
					$consulta->bindvalue(':email', $arrayParametros['email'], PDO::PARAM_STR);
					$consulta->bindvalue(':password', $arrayParametros['password'] , PDO::PARAM_STR);
					
					$consulta->execute();

					
					$uno = $consulta->fetchObject("UsuarioJuegos");
					
				

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
								
								//Usuario::LogInEmp($uno->id_empleado);
							
								$retorno = $uno;

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





}
		