<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/clases/AccesoDatos.php';
require __DIR__.'/clases/bicicleta.php';
require __DIR__.'/clases/persona.php';



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


$app->put('/modificar/[{id}]', function (Request $request, Response $response,$args) {

$destino="./fotos/";
$destinoBackup="./fotos/Backup/";

$ArrayDeParametros = $request->getParsedBody();
	
$bike=Bicicleta::TraerUnaBike($args['id']);	
	
$modBike = new Bicicleta();
$modBike->id = $bike->id;
$modBike->color= $ArrayDeParametros['color'];;
$modBike->rodado= $ArrayDeParametros['rodado'];
$modBike->marca= $ArrayDeParametros['marca'];
$modBike->archivo = $bike->archivo;

	
	$archivos = $request->getUploadedFiles();
  	


	$nombreAnterior = $archivos['fotoasd']->getClientFilename();
	$extension= explode(".", $nombreAnterior);
	//var_dump($nombreAnterior);
	$extension=array_reverse($extension);

	$path = $destino.$modBike->marca.".".$extension[0];

	if($path == $bike->archivo)
	{
	  $archivos['fotoasd']->moveTo($destinoBackup.$bike->marca.".".$extension[0]);
	}
		else
		{
			$archivos['fotoasd']->moveTo($destino.$modBike->marca.".".$extension[0]);	
		}

	$modBike->archivo=$path;

		return $modBike->ModificarBike();


			
});



$app->post('/validarusuario', function (Request $request, Response $response) {

 $ArrayDeParametros = $request->getParsedBody();  

 session_start();
 $usuario=$ArrayDeParametros['email'];
 $clave=$ArrayDeParametros['password'];


			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
            $consulta = $objetoAcceso->RetornarConsulta('SELECT idusuario, nombre, email, password, tipo FROM usuarios WHERE email=:email and password=:password');
            $consulta->bindParam("email",$usuario);
            $consulta->bindParam("password",$clave);
			
			$consulta->execute();

			$personaBuscada= $consulta->fetchObject('Persona');


			if($personaBuscada != NULL)
			{
									$_SESSION['registrado']=$usuario;
									$retorno="ingreso el usuario: ".$personaBuscada->nombre." tipo: ".$personaBuscada->tipo;

			}else
					{
						$retorno= "No existe el usuario";
					}

			return $retorno;
			});


$app->post('/alta[/]', function (Request $request, Response $response) {
  
  	$destino="./fotos/";
  	$ArrayDeParametros = $request->getParsedBody();
  	//var_dump($ArrayDeParametros);
  	$color= $ArrayDeParametros['color'];
  	$rodado= $ArrayDeParametros['rodado'];
  	$marca= $ArrayDeParametros['marca'];
  	
  	$miBike = new Bicicleta();
  	$miBike->color=$color;
  	$miBike->rodado=$rodado;
  	$miBike->marca=$marca;

  	$archivos = $request->getUploadedFiles();
  	//var_dump($ArrayDeParametros);
  	//var_dump($archivos);
  	//var_dump($archivos['foto']);


	$nombreAnterior=$archivos['foto']->getClientFilename();
	$extension= explode(".", $nombreAnterior)  ;
	//var_dump($nombreAnterior);
	$extension=array_reverse($extension);

  	$archivos['foto']->moveTo($destino.$marca.".".$extension[0]);
    
	$path = $destino.$marca.".".$extension[0];
	$miBike->archivo=$path;

	$ultimoId = $miBike->InsertarBike();

	return $ultimoId;

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





$app->get('/traerbikes', function (Request $request, Response $response) {
    
   	$bikes = Bicicleta::TraerTodasBike();

	return $response->WithJson($bikes);   

});

$app->get('/bikes/[{color}]', function (Request $request, Response $response, $args) {
    
   		   
	$bikes = Bicicleta::TraerBikesColor($args['color']);

	return $response->WithJson($bikes);   

});

$app->get('/bikeporid/[{id}]', function (Request $request, Response $response, $args) {
    
   		   
	$bikes = Bicicleta::TraerUnaBike($args['id']);

	return $response->WithJson($bikes);   

});

$app->delete('/deleteporid/[{id}]', function (Request $request, Response $response, $args) {
    
   		   
	$bikes = Bicicleta::BorrarBike($args['id']);

	return $response->WithJson("Se borraron ".$bikes." bicicletas");   

});







$app->run();