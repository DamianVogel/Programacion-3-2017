<?php
include "Producto.php";
class Container 
{
    public $numero;
    public $producto;

    function __construct($num)
    {
        $this->numero = $num;
        $this->producto = array(); 
    }

    function AgregarProducto (Producto $prod)
    {
        array_push($this->producto,$prod);
    }

    function GuardarProductos()
    {
         $archivo = fopen("productosconhtml.txt","w");

         foreach($this->producto as $key)
         {
             fwrite($archivo,$key->ToString());
             
         }

         fclose($archivo);

    }

    function LeerDeArchivo ()
    {
        $archivo = fopen("productosconhtml.txt","r");
        
                    while(!feof($archivo))
                    {
                        $renglon = fgets($archivo,4096);

                        //$fitrado = trim($renglon);
                        
                        $nuevoArray = explode(";",$renglon);
                            // var_dump($nuevoArray);

                        $nuevoProd = new Producto($nuevoArray[0],$nuevoArray[1],$nuevoArray[2]);
                            //var_dump($nuevoProd);

                        $this->AgregarProducto($nuevoProd);
                            //var_dump($this->producto);
                    }
                        
            fclose($archivo);
    }

        
    

    }





//1En la clase container crear el metodo leer de archivo,
// que lea de un archivo un listado de producto cuyos atributos 
//estan separados por punto y coma, luego cargar el array de producto 
//con los objetos creados a partir de los datos del archivo 


//2agregar un cuadro de texto con el nombre del archivo en donde se van a guardar los datos 
//En ese nombre se guardaran los datos cargados en los cuadros de texto. Si el archivo existe primero moveremos el archivo ya existente a la carpeta backup cambiandole el nombre al nombre que tiene mas la fecha.



//3al leer si el archivo no existe informarlo.     

    


?>    