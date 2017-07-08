<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require __DIR__."/clases/AccesoDatos.php";
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/clases/usuario.php';
require __DIR__.'/clases/vehiculo.php';
require __DIR__.'/clases/cochera.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;


$app = new \Slim\App(["settings" => $config]);




//<---------------------------------USUARIO-------------------------------------->

//conectarse=ajax+slim
$app->post('/validarusuario', function ($request, $response, $args) {
         
          $ArrayDeParametros = $request->getParsedBody();    
                
          $resultado = Usuario::SignIn($ArrayDeParametros);

          return $response->withJson($resultado);


        });
      









//Alta de empleado
    $app->post('/altaemp',function (Request $request, Response $response,$args) {
        
          $ArrayDeParametros = $request->getParsedBody();  
        
          $resultado = Usuario::AltaEmpleado($ArrayDeParametros);

          return $response->withJson($resultado);
          
    });

//Deshabilitar empleado
    $app->post('/deshabemp',function (Request $request, Response $response,$args) {
            
              $ArrayDeParametros = $request->getParsedBody();  
            
              $resultado = Usuario::DeshabilitarEmp($ArrayDeParametros['id']);

              return $response->withJson($resultado);
              
        });


//Borrar empleado
    $app->delete('/borrarEmp',function (Request $request, Response $response,$args) {
            
              $ArrayDeParametros = $request->getParsedBody();  
            
              $resultado = Usuario::BajaEmp($ArrayDeParametros['id']);

              return $response->withJson($resultado);
              
       });

//Modificar empleado


 $app->post('/update',function (Request $request, Response $response,$args) {
            
              $ArrayDeParametros = $request->getParsedBody();  
            
              $resultado = Usuario::ModEmp($ArrayDeParametros);

              return $response->withJson($resultado);
              
       });

$app->post('/modEmp/{id}',function (Request $request, Response $response,$args) {

               
 
		        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta('SELECT id_empleado,nombre, turno, estado  FROM `usuarios` WHERE id_empleado = :id');
			$consulta->bindParam(":id",$args['id']);
			$consulta->execute();
			
                        $empBuscado= $consulta->fetchObject("Usuario");
 
		echo "
        
		
		<link href='css/bootstrap.min.css' rel='stylesheet'>
		<link href=css/ingreso.css rel=stylesheet>
		
		<div class=container>
		<form class='form-ingreso' onsubmit='UpdateEmp();return false' enctype=multipart/form-data id=formEmp>
	        <h2 class=form-ingreso-heading>MODIFICACION DE EMPLEADO</h2>
                <label for=cantante value=natalia class=sr-only>Cantante</label>
                <input type=text    id=nombre value='".$empBuscado->nombre."'   class='form-control' placeholder=Cantante required= autofocus=>
                <label for=titulo value=un titulo class=sr-only>Titulo</label>
                <input type=text   id=turno value='".$empBuscado->turno."'  class=form-control placeholder=Titulo required= autofocus=>
                <label for=anio class=sr-only>Año</label>
                <input type=text value='".$empBuscado->estado."' id=estado class=form-control placeholder=año required= autofocus=>
                <input readonly   type=hidden value='".$empBuscado->id_empleado."'   id=idEmp class=form-control >
                <button  class='btn btn-lg btn-success btn-block' type=submit><span class='glyphicon glyphicon-floppy-save'>&nbsp;&nbsp;</span>Modificar </button>
                
                 </form>

    	        </div>
		</tr>   ";
	

  });







$app->get('/traertodosUsuarios', function ($request, $response) {
    $usuarios = Usuario::TraerTodosLosusuarios();
    return $response->withJson($usuarios);
});

$app->get('/traerunusuario/[{id}]', function ($request, $response, $args) {
          $uno = Usuario::TraerUnUsuario($args['id']);
          return $response->withJson($uno);
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

//TRANSACCIONES PARA FRONT END

$app->post('/mostrarlogin', function (Request $request, Response $response) {
    
   	include ("Partes/formLogin.php"); //abre el formulario de login
   
});



$app->post('/gestionemp', function (Request $request, Response $response) {
    
   	include ("Partes/formGestionEmp.php"); //abre el formulario de gestionemp
   
});




$app->post('/desloguear', function (Request $request, Response $response) {
    
   	session_start();

  	$_SESSION['registrado']=null;

  	session_destroy();
   
});




$app->run();

