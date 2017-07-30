<?php 

class Reportes
{

//--------------------------------------------------------------------------------//
//--CONSULTAS A LABASE
	////////////////////////////////////////////EMPLEADOS////////////////////////////////////////////
		public static function ReportLogEmpleados()
		{
			$arrayRetorno = array();
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
			$consulta = $objetoAcceso->RetornarConsulta(
										'SELECT 
											u.nombre 		AS 	NOMBRE_EMPLEADO, 
											u.turno			AS 	TURNO, 
											u.estado		AS 	ESTADO, 	
											le.fecha 		AS 	FECHA,
											le.hora_entrada AS	HORA_ENTRADA,
											le.hora_salida	AS 	HORA_SALIDA,										 
											TIMEDIFF(le.hora_salida,le.hora_entrada) AS CANTIDAD_HORAS	
										
										FROM 
											logs_empleados as le,
											usuarios as u
										WHERE 
											le.id_empleado = u.id_empleado
											
									');
			
			$consulta->Execute();
			
			while ($fila = $consulta->fetchObject()) {array_push($arrayRetorno,$fila);}
			
			return $arrayRetorno;
		}
		
		public static function ReportSumOpEmpleados()
		{
			$arrayRetorno = array();
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
			$consulta = $objetoAcceso->RetornarConsulta(
										'SELECT 
											u.nombre 		AS 	NOMBRE_EMPLEADO, 
											COUNT(o.id_operacion) AS CANTIDAD_OPERACIONES
										FROM 
											operaciones as o,
											usuarios as u
										WHERE 
											o.id_empleado = u.id_empleado
										GROUP BY 
											u.nombre
									');
			
			$consulta->Execute();
			
			while ($fila = $consulta->fetchObject()) {array_push($arrayRetorno,$fila);}
			
			return $arrayRetorno;
		}
	////////////////////////////////////////////COCHERA////////////////////////////////////////////
		public static function ReportCocheraMasUtil()
		{
			$arrayRetorno = array();
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
			$consulta = $objetoAcceso->RetornarConsulta(
										'SELECT 
											c.nro_cochera 						AS 	NRO_COCHERA,
											MAX(COCHSUM.CANTIDAD_OPERACIONES)	AS  CANTIDAD_OPERACIONES
										FROM 
											cocheras as c,
											(	
												SELECT 
													o.id_cochera 		AS 	id_cochera, 
													COUNT(id_operacion) AS CANTIDAD_OPERACIONES
												FROM 
													operaciones as o
												GROUP BY 
													o.id_cochera
											) COCHSUM
										WHERE 
											c.id_cochera = COCHSUM.id_cochera
										GROUP BY c.nro_cochera
										ORDER BY MAX(COCHSUM.CANTIDAD_OPERACIONES) DESC LIMIT 1
									');
			
			$consulta->Execute();
			
			while ($fila = $consulta->fetchObject()) {array_push($arrayRetorno,$fila);}
			
			return $arrayRetorno;
		}

		public static function ReportCocheraMenosUtil()
		{
			$arrayRetorno = array();
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
			$consulta = $objetoAcceso->RetornarConsulta(
										'SELECT 
											c.nro_cochera 						AS 	NRO_COCHERA,
											MAX(COCHSUM.CANTIDAD_OPERACIONES)	AS  CANTIDAD_OPERACIONES
										FROM 
											cocheras as c,
											(	
												SELECT 
													o.id_cochera 		AS 	id_cochera, 
													COUNT(id_operacion) AS CANTIDAD_OPERACIONES
												FROM 
													operaciones as o
												GROUP BY 
													o.id_cochera
											) COCHSUM
										WHERE 
											c.id_cochera = COCHSUM.id_cochera
										GROUP BY c.nro_cochera
										ORDER BY MAX(COCHSUM.CANTIDAD_OPERACIONES) ASC LIMIT 1
									');
			
			$consulta->Execute();
			
			while ($fila = $consulta->fetchObject()) {array_push($arrayRetorno,$fila);}
			
			return $arrayRetorno;
		}

		public static function ReportCocheraSinUtil()
		{
			$arrayRetorno = array();
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
			$consulta = $objetoAcceso->RetornarConsulta(
										'SELECT NRO_COCHERA,0 as CANTIDAD_OPERACIONES FROM 
											(
											SELECT 
												c.nro_cochera 						AS 	NRO_COCHERA,
												if(isnull(o.id_operacion),0,1)		AS 	CON_OPERACION
											FROM 
												cocheras 	as c
											LEFT JOIN 
												operaciones	as o 
											ON
												c.id_cochera = o.id_cochera
											) SUMARIZADO
										WHERE SUMARIZADO.CON_OPERACION=0
									');
			$consulta->Execute();
			
			while ($fila = $consulta->fetchObject()) {array_push($arrayRetorno,$fila);}
			
			return $arrayRetorno;
		}

	////////////////////////////////////////////VEHICULO///////////////////////////////////////////
		public static function ReportVehiculos()
		{
			$arrayRetorno = array();
			$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
			$consulta = $objetoAcceso->RetornarConsulta(
										'SELECT 
											c.nro_cochera			AS 	NRO_COCHERA,
											v.patente				AS 	PATENTE,
											v.color					AS 	COLOR,
											v.marca					AS 	MARCA,	
											o.fecha_hora_ingreso 	AS FECHA_INGRESO,
											o.fecha_hora_salida 	AS FECHA_SALIDA,
											o.importe 				AS IMPORTE

										FROM 
											vehiculos 				AS v,
											operaciones 			AS o,										
										 	cocheras 				AS c	
										WHERE 
											v.id_vehiculo = o.id_vehiculo
										AND
											c.id_cochera = o.id_cochera		
										AND
											NOT ISNULL(o.importe)										
										');
			
			$consulta->Execute();
			
			while ($fila = $consulta->fetchObject()) {array_push($arrayRetorno,$fila);}
			
			return $arrayRetorno;
		}	




//--------------------------------------------------------------------------------//
}