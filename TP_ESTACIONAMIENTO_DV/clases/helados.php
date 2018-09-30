<?php
//Incluimos la clase AccesoDatos.php que no estaba. La copiamos desde la Carpeta Clases de Clase06

class Helado
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $id_Helado;
	private $sabor;
 	private $tipo;
    private $kilos;
      
	
//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function Getid_Helado()
	{
		return $this->id_Helado;
	}
	
	public function GetSabor()
	{
		return $this->sabor;
	}
	public function GetTipo()
	{
		return $this->tipo;
	}
	public function GetKilos()
	{
		return $this->kilos;
	}
	

	public function Setid_Helado($valor)
	{
		$this->id_Helado = $valor;
	}
	public function SetSabor($valor)
	{
		$this->sabor = $valor;
	}
	public function SetTipo($valor)
	{
		$this->tipo = $valor;
	}
	public function SetKilos($valor)
	{
		$this->kilos = $valor;
	}
	


//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	//DV PROBAR ID -> POSTMAN SIN LUZ -> AGREGADO EL ATRIBUTO ID PARA PODER MODIFICAR.
	public function __construct( $id_Helado=NULL,$sabor=NULL, $tipo=NULL, $kilos=NULL)
	{
		if( $id_Helado !== NULL && $sabor !== NULL && $tipo !== NULL && $kilos !== NULL){
			
			$this->id_Helado = $id_Helado;
			$this->sabor = $sabor;
			$this->tipo = $tipo;
			$this->kilos = $kilos;
			
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->id_Helado." - ".$this->sabor." - ".$this->tipo." - ".$this->kilos."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE

	///////////////////////////////////ABM//////////////////////////////////////
		public static function AltaHelado($helado)
		{
			
			if( sizeof($helado) == 3 )
			{
					$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
					$consulta = $objetoAcceso->RetornarConsulta('INSERT INTO helados(sabor,tipo,kilos) VALUES (:sabor,:tipo,:kilos)');
			
				//parametros
					$consulta->bindvalue(':sabor', $helado['sabor'], PDO::PARAM_STR);
					$consulta->bindvalue(':tipo', $helado['tipo'] , PDO::PARAM_STR);
					$consulta->bindvalue(':kilos', $helado['kilos'] , PDO::PARAM_STR);
					
					$resultado = $consulta->Execute();			
			}		
			else
			{
					$resultado = false;
			}


			return $resultado;	
		}

      
	/////////////////////////////////TRAER BD////////////////////////////////////////////
		public static function TraerTodosLosHelados()
		{
			$arrayRetorno = array();
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
			$consulta = $objetoAcceso->RetornarConsulta('SELECT id_helado, Sabor, Tipo, Kilos FROM helados');
			$consulta->Execute();
			return $consulta->fetchAll(PDO::FETCH_CLASS,"Helado");
			
		}
		
		public static function TraerUnHelado($id)
		{
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
			$consulta = $objetoAcceso->RetornarConsulta('SELECT id_helado, Sabor, Tipo, Kilos  
														 FROM helados 
														 WHERE id_helado=:id');
			$consulta->bindParam("id", $id);
			$consulta->execute();
			$uno = $consulta->fetchObject("Helado");
			
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