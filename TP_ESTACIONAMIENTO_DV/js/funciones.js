//<----------------------------------------USUARIO------------------------>
//VALIDO USUARIO Y PASSWORDS
// function ValidarUsuario()
// {
//     var paginaValid = "http://localhost:8080/Programacion3-2017/TP_ESTACIONAMIENTO/index.php/validarusuario";

// 	var usuarioid = $("#usuarioid").val();
// 	var passwordid = $("#passwordid").val();
	
// 	var usuario = {};

// 	usuario.usuarioid = usuarioid;
// 	usuario.passwordid = passwordid;
   
//   //PRIMER AJAX ENCAPSULA USUARIO
//   $.ajax({
//         type: 'GET',
//         url: paginaValid,
//         dataType: "json",
//         data: {
// 			usuario : usuario
// 		},

// 		success:
// 		function(data, textStatus, jqXHR)
// 		{
// 			if(data.validacion == 'ok')
// 			{
				
// 				var paginaTipoEmp = "http://localhost:8080/Programacion3-2017/TP_ESTACIONAMIENTO/index.php/tipoempleado";
// 				var usuarioTipo = {};
// 				usuarioTipo.usuarionombre = data.nombre;
// 				//SEGUNDO AJAX - VERIFICA TIPO_EMPLEADO
// 				$.ajax({
// 					type: 'GET',
// 					url: paginaTipoEmp,
// 				data: {
// 					usuarioTipo : usuarioTipo
// 					},
// 					//SUCCES 2DO AJAX
// 					success:
// 						function(data, textStatus, jqXHR)
// 						{	
// 							if(data=="ADMIN")
// 							{
// 								window.location.href = "./ADM_index.html"; 
// 							}
// 							else if (data == "EMPLEADO")
// 							{
								
// 								window.location.href = "./EMP_index.php?name=" + usuarioTipo.usuarionombre;  
// 							}
// 						}
// 				});


// 			}
// 			else if(data.validacion == 'error')
// 			{
// 				alert("Error en contraseña");
// 				window.location.href = "./login.html"; 
// 			}
// 			else if(data.validacion == 'errorus')
// 			{
// 				alert("Error en el usuario");
// 				window.location.href = "./login.html"; 
// 			}
// 		},
// 		error: function(jqXHR, textStatus, errorThrown){
// 			alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
			
// 		}
//     });

// }

//INSERTO EN LOS LOGS
function LoginBD()
{
	var usuarioid = $("#usuarioid").val();
    var paginaLogin = "http://localhost:8080/Programacion3-2017/TP_ESTACIONAMIENTO/index.php/loginbd/";
	var paginaFinal = paginaLogin.concat(usuarioid);

	var usuarioLogin = {};
	usuarioLogin.usuarionombre = usuarioid;

	$.ajax({
        type: 'GET',
        url: paginaFinal,
        dataType: "json",
        data: {
			usuarioLogin : usuarioLogin
		},

		success:
		function(data, textStatus, jqXHR)
		{
		}

	});
}

//ACCIONES - LOGIN DE USUARIO
function AccionesIngreso ()
{
	ValidarUsuario();
	LoginBD();
}

//<----------------------------------------VEHICULO------------------------>
function VehiculoEstacionado()
{
	var patente = $("#patenteid").val();
    var paginaSlim = "http://localhost:8080/Programacion3-2017/TP_ESTACIONAMIENTO/index.php/traerunVehiculo/";
	var paginaEstacionado = paginaSlim.concat(patente);
	var succeed = false;
	
	$.ajax({
		async: false,
        type: 'GET',
        url: paginaEstacionado,
		dataType:"json",
        data: {
			patente : patente
		},

		success:
		function(data, textStatus, jqXHR)
		{
			if (data == "SIN OPERACIONES")
			{
				succeed = false;
			}
			else 
			{
				succeed = true;
			}
		},

	});
	return succeed;
}

function VehiculoExiste()
{
	var patente = $("#patenteid").val();
    var paginaExiste = "http://localhost:8080/Programacion3-2017/TP_ESTACIONAMIENTO/index.php/traerunVehiculo/";
	var paginaVehic = paginaExiste.concat(patente);

	  var succeed = false;
	
	$.ajax({
		async: false,
        type: 'GET',
        url: paginaVehic,
        data: {
			patente : patente
		},

		success:
		function(data, textStatus, jqXHR)
		{
			if (data == "NO")
			{
				succeed = false;
			}
			else 
			{
				succeed = true;
			}
		},

		});
	return succeed;
}

function InsertarAutoBD($nro_cochera,$hora,$patente,$nombre)
{
	var paginaOperacion = "http://localhost:8080/Programacion3-2017/TP_ESTACIONAMIENTO/index.php/insertarOperacion";
	var datosOperacion = {};

	datosOperacion.nrocochera = $nro_cochera;
	datosOperacion.hora = $hora;
	datosOperacion.patente = $patente; 
	datosOperacion.nombre = $nombre; 

	var succeed = false;

	$.ajax({
	type: 'GET',
	url: paginaOperacion,
	data: {
	datosOperacion : datosOperacion
	},
		success:
		function(data, textStatus, jqXHR)
		{	
			// if (data == true)
			// {
			// 	succeed = true;
			// }
			// else 
			// {
			// 	succeed = false;
			// }
		}
		});
	return true;
}
//<----------------------------------------COCHERA------------------------>
function TraerCocheraVacia()
{
	var patente = $("#patenteid").val();
    var paginaCocheraVacia = "http://localhost:8080/Programacion3-2017/TP_ESTACIONAMIENTO/index.php/cocheravacia";

	var auto = {};
	auto.patente = patente;

	$.ajax({
		async: false,
        type: 'GET',
        url: paginaCocheraVacia,
		// dataType:"json",
        data: {
			auto : auto
		},

		success:
		function(data, textStatus, jqXHR)
		{
			
			if (data == "NO HAY")
			{
				succeed = false;
			}
			else 
			{
				succeed = JSON.stringify(data[0].nro_cochera);
			}
		},

		});
	return succeed;
}

////////////////////////////////////////////OPERACIONES////////////////////////
//INGRESO DEL VEHICULO
function AccionesIngresoVehic ($nombre)
{
	var patente = $("#patenteid").val();
	//TRAER COCHERA VACIA
	$nro_cochera= TraerCocheraVacia();
	// $hora_entrada = new Date($.now());
	d = Date().split(" ");
 	var hora = d[4]
	
	//Conversion de variables
	$hora = hora;
	nro_cochera = $nro_cochera;
	nombre = $nombre;

	//MOSTRAR HORA ENTRADA Y DATOS
	 $mensaje = "Cochera Disponible: "+$nro_cochera+" Hora Entrada: "+ $hora;
	alert($mensaje);
	
	//INSERTAR EN LA BASE
	if(InsertarAutoBD(nro_ccochera,hora,patente,nombre))
	{
		alert("El vehiculo fue ingresado al  sistema");
	}
}
//EGRESO DEL VEHICULO

function AccionesEgresoVehic ()
{
	var patente = $("#patenteid").val();
	//VERIFICAR SI ESTA ESTACIONADO
	if( VehiculoExiste()) //Verifico si existe el vehículo
	{
		
		 if(VehiculoEstacionado())
		 {
			alert("estacionado");
			
		 } 
		 else
		 {
			 alert ("no estacionado");
		 }
	}
	else 
	{
		alert ("no existe");
	}
}




//TP DAMIAN!
function ValidarUsuario()
{
    
	alert("estoy en validar usuario");
	
	var paginaValid = "http://localhost/Programacion3-2017/TP_ESTACIONAMIENTO/index.php/validarusuario";

	var usuarioid = $("#usuarioid").val();
	var passwordid = $("#passwordid").val();
	
	var usuario = {};

	usuario.usuarioid = usuarioid;
	usuario.passwordid = passwordid;
   
  //PRIMER AJAX ENCAPSULA USUARIO
  $.ajax({
        type: 'GET',
        url: paginaValid,
        dataType: "json",
        data: {
			usuario : usuario
		},

		success:
		function(data, textStatus, jqXHR)
		{
			if(data.validacion == 'ok')
			{
				
				var paginaTipoEmp = "http://localhost:8080/Programacion3-2017/TP_ESTACIONAMIENTO/index.php/tipoempleado";
				var usuarioTipo = {};
				usuarioTipo.usuarionombre = data.nombre;
				//SEGUNDO AJAX - VERIFICA TIPO_EMPLEADO
				$.ajax({
					type: 'GET',
					url: paginaTipoEmp,
				data: {
					usuarioTipo : usuarioTipo
					},
					//SUCCES 2DO AJAX
					success:
						function(data, textStatus, jqXHR)
						{	
							if(data=="ADMIN")
							{
								window.location.href = "./ADM_index.html"; 
							}
							else if (data == "EMPLEADO")
							{
								
								window.location.href = "./EMP_index.php?name=" + usuarioTipo.usuarionombre;  
							}
						}
				});


			}
			else if(data.validacion == 'error')
			{
				alert("Error en contraseña");
				window.location.href = "./login.html"; 
			}
			else if(data.validacion == 'errorus')
			{
				alert("Error en el usuario");
				window.location.href = "./login.html"; 
			}
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
			
		}
    });

}
