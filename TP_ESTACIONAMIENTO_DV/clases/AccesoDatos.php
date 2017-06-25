<?php
class AccesoDatos
{
    private static $_objetoAccesoDatos;
    private $_objetoPDO;
    //Aca se encuentra la conexion con la base de datos. 

    private function __construct()
    {
        try {
            //Dentro del contructor le paso los parametros. Lo particular es que es privado para que nadie lo vea. 
            $this->_objetoPDO = new PDO('mysql:host=localhost;dbname=tp_estacionamiento;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
 
            $this->_objetoPDO->exec("SET CHARACTER SET utf8");
 
        } catch (PDOException $e) {
 
            print "Error!!!<br/>" . $e->getMessage();
 
            die();
        }
    }
 
    public function RetornarConsulta($sql)
    {
        return $this->_objetoPDO->prepare($sql);
    }
 
    public static function DameUnObjetoAcceso()//singleton
    {
        //este es el metodo que devuelve la base de datos.
        if (!isset(self::$_objetoAccesoDatos)) {       
            self::$_objetoAccesoDatos = new AccesoDatos(); 
        }
 
        return self::$_objetoAccesoDatos;
        //puedo hacerle un fetch
    }
 
    // Evita que el objeto se pueda clonar
    public function __clone()
    {
        trigger_error('La clonaci&oacute;n de este objeto no est&aacute; permitida!!!', E_USER_ERROR);
    }
}
?>