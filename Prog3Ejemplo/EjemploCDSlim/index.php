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

$app->post('/modificar', function (Request $request, Response $response) {

	$id = $request->getParsedBody(); //ATENCION ES UN ARRAY.
	//el getParsedBody parsea lo que viene por html

	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta('SELECT id, titel as titulo, interpret as cantante,jahr as año, archivo as archivo from cds WHERE id = :id');
			$consulta->bindParam(":id",$id['id']);
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('cd');

	echo "
        
		
		<link href='css/bootstrap.min.css' rel='stylesheet'>
		<link href=css/ingreso.css rel=stylesheet>
		
		<div class=container>
		<form class='form-ingreso' onsubmit='UpdateCD();return false' enctype=multipart/form-data id=formcd>
	    <h2 class=form-ingreso-heading>MODIFICACION</h2>
        <label for=cantante value=natalia class=sr-only>Cantante</label>
        <input type=text  minlength=6  id=cantante value='".$cdBuscado->cantante."'   class='form-control' placeholder=Cantante required= autofocus=>
        <label for=titulo value=un titulo class=sr-only>Titulo</label>
        <input type=text  minlength=6  id=titulo value='".$cdBuscado->titulo."'  class=form-control placeholder=Titulo required= autofocus=>
        <label for=anio class=sr-only>Año</label>
        <input type=number value='".$cdBuscado->año."' min=1900  max=2099 id=anio class=form-control placeholder=año required= autofocus=>
       <input readonly   type=hidden    id=idCD value='".$cdBuscado->id."' class=form-control >
       <input type=file id=foto name=foto value='".$cdBuscado->archivo."'>
        <button  class='btn btn-lg btn-success btn-block' type=submit><span class='glyphicon glyphicon-floppy-save'>&nbsp;&nbsp;</span>Modificar </button>
        
		 </form>

    	</div>
		</tr>   ";
	
	 	
	
			
});







//Registrarse
$app->post('/mostrarlogin', function (Request $request, Response $response) {
    
   	include ("partes/formLogin.php"); //abre el formulario de login
   
});

$app->post('/validarusuario', function (Request $request, Response $response) {

 $ArrayDeParametros = $request->getParsedBody();  
 //parsea lo que viene por html

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

// var_dump($resultado); Da error si quiero ejecutar esto.
//var_dump($elementos);

//EJEMPLO DE SETEAR COOKIE
if($elementos>0)
{
	if($recordar=="true")
					{
						/*
						La diferencia del + y el - en el time es que el - borra.
						Entonces, si no es true, osea que no le dio check a Recordarme
						borra la cookie.
						*/
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
    
	/*Se necesita session_start cada vez que se quiera usar
	usar SESSION.
	Destruye la sesion y envia a registrado seteado en null
	al formLogin creo
	*/
   	session_start();

	$_SESSION['registrado']=null;

	session_destroy();
   
});

$app->run();