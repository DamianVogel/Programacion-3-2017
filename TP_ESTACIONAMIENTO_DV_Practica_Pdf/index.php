<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require __DIR__."/clases/AccesoDatos.php";
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/clases/usuario.php';
require __DIR__.'/clases/vehiculo.php';
require __DIR__.'/clases/cochera.php';
require __DIR__.'/clases/fpdf181/fpdf.php';
require __DIR__.'/clases/MWparaAutentificar.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;


class PDF1 extends FPDF
{
// Cabecera de p�gina
                function Header()
                {
                        // Logo
                        //$this->Image('logo_pb.png',10,8,33);
                        // Arial bold 15
                        $this->SetFont('Arial','B',15);
                        // Movernos a la derecha
                        $this->Cell(80);
                        // T�tulo
                        $this->Cell(30,10,'Title',1,0,'C');
                        // Salto de l�nea
                        $this->Ln(20);
                }

                // Pie de p�gina
                function Footer()
                {
                        // Posici�n: a 1,5 cm del final
                        $this->SetY(-15);
                        // Arial italic 8
                        $this->SetFont('Arial','I',8);
                        // N�mero de p�gina
                        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
                }
}





$app = new \Slim\App(["settings" => $config]);

//<---------------------------------PRUEBA PDF-------------------------------------->

$app->get('/traertodosUsuariosPDF', function ($request, $response) {
                
                $usuarios = Usuario::TraerTodosLosusuarios();



// Creaci�n del objeto de la clase heredada
                $pdf = new PDF1();
                $pdf->AliasNbPages();
                $pdf->AddPage();
                $pdf->SetFont('Times','',12);
                for($i=1;$i<=40;$i++)
                        $pdf->Cell(0,10,'Imprimiendo l�nea n�mero '.$i,0,1);
                $response = $this->response->withHeader( 'Content-type', 'application/pdf' );
                
                $pdf->Output();

                
		//$pdf->Output('My cool PDF.pdf', 'S') );
		
		return $response;
//    return $response->withJson($usuarios);
})->add(\MWparaAutentificar::class . ':VerificarUsuario');
















//<---------------------------------USUARIO-------------------------------------->


//Alta de empleado - Funciona 16-07 ok! 
    $app->post('/altaEmp',function (Request $request, Response $response,$args) {
        
        $ArrayDeParametros = $request->getParsedBody();  

        $resultado = Usuario::AltaEmpleado($ArrayDeParametros);

        return $response->withJson($resultado);
          
    })->add(\MWparaAutentificar::class . ':VerificarUsuario');




//Deshabilitar empleado - Funciona 16-07 ok! 
    $app->post('/deshabemp',function (Request $request, Response $response,$args) {
            
              $ArrayDeParametros = $request->getParsedBody();  
            
              $resultado = Usuario::DeshabilitarEmp($ArrayDeParametros['id']);

              return $response->withJson($resultado);
              
        })->add(\MWparaAutentificar::class . ':VerificarUsuario');

/


//Borrar empleado - Funciona 16-07 ok! 
    $app->delete('/borrarEmp',function (Request $request, Response $response,$args) {
            
              $ArrayDeParametros = $request->getParsedBody();  
            
              $resultado = Usuario::BajaEmp($ArrayDeParametros['id']);

              return $response->withJson($resultado);
              
       })->add(\MWparaAutentificar::class . ':VerificarUsuario');





//Loggearse e indica que tipo es - Funciona 16-07 ok! 
$app->post('/validarusuario', function ($request, $response, $args) {
         
          $ArrayDeParametros = $request->getParsedBody();    
                
          $resultado = Usuario::SignIn($ArrayDeParametros);

          return $response->withJson($resultado);
        });
      







//<---------------------------------VEHICULOS-------------------------------------->


        //Funciona 17-07 ok! 
        $app->get('/traertodosVehiculos', function ($request, $response) {
        $Vehiculos = Vehiculo::TraerTodosLosVehiculos();
        return $response->withJson($Vehiculos);
        });

        //Funciona 17-07 ok!  
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







//<--------------------------------- OPERACIONES -------------------------------------->
        $app->post('/IngVehBD', function ($request, $response) {
                
                $ArrayDeParametros = $request->getParsedBody();  


                //Chequeo que el vehiculo no se encuentre estacionado.   
                $resultadoTraer = Vehiculo::TraerUnVehiculo($ArrayDeParametros['patente']);
                
                

                
                if($resultadoTraer == "No se encontro vehiculo")//Si la patente no se encuentra, lo doy de alta en el sistema.
                        {
                                //Alta de vehiculo
                                $resultadoAlta = Vehiculo::Alta($ArrayDeParametros);         
                        
                                
                                $ultimaPatente = Vehiculo::TraerUnVehiculo($ArrayDeParametros['patente']);//Traigo el ultimo vehiculo para tomar el id para insertar en operaciones.
                                
                        
                                $cocheraDisponible = Cochera::TraerUnaCocheraVaciaNormales();//chequear que viene - Viene un objeto?

                        // var_dump($cocheraDisponible);

                                session_start();
                                $idEmpleado = $_SESSION['registrado']->id_empleado;

                                $hora = $ArrayDeParametros['hora'];
                        
                                $resultadoOp = Vehiculo::InsertoOperacion ($cocheraDisponible,$hora,$ultimaPatente->id_vehiculo,$idEmpleado);

                        
                                
                                if($resultadoOp==1)
                                        {
                                                //Ingreso el vehiculo a la operacion, la cochera se tiene que deshabilitar
                                        
                                                $cocheraDesh = Cochera::BajaCochera($cocheraDisponible);

                                                $resultadoAlta = $cocheraDesh;        
                                                $resultadoAlta = "Se agrego el vehiculo a operaciones y se deshabilito la cochera: ".$nro_cochera->GetNroCochera();
                                        }        
                                        else
                                                {
                                                        $resultadoAlta="No se agrego el vehiculo a operaciones";
                                                }
                                        
                                return $response->withJson($resultadoAlta);//Si se concreta la transaccion va por esta via.          
                        }           
                        else if($resultadoTraer->GetEstado()==1)//Si la patente esta, informo que ya se encuentra en el estacionamiento
                        {
                                $resultadoAlta = "No se dio de alta el vehiculo, porque el mismo ya se encuentra estacionado";
                                return $response->withJson($resultadoAlta);
                        }
                        else
                                {
                                $resultadoAlta = "No se dio de alta el vehiculo, consulte con Sistemas";//Si por alguna razon no se completo la transaccion lo informo.
                                return $response->withJson($resultadoAlta);               
                                }


                
                });
















        $app->post('/desloguear', function (Request $request, Response $response) {
        
                session_start();

                $_SESSION['registrado']=null;

                session_destroy();
        
        });



$app->run();

