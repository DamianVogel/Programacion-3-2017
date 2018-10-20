<?php
require_once "usuario.php";
require_once "AutentificadorJWT.php";
class MWparaAutentificar
{
 /**
   * @api {any} /MWparaAutenticar/  Verificar Usuario
   * @apiVersion 0.1.0
   * @apiName VerificarUsuario
   * @apiGroup MIDDLEWARE
   * @apiDescription  Por medio de este MiddleWare verifico las credeciales antes de ingresar al correspondiente metodo 
   *
   * @apiParam {ServerRequestInterface} request  El objeto REQUEST.
 * @apiParam {ResponseInterface} response El objeto RESPONSE.
 * @apiParam {Callable} next  The next middleware callable.
   *
   * @apiExample Como usarlo:
   *    ->add(\MWparaAutenticar::class . ':VerificarUsuario')
   */
	public function VerificarUsuario($request, $response, $next) {
         
		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->respuesta="";
	   
		// $ArrayDeParametros = $request->getParsedBody();

		// echo $ArrayDeParametros['nombre'];

		$datosLogIn = $request->getParsedBody();
		//$datosHeader = $request->get_headers($request);

		//echo $datosLogIn['Usuario']['nombre'];

		//echo $next;

		if($request->isGet())
		{
		 	$response = $next($request, $response);
		}
		else
		{
			
			session_start();

			if(!isset($_SESSION['registrado']))
			{
				$respuesta = Usuario::SignIn($datosLogIn);
				
				if($respuesta == "No-esta")
				{
					$objDelaRespuesta->esValido=false; 
					
				}			
				else
				{
					$token= AutentificadorJWT::CrearToken($_SESSION['registrado']);
					$objDelaRespuesta->esValido=true; 
					
					//20181012
					$objDelaRespuesta->token = $token;
				
					//return $datosLogIn;
				}			
			}
			else
			{				
				$token= AutentificadorJWT::CrearToken($_SESSION['registrado']);
				
				$objDelaRespuesta->esValido=true; 
				$objDelaRespuesta->token = $token;
			}
			
	
			try 
			{
				//$token="";
				AutentificadorJWT::verificarToken($token);
				$objDelaRespuesta->esValido=true;      
			}
			catch (Exception $e) {      
				//guardar en un log
				$objDelaRespuesta->excepcion=$e->getMessage();
				$objDelaRespuesta->esValido=false;     
			}

			if($objDelaRespuesta->esValido)
			{						
				if($request->isPost())
				{		
								    									
					//$response = $next($request, $response);
					
        			//20181013
					$response = $response->withJson( $objDelaRespuesta,200);
					
					/*
					$response
					->withHeader('Access-Control-Allow-Origin', 'http://localhost')
					->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
           			->withHeader('Access-Control-Allow-Methods',  'POST');
					*/
				}
				else
				{
					$payload=AutentificadorJWT::ObtenerData($token);
					
					if($payload->tipo=="ADMIN")
					{
						$response = $next($request, $response);
					}		           	
					else
					{	
						$objDelaRespuesta->respuesta="Solo administradores";
					}
				}		          
			}    
			else
			{
				//   $response->getBody()->write('<p>no tenes habilitado el ingreso</p>');
				$objDelaRespuesta->respuesta="Solo usuarios registrados";
				$objDelaRespuesta->elToken=$token;

				return $objDelaRespuesta->respuesta;
			}  
		}		  
		
		
		if($objDelaRespuesta->respuesta!="")
		{
			$nueva=$response->withJson($objDelaRespuesta, 401);  
			return $nueva;
		}
		  
		
		// return $response;
		
		 
		 return $response->withJson($datosLogIn); //<-- Esto funciona
		 
	}



	
	public function VerificarUsuarioHelado($request, $response, $next) {
         
		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->respuesta="";
	   
		// $ArrayDeParametros = $request->getParsedBody();

		// echo $ArrayDeParametros['nombre'];

		$datosLogIn = $request->getParsedBody();
		//$datosHeader = $request->get_headers($request);

		//echo $datosLogIn['Usuario']['nombre'];

		//echo $next;

		if($request->isGet())
		{
		 	$response = $next($request, $response);
		}
		else
		{
			
	
			try 
			{
				//$token="";
				AutentificadorJWT::verificarToken($datosLogIn[1]);
				$objDelaRespuesta->esValido=true;      
			}
			catch (Exception $e) {      
				//guardar en un log
				$objDelaRespuesta->excepcion=$e->getMessage();
				$objDelaRespuesta->esValido=false;     
			}

			if($objDelaRespuesta->esValido && $request->isPost())
			{											    									
					$response = $next($request, $response);					          
			}    
			else
			{
			
				$objDelaRespuesta->respuesta="Solo usuarios registrados";
		
				return $objDelaRespuesta->respuesta;
			}  
		}		  
		
		/*
		if($objDelaRespuesta->respuesta!="")
		{
			$nueva=$response->withJson($objDelaRespuesta, 401);  
			return $nueva;
		}
		  */
		
		 return $response;
		
		 
		 //return $response->withJson($datosHeader); //<-- Esto funciona
		 
	}
	
	public function VerificarUsuarioTP($request, $response, $next) {
		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->respuesta="";
	   
		// $ArrayDeParametros = $request->getParsedBody();

		// echo $ArrayDeParametros['nombre'];

		$datosLogIn = $request->getParsedBody();
		//$datosHeader = $request->get_headers($request);

		//echo $datosLogIn['Usuario']['nombre'];

		//echo $next;

		if($request->isGet())
		{
		 	$response = $next($request, $response);
		}
		else
		{
			
			session_start();

			if(!isset($_SESSION['registrado']))
			{
				$respuesta = UsuarioJuegos::SignIn($datosLogIn);
				
				if($respuesta == "No-esta")
				{
					$objDelaRespuesta->esValido=false; 
					
				}			
				else
				{
					//$token= AutentificadorJWT::CrearToken($_SESSION['registrado']);
					$token= AutentificadorJWT::CrearToken($respuesta);
					
					
					$objDelaRespuesta->esValido=true; 
					
					//20181012
					$objDelaRespuesta->token = $token;
				
					//return $datosLogIn;
				}			
			}
			else
			{				
				$token= AutentificadorJWT::CrearToken($_SESSION['registrado']);
				
				$objDelaRespuesta->esValido=true; 
				$objDelaRespuesta->token = $token;
			}
			
	
			try 
			{
				//$token="";
				AutentificadorJWT::verificarToken($token);
				$objDelaRespuesta->esValido=true;      
			}
			catch (Exception $e) {      
				//guardar en un log
				$objDelaRespuesta->excepcion=$e->getMessage();
				$objDelaRespuesta->esValido=false;     
			}

			if($objDelaRespuesta->esValido)
			{						
				if($request->isPost())
				{		
								    									
					//$response = $next($request, $response);
					
        			//20181013
					$response = $response->withJson( $objDelaRespuesta,200);
					
					/*
					$response
					->withHeader('Access-Control-Allow-Origin', 'http://localhost')
					->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
           			->withHeader('Access-Control-Allow-Methods',  'POST');
					*/
				}
				else
				{
					$payload=AutentificadorJWT::ObtenerData($token);
					
					if($payload->tipo=="ADMIN")
					{
						$response = $next($request, $response);
					}		           	
					else
					{	
						$objDelaRespuesta->respuesta="Solo administradores";
					}
				}		          
			}    
			else
			{
				//   $response->getBody()->write('<p>no tenes habilitado el ingreso</p>');
				$objDelaRespuesta->respuesta="Solo usuarios registrados";
				$objDelaRespuesta->elToken=$token;

				return $objDelaRespuesta->respuesta;
			}  
		}		  
		
		
		if($objDelaRespuesta->respuesta!="")
		{
			$nueva=$response->withJson($objDelaRespuesta, 401);  
			return $nueva;
		}
		  
		
		// return $response;
		
		 
		 return $response; //<-- Esto funciona
		 
	}
		




































}