<?php
require __DIR__."/clases/AccesoDatos.php";
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/clases/usuario.php';
require __DIR__.'/clases/vehiculo.php';
require __DIR__.'/clases/cochera.php';

$app = new \Slim\App;
    
//<---------------------------------USUARIO-------------------------------------->
$app->get('/traertodosUsuarios', function ($request, $response) {
    $usuarios = Usuario::TraerTodosLosusuarios();
    return $response->withJson($usuarios);
});

$app->get('/traerunusuario/[{id}]', function ($request, $response, $args) {
          $uno = Usuario::TraerUnUsuario($args['id']);
          return $response->withJson($uno);
        });

$app->get('/validarusuario', function ($request, $response) {
         
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
         
         
         
         
         
         
         
         
          $obj = isset($_GET['usuario']) ? json_decode(json_encode($_GET['usuario'])) : NULL;
          $rta = Usuario::ValidarUsuario($obj->usuarioid,$obj->passwordid);
          return $response->withJson($rta);
        });
      
$app->get('/tipoempleado', function ($request, $response) {
          $obj = isset($_GET['usuarioTipo']) ? json_decode(json_encode($_GET['usuarioTipo'])) : NULL;
          $rta = Usuario::ValidarTipoEmp($obj->usuarionombre);
          return $response->withJson($rta);
        });

$app->get('/tipoempleado/[{id}]', function ($request, $response, $args) {
         
          $nombre = $args["id"];
          $rta = Usuario::ValidarTipoEmp($nombre);
          return $response->withJson($rta);
        });

$app->get('/loginbd/[{id}]', function ($request, $response, $args) {
         
          $nombre = $args["id"];
          $rta = Usuario::InsertarBD($nombre);
          return $response->withJson($rta);
        });
//<---------------------------------VEHICULOS-------------------------------------->
$app->get('/traertodosVehiculos', function ($request, $response) {
    $Vehiculos = Vehiculo::TraerTodosLosVehiculos();
    return $response->withJson($Vehiculos);
});
  
$app->get('/traerunVehiculo/[{id}]', function ($request, $response, $args) {
          
          $uno = Vehiculo::TraerUnVehiculo($args['id']);
          return $response->withJson($uno);
        });
  
$app->get('/vehiculoEstacionado/[{id}]', function ($request, $response, $args) {
          $uno = Vehiculo::TraerUnVehiculoOperaciones($args['id']);
          return $response->withJson($uno);
        });

  
$app->get('/cocheravacia', function ($request, $response) {
          $cocheravacia = Cochera::TraerUnaCocheraVacia();
          return  $response->withJson($cocheravacia);
        });

$app->get('/insertarOperacion', function ($request, $response) {
          $obj = isset($_GET['datosOperacion']) ? json_decode(json_encode($_GET['datosOperacion'])) : NULL;
          $rta = Vehiculo::InsertoOperacion($obj->nrocochera, $obj->hora, $obj->patente, $obj->nombre);
          return $response->withJson($rta);
        });


// $app->get('/traerunVehiculo', function ($request, $response) {
          

//         $obj1 = $_GET['patente'];
//         //  $obj = isset($_GET['autoExiste.patente']) ? json_decode(json_encode($_GET['autoExiste.patente'])) : NULL; 
//         //  $uno = Vehiculo::TraerUnVehiculo($obj->patente);
//         //  var_dump($obj);
//          var_dump($obj1);
//         //  return $response->withJson($uno);
//         return ($obj1);
//         });

$app->run();

