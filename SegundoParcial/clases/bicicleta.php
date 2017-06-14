<?php
class Bicicleta
{
	public $id;
 	public $color;
  	public $rodado;
  	public $marca;
	public $archivo;

  	public static function BorrarBike($id)
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta('DELETE from bikes WHERE id=:id');			
			$consulta->bindParam(":id",$id);
            $consulta->execute();
			return $consulta->rowCount();
     }

	
	public function ModificarBike()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta('UPDATE bikes set color=:color, rodado=:rodado, marca=:marca, archivo=:archivo, WHERE id=:id');
            $consulta->bindParam(':id',$this->id); 
            $consulta->bindParam(':color',$this->color);
            $consulta->bindParam(':rodado',$this->rodado);
            $consulta->bindParam(':marca',$this->marca);
            $consulta->bindParam(':archvo',$this->archivo);
            return $consulta->execute();
     }
	
  
	 public function InsertarBike()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta('INSERT into bikes (color, rodado, marca, archivo) values (:color,:rodado,:marca,:archivo)');
				$consulta->bindParam(':color',$this->color);
                $consulta->bindParam(':rodado',$this->rodado);
                $consulta->bindParam(':marca',$this->marca);
                $consulta->bindParam(':archivo',$this->archivo);
                
                $consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
				

	 }

	
  	public static function TraerTodasBike()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta('SELECT id, color, rodado, marca, archivo from bikes');
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "Bicicleta");		
	}

	public static function TraerUnaBike($id) 
	{
			//var_dump($id);
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta('SELECT id, color, rodado, marca, archivo from bikes where id=:id');
			$consulta->bindParam(':id',$id,PDO::PARAM_INT);
            $consulta->execute();
			$bikeBuscada= $consulta->fetchObject("Bicicleta");
			return $bikeBuscada;							
	}

	
	public static function TraerBikesColor($color) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta('SELECT * from bikes where color=:color');
		    $consulta->bindParam(':color',$color);
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_CLASS, "Bicicleta");				

			
	}
	
}