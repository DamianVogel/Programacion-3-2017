<?php
//Incluimos la clase AccesoDatos.php que no estaba. La copiamos desde la Carpeta Clases de Clase06

class Usuario
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $Id_empleado;
	private $Nombre;
 	private $Turno;
  	private $Password;
	private $Tipo;
	private $Estado;
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
	//DV PROBAR ID -> POSTMAN SIN LUZ -> AGREGADO EL ATRIBUTO ID PARA PODER MODIFICAR.
	public function __construct( $Id_empleado=NULL,$Nombre=NULL, $Turno=NULL, $Password=NULL, $Tipo=NULL, $Estado=NULL)
	{
		if( $Id_empleado !== NULL && $Nombre !== NULL && $Turno !== NULL && $Password !== NULL && $Tipo !== NULL && $Estado !== NULL ){
			
			$this->Id_empleado = $Id_empleado;
			$this->Nombre = $Nombre;
			$this->Turno = $Turno;
			$this->Password = $Password;
			$this->Tipo = $Tipo;
			$this->Estado = $Estado;
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

	//ABM
	
	//DV                    FUNCIONA OK!
	public static function AltaEmpleado($empleado)
	{
		
	
		//query
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta('INSERT INTO usuarios(NOMBRE,TURNO,PASSWORD,TIPO,ESTADO) VALUES (:nombre,:turno,:password,:tipo,:estado)');
		
			//parametros
			$consulta->bindvalue(':nombre', $empleado['nombre'], PDO::PARAM_STR);
			$consulta->bindvalue(':turno', $empleado['turno'] , PDO::PARAM_STR);
			$consulta->bindvalue(':password', $empleado['password'] , PDO::PARAM_STR);
			$consulta->bindvalue(':tipo', "EMPLEADO", PDO::PARAM_STR);
			$consulta->bindvalue(':estado', $empleado['estado'] , PDO::PARAM_STR);

		
		$resultado = $consulta->Execute();
	
		return $resultado;
	}

	
	//DV                    FUNCIONA OK!
	public static function DeshabilitarEmp($id)
	{
		//query
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta('UPDATE `usuarios` SET `Estado`=0 WHERE id_empleado=:id ');
		
		//parametros
		$consulta->bindvalue(':id', $id , PDO::PARAM_INT); 
		$resultado = $consulta->Execute();
	
		return $resultado;
	}
	
	//DV                    FUNCIONA OK!
	public static function BajaEmp($id)
	{
		
		//query
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta('DELETE FROM `usuarios` WHERE id_empleado=:id ');
		
		//parametros
		$consulta->bindvalue(':id', $id , PDO::PARAM_INT); 
		$consulta->Execute();
		
		$resultado = $consulta->rowCount();
	
		return $resultado;
	}


	//DV                    FUNCIONA OK!
	public static function ModEmp($empleado)
	{
		//query
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
				
		return $resultado; 
	
	}

	

	//DV probar en postman -> Sin Luz         
	public static function SignIn($arrayParametros)
	{
        
         	
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
            $consulta = $objetoAcceso->RetornarConsulta('SELECT id_empleado, nombre, password, tipo, turno, estado  FROM `usuarios` WHERE nombre=:nombre and password=:password');
            $consulta->bindvalue(':nombre', $arrayParametros['nombre'], PDO::PARAM_STR);
			$consulta->bindvalue(':password', $arrayParametros['password'] , PDO::PARAM_STR);
			
			$consulta->execute();

			
			$uno = $consulta->fetchObject("Usuario");
			
		

			if($uno==true)
            {
              if($arrayParametros['recordarme']=="true")
                      {
                        setcookie("registro",$arrayParametros['nombre'],  time()+36000 , '/');
                        
                      }else
                      {
                        setcookie("registro",$arrayParametros['nombre'],  time()-36000 , '/');
                        
                      }
					  	session_start();

						$_SESSION['registrado']=$uno;						
					//	$_SESSION['registrado']['tipo']=$uno->tipo;
                        
						// $_SESSION['registrado']=Array();						
						// $_SESSION['registrado']['tipo']=$uno->tipo;


						$retorno="ingreso y es de tipo:".$uno->tipo;

            }else
                {
                  $retorno= "No-esta";
                }

            return $retorno;

             
       
	}

	//DV probar en postman -> Sin Luz
	public static function ValidarTipoEmp ($id_empleado)
	{
			
    		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
            $consulta = $objetoAcceso->RetornarConsulta('SELECT tipo FROM usuarios WHERE id_empleado=:id');
			$consulta->bindParam("id",$id_empleado);  //Probar esto
            $consulta->execute();
            $dos= $consulta->fetchObject("Usuario");
			
			//return $dos;


			//antes
			return $response_array['tipo_empleado']= $dos->tipo;
	}

	//DV probar en postman -> Sin Luz
	public static function LogEmp ($nombre)
	{
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();

            //Inserto en los LOGS generales
			$hoy = date('Y-m-d');
				
	  		$consulta = $objetoAcceso->RetornarConsulta('INSERT INTO logs(`NOMBRE_EMPLEADO`,`FECHA`,`HORA_ENTRADA`)  VALUES (:nombre,:hoy,NOW())');
            $consulta->bindParam("nombre",$nombre); //Probar esto
			$consulta->bindParam("hoy",$hoy); //Probar esto
            $consulta->execute();
		  
		  	 return true;
	}

	//TRAER BD
	public static function TraerTodosLosusuarios()
	{
		
		
		//DV                    FUNCIONA OK!
		
		$arrayRetorno = array();
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta('SELECT id_empleado, nombre, `password`, tipo, turno, estado  FROM `usuarios`');
		$consulta->Execute();
		while ($fila = $consulta->fetchObject("Usuario"))
		{
			 array_push($arrayRetorno,$fila);
		 }
		 
		 return $arrayRetorno;
	}



		//DV       				FUNCIONA OK!
	public static function TraerUnUsuario($id)
    {
        $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
        $consulta = $objetoAcceso->RetornarConsulta('SELECT nombre, password, tipo, turno, estado FROM usuarios WHERE id_empleado=:id');
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




	//VALIDAR
	public static function ValidarUsuario($nombre,$password)
	{
        
         	$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
            $consulta = $objetoAcceso->RetornarConsulta('SELECT nombre FROM usuarios WHERE nombre=:nombre');
            $consulta->bindParam("nombre",$nombre);
        
            $consulta->execute();    
            $uno= $consulta->fetchAll();

            if($uno == NULL)
            {
				$response_array['validacion']= 'errorus';
			}
            else if($uno == TRUE )
            {
                $objetoAcceso2 = AccesoDatos::DameUnObjetoAcceso();
                $consulta2 = $objetoAcceso2->RetornarConsulta('SELECT nombre, `password` FROM usuarios WHERE nombre=:nombre AND `password`=:pass');
                $consulta2->bindParam("nombre",$nombre);
                $consulta2->bindParam("pass",$password);
                $consulta2->execute();
                $dos= $consulta2->fetchAll();
                
                if($dos == TRUE)
                {
                    // $rta= "Bienvenido/a $nombre";
					$response_array['validacion'] = 'ok';
					$response_array['nombre'] = $nombre; 
	                }
                else
                {
                    // $rta= "Contraseña incorrecta";
					$response_array['validacion'] = 'error';  
                }
            }
        // return $rta;
		return $response_array;
	}

	
	
	public static function InsertarBD ($nombre)
	{
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();

            //Inserto en los LOGS generales
			$hoy = date('Y-m-d');
				
	  		$consulta = $objetoAcceso->RetornarConsulta('INSERT INTO logs(`NOMBRE_EMPLEADO`,`FECHA`,`HORA_ENTRADA`)  VALUES (:nombre,:hoy,NOW())');
            $consulta->bindParam("nombre",$nombre);
			$consulta->bindParam("hoy",$hoy);
            $consulta->execute();
		   return true;
	}

	
	

//--------------------------------------------------------------------------------//
}