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

//<---------------------------------HELADO-------------------------------------->

        //////////////////////////////////////ABM///////////////////////////////////////

                
                    
                $app->get('/traerunVehiculo/[{modelo}]', function ($request, $response, $args) {
                                                
                                                
                        $uno = Vehiculo::TraerUnVehiculo($args['modelo']);
                        return $response->withJson($uno);
                });





                /*       
                $app->post('/altaHelado',function (Request $request, Response $response,$args) {
                        
                        try	
                        {

                                $ArrayDeParametros = $request->getParsedBody();  
                                
                                $resultado = Helado::AltaHelado($ArrayDeParametros);

                                if($resultado)
                                {
                                        $rta = "El Helado fue dado de alta correctamente";
                                }
                                else
                                {
                                        $rta = "No se ha dado de alta el Helado";
                                }


                                
                        }                                        
                        catch (Exception $e)
                        {
                                $rta = "Error al ejecutar la sentencia (detalle del error:".$e->getMessage();
                        }
                
                return $response->withJson($rta);

                });
                */
                $app->post('/altaHelado',function (Request $request, Response $response,$args) {
                        
                        try	
                        {

                                $ArrayDeParametros = $request->getParsedBody();  
                                
                                $resultado = Helado::AltaHelado($ArrayDeParametros[0]);

                                if($resultado)
                                {
                                        $rta = "El Helado fue dado de alta correctamente";
                                }
                                else
                                {
                                        $rta = "No se ha dado de alta el Helado";
                                }


                                
                        }                                        
                        catch (Exception $e)
                        {
                                $rta = "Error al ejecutar la sentencia (detalle del error:".$e->getMessage();
                        }
                
                return $response->withJson($rta);

                })->add(\MWparaAutentificar::class . ':VerificarUsuarioHelado');

        

//////////////////////////////////////ACCIONES///////////////////////////////////
       




        //Loggearse e indica que tipo es //INGRESA CON FORM-URLENCODED 
                $app->post('/validarusuario', function ($request, $response, $args) {
                        try	
                        {                           
                                $ArrayDeParametros = $request->getParsedBody();    
                                
                                $resultado = UsuarioJuegos::SignIn($ArrayDeParametros);                        
                        }
                        catch (Exception $e)
                                {
                                        $resultado = "Error al ejecutar la sentencia (detalle del error:".$e->getMessage();
                                }
                                
                        return $response->withJson($ArrayDeParametros);
                
                //})->add(\MWparaAutentificar::class . ':VerificarUsuario');
        })->add(\MWparaAutentificar::class . ':VerificarUsuarioTP');


/////////////////////////////////////TP JUEGOS///////////////////////////////////////        
        $app->get('/traerpartidas', function ($request, $response) {
                $juegos = Juegos::TraerTodosLosJuegos();
                return $response->withJson($juegos);
                });
        
                //->add(\MWparaAutentificar::class . ':VerificarUsuario');



        $app->post('/altaUsuarioJuegos',function (Request $request, Response $response,$args) {
                        
                        try	
                        {

                                $ArrayDeParametros = $request->getParsedBody();  
                                
                                $resultado = UsuarioJuegos::Alta($ArrayDeParametros);

                                /*
                                if($resultado)
                                {
                                        $rta = "El Empleado fue dado de alta correctamente";
                                }
                                else
                                {
                                        $rta = "No se ha dado de alta el empleado";
                                }
                                */

                                
                        }                                        
                        catch (Exception $e)
                        {
                                $resultado = "Error al ejecutar la sentencia (detalle del error:".$e->getMessage();
                        }
                
//                return $response->withJson($rta);
                return $response->withJson($resultado);
                        
        });
        //->add(\MWparaAutentificar::class . ':VerificarUsuario');

        




                
        /*****************************   TRAER BD   *******************************/
                //Traer todos los helados
                        $app->get('/TraerTodosLosHelados', function ($request, $response) {
                        $helados = Helado::TraerTodosLosHelados();
                        return $response->withJson($helados);
                        });
                
                       // ->add(\MWparaAutentificar::class . ':VerificarUsuario')

                //Traer un Usuario 
                        $app->get('/TraerUnHelado/[{id}]', function ($request, $response, $args) {
                        $uno = Helado::TraerUnHelado($args['id']);
                        return $response->withJson($uno);
                        });

                        //->add(\MWparaAutentificar::class . ':VerificarUsuario')
       



//<---------------------------------USUARIO-------------------------------------->

        //////////////////////////////////////ABM///////////////////////////////////////

                //Alta de empleado
                               
                       
                        $app->post('/altaEmp',function (Request $request, Response $response,$args) {
                        
                        	try	
				{
	
                                        $ArrayDeParametros = $request->getParsedBody();  
                                        
                                        $resultado = Usuario::AltaEmpleado($ArrayDeParametros);

                                        if($resultado)
                                        {
                                                $rta = "El Empleado fue dado de alta correctamente";
                                        }
                                        else
                                        {
                                                $rta = "No se ha dado de alta el empleado";
                                        }


                                        
                                }                                        
                                catch (Exception $e)
				{
					$rta = "Error al ejecutar la sentencia (detalle del error:".$e->getMessage();
				}
                        
                        return $response->withJson($rta);

                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');

                //Modificar empleado //NO FUNCIONA SI NO EXISTE 
                        $app->post('/update',function (Request $request, Response $response,$args) {
                                
                                try	
				{
                                        $ArrayDeParametros = $request->getParsedBody();
                                        
                                        $resultado = Usuario::TraerUnUsuario($ArrayDeParametros['id']);
                                        
                                        if(is_numeric($resultado))
                                        {
                                                $rta ="El empleado no existe";
                                        }
                                        else
                                        {
                                                $rta = Usuario::ModEmp($ArrayDeParametros);
                                        }
                                }                                        
                                catch (Exception $e)
				{
					$rta = "Error al ejecutar la sentencia (detalle del error:".$e->getMessage();
				}             
                                return $response->withJson($rta);
                        
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');

                //Borrar empleado //VA POR FORM URLENCODED  //NO ANDA SI NO EXISTE 
                        $app->post('/borrarEmp',function (Request $request, Response $response,$args) {
                        
                                $ArrayDeParametros = $request->getParsedBody();  
                                
                                $resultado = Usuario::BajaEmp($ArrayDeParametros['id']);

                                return $response->withJson($resultado);
                                
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');

        //////////////////////////////////////ACCIONES///////////////////////////////////
                //Deshabilitar empleado //DEVUELVE TRUE CON VALOR NO EXISTENTE
                        $app->post('/deshabemp',function (Request $request, Response $response,$args) {
                                
                                $ArrayDeParametros = $request->getParsedBody();  

                                $resultado = Usuario::TraerUnUsuario($ArrayDeParametros['id']);
                                
                                
                                if(is_numeric($resultado))
                                {
                                $resultado ="El empleado no existe";
                                }
                                else
                                {
                                $resultado = Usuario::DeshabilitarEmp($ArrayDeParametros['id']);
                                }

                                return $response->withJson($resultado);      
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');




                //Loggearse e indica que tipo es //INGRESA CON FORM-URLENCODED 
                        /*
                        $app->post('/validarusuario', function ($request, $response, $args) {
                                try	
                                {
                                        $ArrayDeParametros = $request->getParsedBody();    
                                        $resultado = Usuario::SignIn($ArrayDeParametros);
                                }
                                catch (Exception $e)
                                {
                                        $resultado = "Error al ejecutar la sentencia (detalle del error:".$e->getMessage();
                                }
                                        return $response->withJson($resultado);
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');
                        */

                //Indica que tipo es 
                        $app->get('/tipoempleado/[{id}]', function ($request, $response, $args) {
                                
                                $nombre = $args["id"];
                                
                                $rta = Usuario::ValidarTipoEmp($nombre);

                                $respuesta = "El usuario es de tipo: ".$rta;      

                                return $response->withJson($respuesta);
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');
                        
                /*****************************   TRAER BD   *******************************/
                        //Traer todos los usuarios 
                                $app->get('/traertodosUsuarios', function ($request, $response) {
                                $usuarios = Usuario::TraerTodosLosusuarios();
                                return $response->withJson($usuarios);
                                })->add(\MWparaAutentificar::class . ':VerificarUsuario');
                        //Traer un Usuario 
                                $app->get('/traerunusuario/[{id}]', function ($request, $response, $args) {
                                $uno = Usuario::TraerUnUsuario($args['id']);
                                return $response->withJson($uno);
                                })->add(\MWparaAutentificar::class . ':VerificarUsuario');

                /*****************************BD     - LOGIN*******************************/
                        $app->get('/logInBD/[{id}]', function ($request, $response, $args) {

                                $nombre = $args["id"];
                                $resultado = Usuario::TraerUnUsuario($nombre);
                                
                                if(is_numeric($resultado))
                                {
                                        $rta ="El empleado no existe";
                                }
                                else
                                {
                                        $rta = Usuario::LogInEmp($nombre);
                                        if($rta)
                                        {$rta = "Usuario Logueado";}
                                }
                                
                                return $response->withJson($rta);
                        
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');


                        $app->get('/logOutBD/[{id}]', function ($request, $response, $args) {
                                
                                $nombre = $args["id"];
                                $resultado = Usuario::TraerUnUsuario($nombre);
                                
                                if(is_numeric($resultado))
                                {
                                        $rta ="El empleado no existe";
                                }
                                else
                                {
                                        $rta = Usuario::LogOutEmp($nombre);
                                        if($rta)
                                        {$rta = "Usuario Deslogueado";}
                                }
                                
                                return $response->withJson($rta);
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');

                /*****************************SESION - LOGIN*******************************/
                        $app->post('/desloguear', function (Request $request, Response $response) {
                
                                if(!isset($_SESSION['registrado']))
                                {
                                        session_start();
                                } 

                                if(sizeof($_SESSION)==0)
                                {
                                        $rta = "No hay ningun empleado logueado";
                                }
                                else
                                {
                                        $empleado = $_SESSION['registrado']->nombre;
                                        Usuario::LogOutEmp($_SESSION['registrado']->id_empleado);
                                        $_SESSION['registrado']=null;
                                        session_destroy();
                                        $rta = "El empleado ".$empleado." se ha deslogueado";
                                }
                              
                                return $response->withJson($rta);
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');

//<---------------------------------VEHICULOS-------------------------------------->

        //////////////////////////////////////ABM///////////////////////////////////////
                //Alta de vehiculo  
                        $app->post('/altaVehic',function (Request $request, Response $response,$args) {
                        
                                try	
                                {
                                        $ArrayDeParametros = $request->getParsedBody();  
                                        $resultado = Vehiculo::AltaVehiculo($ArrayDeParametros);               
                                        if($resultado)
                                        {
                                                $resultado = "El vehiculo fue dado de Alta";
                                        }
                                }                                        
                                catch (Exception $e)
                                {
                                        $resultado = "Error al ejecutar la sentencia (detalle del error:".$e->getMessage();
                                }
                                return $response->withJson($resultado);
                        });
                        //->add(\MWparaAutentificar::class . ':VerificarUsuario');

                //Borrar vehiculo //VA POR FORM URLENCODED //NO ANDA SI NO EXISTE 
                        $app->post('/borrarVehic',function (Request $request, Response $response,$args) {
                                
                                $ArrayDeParametros = $request->getParsedBody();
                                
                                if(sizeof($ArrayDeParametros)==1)
                                {
                                        $resultado = Vehiculo::TraerUnVehiculo($ArrayDeParametros['patente']);
                                        //VALIDACION
                                        if(!$resultado)
                                        {
                                                $resultado ="El vehiculo no existe";
                                        }
                                        else
                                        {
                                                $resultado = Vehiculo::Baja($ArrayDeParametros['patente']);
                                                $resultado = "Vehiculo deshabilitado";
                                        }
                                }
                                else 
                                {
                                        $resultado = "No puede ser nulo";
                                }
                                
                                // var_dump($ArrayDeParametros);
                                return $response->withJson($resultado);
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');

                //Modificar vehiculos
                        $app->post('/updateVehic',function (Request $request, Response $response,$args) {
                                try	
                                        {
                                                $ArrayDeParametros = $request->getParsedBody();
                                                if(sizeof($ArrayDeParametros)==4)
                                                {
                                                        $resultado = Vehiculo::TraerUnVehiculo($ArrayDeParametros['patente']);
                                                        //VALIDACION
                                                        if(!$resultado)
                                                        {
                                                                $resultado ="El vehiculo no existe";
                                                        }
                                                        else
                                                        {
                                                                $resultado = Vehiculo::Modificacion($ArrayDeParametros);
                                                                $resultado = "El vehiculo fue modificado";
                                                        }
                                                }
                                                else
                                                {
                                                        $resultado = "Debe colocar todos los parametros";
                                                }
                                        }                                        
                                catch (Exception $e)
                                        {
                                                $resultado = "Error al ejecutar la sentencia (detalle del error:".$e->getMessage();
                                        }    
                                return $resultado;
                                        
                                })->add(\MWparaAutentificar::class . ':VerificarUsuario');



        //////////////////////////////////////ACCIONES///////////////////////////////////

                /*****************************TRAER BD*******************************/
                        $app->get('/traertodosVehiculos', function ($request, $response) {
                                        $Vehiculos = Vehiculo::TraerTodosLosVehiculos();
                                        return $response->withJson($Vehiculos);
                                        });

                                        //Funciona 17-07 ok!  //FUNCIONA OK, VALIDA SI ESTA Y SI NO
                                       
                /***********************RELACIONADO - ESTACIONAMIENTO****************/
                        $app->get('/vehiculoEstacionado/[{id}]', function ($request, $response, $args) {
                                $uno = Vehiculo::TraerUnVehiculoOperaciones($args['id']);
                                return $response->withJson($uno);
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');

                        $app->get('/cocheravacia', function ($request, $response) {
                                $cocheravacia = Cochera::TraerUnaCocheraVacia();
                                return  $response->withJson($cocheravacia);
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');


//<--------------------------------- ESTACIONAMIENTO -------------------------------------->

        //////////////////////////////////////VEHICULOS///////////////////////////////////
                //INGRESO
                        $app->post('/IngVehBD', function ($request, $response) {
                                
                                $ArrayDeParametros = $request->getParsedBody();  
                                //VEO SI EL AUTO ESTA EN LA BASE 
                                $resultadoTraer = Vehiculo::TraerUnVehiculo($ArrayDeParametros['patente']);//si existe en tabla vehiculos

                                if(!$resultadoTraer)//Si la patente no se encuentra, lo doy de alta en el sistema.
                                {
                                        //Alta de vehiculo
                                        $resultadoAlta = Vehiculo::Alta($ArrayDeParametros);         
                                }

                                $vehiculo = Vehiculo::TraerIdVehiculo($ArrayDeParametros['patente']);
                                //VEO SI ESTA ESTACIONADO
                                $estadoVehiculo = Vehiculo::TraerUnVehiculoOperaciones($ArrayDeParametros['patente']);
                                
                                $id_vehiculo = $vehiculo[0]["id_vehiculo"];

                                if($estadoVehiculo=="SIN OPERACIONES")
                                {
                                        $cocheraDisponible = Cochera::TraerUnaCocheraVaciaNormales();//chequear que viene - Viene un objeto?
                                        if($cocheraDisponible != NULL)
                                        {         
                                                $idCocheraDisponible= $cocheraDisponible[0]["id_cochera"];
                                                $nroCocheraDisponible=$cocheraDisponible[0]["nro_cochera"];
                                                session_start();
                                                $idEmpleado = $_SESSION['registrado']->id_empleado;
                                                $resultadoOp = Vehiculo::InsertoOperacion ($idCocheraDisponible,$id_vehiculo,$idEmpleado);

                                                if($resultadoOp==1)
                                                {
                                                        $cocheraDesh = Cochera::BajaCochera($nroCocheraDisponible);
                                                        $resultadoAlta = "Se agrego el vehiculo a operaciones y se deshabilito la cochera: ".$nroCocheraDisponible;
                                                }        
                                                else
                                                {
                                                        $resultadoAlta="No se agrego el vehiculo a operaciones";
                                                }                              
                                        
                                        }
                                        else
                                        {$resultadoAlta="No hay cocheras disponibles";}                  
                                }
                                else 
                                {$resultadoAlta = "El vehiculo esta ESTACIONADO";}
                        
                                return $response->withJson($resultadoAlta);                            
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');

                //SALIDA
                        $app->post('/SalVehBD', function ($request, $response) {
                                
                                $ArrayDeParametros = $request->getParsedBody();  
                                //VEO SI EL AUTO ESTA EN LA BASE 
                                $resultadoTraer = Vehiculo::TraerUnVehiculo($ArrayDeParametros['patente']);//si existe en tabla vehiculos

                                if(!$resultadoTraer)//Si la patente no se encuentra, informo que no està.
                                { $respuestaBaja = "El Vehiculo no existe en el ESTACIONAMIENTO"; }
                                else 
                                {
                                        //VEO SI ESTA ESTACIONADO
                                        $estadoVehiculo = Vehiculo::TraerUnVehiculoOperaciones($ArrayDeParametros['patente']); 
                                        if($estadoVehiculo=="SIN OPERACIONES")
                                        {
                                                $respuestaBaja = "El Vehiculo no esta ESTACIONADO";               
                                        }
                                        else 
                                        {
                                                $resultadoOp = Vehiculo::BajaOperacion ( $estadoVehiculo);   
                                                $vehiculo_obj = Vehiculo::ConstruirVehiculo($ArrayDeParametros['patente']);
                                                $datosVehic   = $vehiculo_obj->ToString();
                                                $respuestaBaja= $datosVehic . '<br />'. "El importe a pagar es: ". $resultadoOp ;                  
                                        }
                                }   
                                return $respuestaBaja;                         
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');

                //TRAER UN VEHICULO EN OPERACIONES
                        $app->get('/traerVehiculoEnOp/[{patente}]', function ($request, $response, $args) {
        
                                $vehiculoEnOp = Vehiculo::TraerUnVehiculoOperaciones($args['patente']);
                                return  $response->withJson($vehiculoEnOp);
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');

//<--------------------------------- REPORTES -------------------------------------->

        //////////////////////////////////////EMPLEADO///////////////////////////////////
                //DIAS Y HORARIOS DE LOGUEO
                        $app->get('/ReportLogEmpleados', function ($request, $response) {
                                $empleados = Reportes::ReportLogEmpleados();
                                return $response->withJson($empleados);
                                })->add(\MWparaAutentificar::class . ':VerificarUsuario');

                //CANTIDAD DE OPERACIONES POR EMPLEADO
                        $app->get('/ReportSumOpEmpleados', function ($request, $response) {
                        $empleados = Reportes::ReportSumOpEmpleados();
                        return $response->withJson($empleados);
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');
        //////////////////////////////////////COCHERAS///////////////////////////////////
                //COCHERA MAS UTILIZADA
                        $app->get('/ReportCocheraMasUtil', function ($request, $response) {
                        $cochera = Reportes::ReportCocheraMasUtil();
                        return $response->withJson($cochera);
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');

                //COCHERA MENOS UTILIZADA
                        $app->get('/ReportCocheraMenosUtil', function ($request, $response) {
                        $empleados = Reportes::ReportCocheraMenosUtil();
                        return $response->withJson($empleados);
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');

                //COCHERA NUNCA UTILIZADA
                        $app->get('/ReportCocheraSinUtil', function ($request, $response) {
                        $empleados = Reportes::ReportCocheraSinUtil();
                        return $response->withJson($empleados);
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');        

        //////////////////////////////////////VEHICULOS///////////////////////////////////
                         $app->get('/ReportVehiculos', function ($request, $response) {
                                $empleados = Reportes::ReportVehiculos();
                                return $response->withJson($empleados);
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario'); 
//<--------------------------------- IMPRESION -------------------------------------->
        //////////////////////////////////////PDF///////////////////////////////////
                $app->get('/traerUsuariosTablaPDF', function ($request, $response) {
                                
                                // Creacion del objeto de la clase heredada
                                $pdf = new TablaPDF();
                                // Títulos de las columnas
                                $header = array('Id_Empleado', 'Nombre', 'Tipo', 'Turno');
                                // Carga de datos
                                $data = $pdf->LoadData();
                                $pdf->SetFont('Arial','',9);
                                $pdf->AddPage();
                                $pdf->TablaUsuarios($header,$data);
                                $response = $this->response->withHeader( 'Content-type', 'application/pdf' );
                                
                                $pdf->Output();
                                return $response;
                })->add(\MWparaAutentificar::class . ':VerificarUsuario');

        //REPORTES
                //USUARIO
                        //DIAS Y HORAS LOGUEO
                                $app->get('/ReportLogEmpleadosPDF', function ($request, $response) {
                                        $pdf = new TablaPDF();
                                        // Títulos de las columnas
                                        $header = array('Empleado', 'Turno', 'Estado', 'Fecha','H_Entrada','H_Salida','Cant_HS');
                                        // Carga de datos
                                        $data = $pdf->LoadDataReportLog();
                                        $pdf->SetFont('Arial','',9);
                                        $pdf->AddPage();
                                        $pdf->TablaReportLogEmp($header,$data);
                                        $response = $this->response->withHeader( 'Content-type', 'application/pdf' );
                                        
                                        $pdf->Output();
                                        return $response;
                                })->add(\MWparaAutentificar::class . ':VerificarUsuario');


                        //CANTIDAD DE OPERACIONES POR EMPLEADO
                                $app->get('/ReportSumOpEmpleadosPDF', function ($request, $response) {
                                        
                                        $pdf = new TablaPDF();
                                        // Títulos de las columnas
                                        $header = array('Nombre Empleado','Cant Operaciones');
                                        // Carga de datos
                                        $data = $pdf->LoadDataReportSumOpEmpleados();
                                        $pdf->SetFont('Arial','',9);
                                        $pdf->AddPage();
                                        $pdf->TablaReportSumOpEmp($header,$data);
                                        $response = $this->response->withHeader( 'Content-type', 'application/pdf' );
                                        
                                        $pdf->Output();
                                        return $response;
                                })->add(\MWparaAutentificar::class . ':VerificarUsuario');
                //COCHERA
                        //COCHERA MAS UTILIZADA
                                $app->get('/ReportCocheraMasUtilPDF', function ($request, $response) {
   
                                        $pdf = new TablaPDF();
                                        // Títulos de las columnas
                                        $header = array('NRO Cochera','Cant Max Operaciones');
                                        // Carga de datos
                                        $data = $pdf->LoadDataReportCochMasUt();
                                        $pdf->SetFont('Arial','',9);
                                        $pdf->AddPage();
                                        $pdf->TablaReportCochera($header,$data);
                                        $response = $this->response->withHeader( 'Content-type', 'application/pdf' );
                                        
                                        $pdf->Output();
                                        return $response;
                                })->add(\MWparaAutentificar::class . ':VerificarUsuario');     
                        //COCHERA MENOS UTILIZADA
                                $app->get('/ReportCocheraMenosUtilPDF', function ($request, $response) {
   
                                        $pdf = new TablaPDF();
                                        // Títulos de las columnas
                                        $header = array('NRO Cochera','Cant Operaciones');
                                        // Carga de datos
                                        $data = $pdf->LoadDataReportCochMenosUt();
                                        $pdf->SetFont('Arial','',9);
                                        $pdf->AddPage();
                                        $pdf->TablaReportCochera($header,$data);
                                        $response = $this->response->withHeader( 'Content-type', 'application/pdf' );
                                        
                                        $pdf->Output();
                                        return $response;
                                })->add(\MWparaAutentificar::class . ':VerificarUsuario');    

                        //COCHERAS SIN UTILIZAR
                                $app->get('/ReportCocheraSinUtilPDF', function ($request, $response) {
   
                                        $pdf = new TablaPDF();
                                        // Títulos de las columnas
                                        $header = array('NRO Cochera','Cant Operaciones');
                                        // Carga de datos
                                        $data = $pdf->LoadDataReportCocheraSinUtil();
                                        $pdf->SetFont('Arial','',9);
                                        $pdf->AddPage();
                                        $pdf->TablaReportCochera($header,$data);
                                        $response = $this->response->withHeader( 'Content-type', 'application/pdf' );
                                        
                                        $pdf->Output();
                                        return $response;
                                })->add(\MWparaAutentificar::class . ':VerificarUsuario');         
                //VEHICULOS
                         $app->get('/ReportVehiculosPDF', function ($request, $response) {
                                $pdf = new TablaPDF();
                                // Títulos de las columnas
                                $header = array('Nro Cochera', 'Patente', 'Color', 'Marca','Fecha Hora Ingreso','Fecha Hora Salida','Importe');
                                // Carga de datos
                                $data = $pdf->LoadDataReportVehiculos();
                                $pdf->SetFont('Arial','',9);
                                $pdf->AddPage();
                                $pdf->TablaReportVehic($header,$data);
                                $response = $this->response->withHeader( 'Content-type', 'application/pdf' );
                                
                                $pdf->Output();
                                return $response;
                        })->add(\MWparaAutentificar::class . ':VerificarUsuario');
        //////////////////////////////////////XLS///////////////////////////////////
        //REPORTES
                //USUARIO
                        //DIAS Y HORAS LOGUEO
                                $app->get('/ReportLogEmpleadosCSV', function ($request, $response) {
                                
                                        $sheet = Reportes::ReportLogEmpleados();

                                        $doc = new PHPExcel();
                                        $doc->setActiveSheetIndex(0);
                                        $i=2;
                                        $arrayResp = array();
                        
                                        $arrayNomColumnas = array('Nombre Empleado', 'Turno', 'Estado', 'Fecha', 'Hora Entrada','Hora Salida','Cantidad de Horas');
                                        $doc->getActiveSheet()->fromArray(array($arrayNomColumnas), null, 'A1');
                                        foreach($sheet as $row)
                                        {
                                                $arrayResp[0] = $row->{'NOMBRE_EMPLEADO'};
                                                $arrayResp[1] = $row->{'TURNO'};
                                                $arrayResp[2] = $row->{'ESTADO'};
                                                $arrayResp[3] = $row->{'FECHA'};
                                                $arrayResp[4] = $row->{'HORA_ENTRADA'};
                                                $arrayResp[5] = $row->{'HORA_SALIDA'};
                                                $arrayResp[6] = $row->{'CANTIDAD_HORAS'};
        
                                                $doc->getActiveSheet()->fromArray(array($arrayResp), null, 'A'.$i);
                                                $i++;
                                        }
                                        $response = $response->withHeader('Content-Disposition', 'attachment','filename="Reporte de Empleados.xls"');
                                        $response = $response->withHeader('Cache-Control', 'max-age=0');
                                        $writer = PHPExcel_IOFactory::createWriter($doc, 'Excel5');
                                        $writer->save('php://output');
                                        
                                })->add(\MWparaAutentificar::class . ':VerificarUsuario');
                        //CANTIDAD DE OPERACIONES POR EMPLEADO
                         $app->get('/ReportSumOpEmpleadosCSV', function ($request, $response) {
                                
                                        $sheet = Reportes::ReportSumOpEmpleados();

                                        $doc = new PHPExcel();
                                        $doc->setActiveSheetIndex(0);
                                        $i=2;
                                        $arrayResp = array();
                        
                                        $arrayNomColumnas = array('Nombre Empleado', 'Cantidad De Operaciones');
                                        $doc->getActiveSheet()->fromArray(array($arrayNomColumnas), null, 'A1');
                                        foreach($sheet as $row)
                                        {
                                                $arrayResp[0] = $row->{'NOMBRE_EMPLEADO'};
                                                $arrayResp[1] = $row->{'CANTIDAD_OPERACIONES'};
                                                $doc->getActiveSheet()->fromArray(array($arrayResp), null, 'A'.$i);
                                                $i++;
                                        }
                                        $response = $response->withHeader('Content-Disposition', 'attachment','filename="Reporte de Empleados.xls"');
                                        $response = $response->withHeader('Cache-Control', 'max-age=0');
                                        $writer = PHPExcel_IOFactory::createWriter($doc, 'Excel5');
                                        $writer->save('php://output');
                                })->add(\MWparaAutentificar::class . ':VerificarUsuario');
                       
                //COCHERA
                        //COCHERA MAS UTILIZADA
                                $app->get('/ReportCocheraMasUtilCSV', function ($request, $response) {
                                
                                        $sheet = Reportes::ReportCocheraMasUtil();

                                        $doc = new PHPExcel();
                                        $doc->setActiveSheetIndex(0);
                                        $i=2;
                                        $arrayResp = array();
                        
                                        $arrayNomColumnas = array('Nro Cochera', 'Cantidad de Operaciones');
                                        $doc->getActiveSheet()->fromArray(array($arrayNomColumnas), null, 'A1');
                                        foreach($sheet as $row)
                                        {
                                                $arrayResp[0] = $row->{'NRO_COCHERA'};
                                                $arrayResp[1] = $row->{'CANTIDAD_OPERACIONES'};
                                                $doc->getActiveSheet()->fromArray(array($arrayResp), null, 'A'.$i);
                                                $i++;
                                        }
                                       $response = $response->withHeader('Content-Disposition', 'attachment','filename="Reporte de Empleados.xls"');
                                        $response = $response->withHeader('Cache-Control', 'max-age=0');
                                        $writer = PHPExcel_IOFactory::createWriter($doc, 'Excel5');
                                        $writer->save('php://output');
                                })->add(\MWparaAutentificar::class . ':VerificarUsuario');
                        //COCHERA MENOS UTILIZADA
                                $app->get('/ReportCocheraMenosUtilCSV', function ($request, $response) {
                                
                                        $sheet = Reportes::ReportCocheraMenosUtil();

                                        $doc = new PHPExcel();
                                        $doc->setActiveSheetIndex(0);
                                        $i=2;
                                        $arrayResp = array();
                        
                                        $arrayNomColumnas = array('Nro Cochera', 'Cantidad de Operaciones');
                                        $doc->getActiveSheet()->fromArray(array($arrayNomColumnas), null, 'A1');
                                        foreach($sheet as $row)
                                        {
                                                $arrayResp[0] = $row->{'NRO_COCHERA'};
                                                $arrayResp[1] = $row->{'CANTIDAD_OPERACIONES'};
                                                $doc->getActiveSheet()->fromArray(array($arrayResp), null, 'A'.$i);
                                                $i++;
                                        }
                                        $response = $response->withHeader('Content-Disposition', 'attachment','filename="Reporte de Empleados.xls"');
                                        $response = $response->withHeader('Cache-Control', 'max-age=0');
                                        $writer = PHPExcel_IOFactory::createWriter($doc, 'Excel5');
                                        $writer->save('php://output');
                                })->add(\MWparaAutentificar::class . ':VerificarUsuario');
                        //COCHERA SIN UTILIZAR
                                $app->get('/ReportCocheraSinUtilCSV', function ($request, $response) {
                        
                                        $sheet = Reportes::ReportCocheraSinUtil();

                                        $doc = new PHPExcel();
                                        $doc->setActiveSheetIndex(0);
                                        $i=2;
                                        $arrayResp = array();
                        
                                        $arrayNomColumnas = array('Nro Cochera', 'Cantidad de Operaciones');
                                        $doc->getActiveSheet()->fromArray(array($arrayNomColumnas), null, 'A1');
                                        foreach($sheet as $row)
                                        {
                                                $arrayResp[0] = $row->{'NRO_COCHERA'};
                                                $arrayResp[1] = $row->{'CANTIDAD_OPERACIONES'};
                                                $doc->getActiveSheet()->fromArray(array($arrayResp), null, 'A'.$i);
                                                $i++;
                                        }
                                        $response = $response->withHeader('Content-Disposition', 'attachment','filename="Reporte de Empleados.xls"');
                                        $response = $response->withHeader('Cache-Control', 'max-age=0');
                                        $writer = PHPExcel_IOFactory::createWriter($doc, 'Excel5');
                                        $writer->save('php://output');
                                })->add(\MWparaAutentificar::class . ':VerificarUsuario');
                //VEHICULOS
                         $app->get('/ReportVehiculosCSV', function ($request, $response) {
                                
                                        $sheet = Reportes::ReportVehiculos();

                                        $doc = new PHPExcel();
                                        $doc->setActiveSheetIndex(0);
                                        $i=2;
                                        $arrayResp = array();
                        
                                        $arrayNomColumnas =  array('Nro Cochera', 'Patente', 'Color', 'Marca','Fecha Hora Ingreso','Fecha Hora Salida','Importe');
                                        $doc->getActiveSheet()->fromArray(array($arrayNomColumnas), null, 'A1');
                                        foreach($sheet as $row)
                                        {
                                                $arrayResp[0] = $row->{'NRO_COCHERA'};
                                                $arrayResp[1] = $row->{'PATENTE'};
                                                $arrayResp[2] = $row->{'COLOR'};
                                                $arrayResp[3] = $row->{'MARCA'};
                                                $arrayResp[4] = $row->{'FECHA_INGRESO'};
                                                $arrayResp[5] = $row->{'FECHA_SALIDA'};
                                                $arrayResp[6] = $row->{'IMPORTE'};
        
                                                $doc->getActiveSheet()->fromArray(array($arrayResp), null, 'A'.$i);
                                                $i++;
                                        }
                                        $response = $response->withHeader('Content-Disposition', 'attachment','filename="Reporte de Empleados.xls"');
                                        $response = $response->withHeader('Cache-Control', 'max-age=0');
                                        $writer = PHPExcel_IOFactory::createWriter($doc, 'Excel5');
                                        $writer->save('php://output');
                                })->add(\MWparaAutentificar::class . ':VerificarUsuario');  
$app->run();