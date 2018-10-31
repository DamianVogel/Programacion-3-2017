<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__."/clases/AccesoDatos.php";
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/clases/usuario.php';
require __DIR__.'/clases/vehiculo.php';
require __DIR__.'/clases/cochera.php';
require __DIR__.'/clases/Reportes.php';
require __DIR__.'/clases/fpdf.php';
require __DIR__.'/clases/PDF1.php';
require __DIR__.'/clases/TablaPDF.php';
require __DIR__.'/clases/PHPReport.php';
require __DIR__.'/clases/PHPExcel/PHPExcel.php';
require __DIR__.'/clases/MWparaAutentificar.php';
require __DIR__.'/clases/helados.php';
require __DIR__.'/clases/juegos.php';
require __DIR__.'/clases/usuarioJuegos.php';


$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;



$app = new \Slim\App(["settings" => $config]);

$app->add(function ($req, $res, $next) {
        $response = $next($req, $res);
        return $response
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    });



        //Loggearse e indica que tipo es //INGRESA CON FORM-URLENCODED 
        $app->post('/login', function ($request, $response, $args) {
                try	
                {                           
                        $ArrayDeParametros = $request->getParsedBody();    
                        
                        $resultado = UsuarioJuegos::SignIn($ArrayDeParametros);                        
                }
                catch (Exception $e)
                        {
                                $resultado = "Error al ejecutar la sentencia (detalle del error:".$e->getMessage();
                        }
                        
                return $response->withJson($resultado);
                            
        });
        


  
        $app->get('/traerpartidas', function ($request, $response) {
                $juegos = Juegos::TraerTodosLosJuegos();
                return $response->withJson($juegos);
        });
        

        $app->post('/altaUsuarioJuegos',function (Request $request, Response $response,$args) {
                        
                        try	
                        {

                                $ArrayDeParametros = $request->getParsedBody();  
                                
                                $resultado = UsuarioJuegos::Alta($ArrayDeParametros);
                              
                        }                                        
                        catch (Exception $e)
                        {
                                $resultado = "Error al ejecutar la sentencia (detalle del error:".$e->getMessage();
                        }
                
            
                return $response->withJson($resultado);
                        
        });

        $app->post('/altaJuegos',function (Request $request, Response $response,$args) {
                        
                try	
                {

                        $ArrayDeParametros = $request->getParsedBody();  
                        
                        $resultado = Juegos::AltaJuego($ArrayDeParametros);
                      
                }                                        
                catch (Exception $e)
                {
                        $resultado = "Error al ejecutar la sentencia (detalle del error:".$e->getMessage();
                }
        
    
        return $response->withJson($resultado);
                
        });
        






    






   
               
                       
        
$app->run();