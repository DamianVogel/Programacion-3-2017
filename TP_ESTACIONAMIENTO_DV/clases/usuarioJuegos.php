<?php
//Incluimos la clase AccesoDatos.php que no estaba. La copiamos desde la Carpeta Clases de Clase06
require_once "AutentificadorJWT.php";

class UsuarioJuegos{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $Id_usuario;
	private $Email;
  	private $Password;
	
//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetId_usuario()
	{
		return $this->Id_usuario;
	}
	
	public function GetEmail()
	{
		return $this->Email;
	}
	public function GetPassword()
	{
		return $this->Password;
	}
	


	public function SetId_usuario($valor)
	{
		$this->Id_usuario = $valor;
	}
	public function SetEmail($valor)
	{
		$this->Email = $valor;
	}
	public function SetPassword($valor)
	{
		$this->Password = $valor;
	}
	


//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	
	public function __construct( $Id_usuario=NULL,$Email=NULL, $Password=NULL)
	{
		if( $Id_usuario !== NULL && $Email !== NULL && $Password !== NULL ){
			
			$this->Id_usuario = $Id_usuario;
			$this->Email = $Email;
			$this->Password = $Password;
		
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
					$consulta = $objetoAcceso->RetornarConsulta('SELECT id_usuario, email, password   FROM `usuarios` WHERE email=:email and password=:password');
					$consulta->bindvalue(':email', $arrayParametros['email'], PDO::PARAM_STR);
					$consulta->bindvalue(':password', $arrayParametros['password'] , PDO::PARAM_STR);					
					
					$consulta->execute();
					
					$uno = $consulta->fetchObject("UsuarioJuegos");
					
					$objDelaRespuesta= new stdclass();

					if($uno == true){
						$token= AutentificadorJWT::CrearToken($uno);						

						$objDelaRespuesta->token = $token;
						$objDelaRespuesta->respuesta = "Bienvenido";						
						$objDelaRespuesta->status = true;

						$retorno = $objDelaRespuesta;
					}	
					else
						{
							$objDelaRespuesta->respuesta = "Password Incorrecto";
							$objDelaRespuesta->token = false;
							$objDelaRespuesta->status = false;
							
							$retorno = $objDelaRespuesta;														
						}
					
				}
				else{
					$retorno = false;
				}
								
				return $retorno;
		}





}
		