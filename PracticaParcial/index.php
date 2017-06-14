<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/clases/AccesoDatos.php';
require __DIR__.'/clases/cd.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;
/*

¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

$app = new \Slim\App(["settings" => $config]);



$app->post('/mostraralta', function (Request $request, Response $response) {
       
   include("partes/formCd.php");

});

$app->post('/mostrargrilla', function (Request $request, Response $response) {
       
   include("partes/formGrilla.php");

});

$app->post('/mostrarmodificacion', function (Request $request, Response $response) {
       
   include ("partes/formCdMod.php");

});




$app->delete('/borrar', function (Request $request, Response $response) {

 		

		$id = $request->getParsedBody(); //ATENCION ES UN ARRAY	 

		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta('DELETE from cds WHERE id=:id');	
			$consulta->bindParam(":id",$id['id']);		
			$consulta->execute();
				
		var_dump($consulta->rowCount());
		
		//return $consulta->rowCount();
});








//Registrarse
$app->post('/mostrarlogin', function (Request $request, Response $response) {
    
   	include ("partes/formLogin.php"); //abre el formulario de login
   
});

$app->post('/validarusuario', function (Request $request, Response $response) {

 $ArrayDeParametros = $request->getParsedBody();  

 session_start();
 $usuario=$ArrayDeParametros['usuario'];
 $clave=$ArrayDeParametros['clave'];
 $recordar=$ArrayDeParametros['recordarme'];

			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
            $consulta = $objetoAcceso->RetornarConsulta('SELECT mail as emailbd, password as clavebd FROM usuarios WHERE mail=:mail and password=:password');
            $consulta->bindParam("mail",$usuario);
            $consulta->bindParam("password",$clave);
			
			$consulta->execute();

			$resultado = $consulta->fetchAll();

			$elementos = count($resultado);

//var_dump($elementos);

if($elementos>0)
{
	if($recordar=="true")
					{
						setcookie("registro",$usuario,  time()+36000 , '/');
						
					}else
					{
						setcookie("registro",$usuario,  time()-36000 , '/');
						
					}
						$_SESSION['registrado']=$usuario;
						$retorno="ingreso";

}else
		{
			$retorno= "No-esta";
		}

return $retorno;
});


$app->post('/cd[/]', function (Request $request, Response $response) {
  
  	$destino="./fotos/";
  	$ArrayDeParametros = $request->getParsedBody();
  	//var_dump($ArrayDeParametros);
  	$titulo= $ArrayDeParametros['titulo'];
  	$cantante= $ArrayDeParametros['cantante'];
  	$año= $ArrayDeParametros['anio'];
  	
  	$micd = new cd();
  	$micd->titulo=$titulo;
  	$micd->cantante=$cantante;
  	$micd->año=$año;
  //	$micd->InsertarElCdParametros();

  	$archivos = $request->getUploadedFiles();
  	//var_dump($ArrayDeParametros);
  	//var_dump($archivos);
  	//var_dump($archivos['foto']);


	$nombreAnterior=$archivos['foto']->getClientFilename();
	$extension= explode(".", $nombreAnterior)  ;
	//var_dump($nombreAnterior);
	$extension=array_reverse($extension);

  	$archivos['foto']->moveTo($destino.$titulo.".".$extension[0]);
    
	$path = $destino.$titulo.".".$extension[0];

	

		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta('INSERT INTO `cds`(archivo,interpret,jahr,titel) VALUES (:archivo,:interpret,:jahr,:titel)');
		$consulta->bindParam("archivo",$path);
        $consulta->bindParam("interpret",$micd->cantante);
		$consulta->bindParam("jahr",$micd->año);
        $consulta->bindParam("titel",$micd->titulo);
		
		$consulta->Execute();

	
  //  return $response;

});

$app->post('/update', function (Request $request, Response $response) {
  
  	$destino="./fotos/";
  	$ArrayDeParametros = $request->getParsedBody();
  	
	//var_dump($ArrayDeParametros);
  	$titulo= $ArrayDeParametros['titulo'];
  	$cantante= $ArrayDeParametros['cantante'];
  	$año= $ArrayDeParametros['anio'];
  	$id = $ArrayDeParametros['id'];


  	$micd = new cd();
  	$micd->titulo=$titulo;
  	$micd->cantante=$cantante;
  	$micd->año=$año;
  //	$micd->InsertarElCdParametros();

  	$archivos = $request->getUploadedFiles();
  	//var_dump($ArrayDeParametros);
  	//var_dump($archivos);
  	//var_dump($archivos['foto']);


	$nombreAnterior=$archivos['foto']->getClientFilename();
	$extension= explode(".", $nombreAnterior)  ;
	//var_dump($nombreAnterior);
	$extension=array_reverse($extension);

  	$archivos['foto']->moveTo($destino.$titulo.".".$extension[0]);
    
	$path = $destino.$titulo.".".$extension[0];

	

		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		
		
		$consulta = $objetoAcceso->RetornarConsulta('UPDATE `cds`set archivo=:archivo, interpret=:interpret, jahr=:jahr,titel=:titel WHERE id=:id');
		$consulta->bindParam("id",$id);
        $consulta->bindParam("archivo",$path);
        $consulta->bindParam("interpret",$micd->cantante);
		$consulta->bindParam("jahr",$micd->año);
        $consulta->bindParam("titel",$micd->titulo);
		
		$consulta->Execute();

	
  //  return $response;

});





$app->post('/desloguear', function (Request $request, Response $response) {
    
   	session_start();

	$_SESSION['registrado']=null;

	session_destroy();
   
});

$app->run();