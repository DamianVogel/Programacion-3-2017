

function Mostrar(queMostrar)
{
		//alert(queMostrar);
	var funcionAjax=$.ajax({
		url:"nexo.php",
		type:"post",
		data:{queHacer:queMostrar}
	});
	funcionAjax.done(function(retorno){
		$("#principal").html(retorno);
		$("#informe").html("Correcto!!!");	
	});
	funcionAjax.fail(function(retorno){
		$("#principal").html(":(");
		$("#informe").html(retorno.responseText);	
	});
	funcionAjax.always(function(retorno){
		//alert("siempre "+retorno.statusText);

	});
}

function MostarLogin()
{
		
	var funcionAjax=$.ajax({
		url:"http://localhost/Programacion-3-2017/PracticaParcial/mostrarlogin",
		type:"post"
		//data:{queHacer:"MostarLogin"}
	});
	funcionAjax.done(function(retorno){
		$("#principal").html(retorno);
		$("#informe").html("Form Login");	
	});
	funcionAjax.fail(function(retorno){
		$("#botonesABM").html("volvio por el fail");
		$("#informe").html(retorno.responseText);	
	});
	funcionAjax.always(function(retorno){
		//alert("siempre "+retorno.statusText);

	});
}

function MostrarAltaCd()
{		
	
	//alert("llegue");
	var funcionAjax=$.ajax({
		url:"http://localhost:8080/Programacion-3-2017/PracticaParcial/mostraralta",
		type:"post",
		//data:{queHacer:"que hace"}
	});
	funcionAjax.done(function(retorno){
		$("#principal").html(retorno);
		//$("#informe").html("Correcto BOTONES!!!");	
	});
}

function MostrarGrilla()
{		
	
	//alert("llegue");
	var funcionAjax=$.ajax({
		url:"http://localhost:8080/Programacion-3-2017/PracticaParcial/mostrargrilla",
		type:"post",
		data:{queHacer:"que hace"}
	});
	funcionAjax.done(function(retorno){
		$("#principal").html(retorno);
		//$("#informe").html("Correcto BOTONES!!!");	
	});
}

function MostrarModificacion()
{		
	
	//alert("llegue");
	var funcionAjax=$.ajax({
		url:"http://localhost:8080/Programacion-3-2017/PracticaParcial/mostrarmodificacion",
		type:"post",
		//data:{queHacer:"que hace"}
	});
	funcionAjax.done(function(retorno){
		$("#principal").html(retorno);
		//$("#informe").html("Correcto BOTONES!!!");	
	});
}








function validarLogin()
{
		var varUsuario=$("#correo").val();
		var varClave=$("#clave").val();
		var recordar=$("#recordarme").is(':checked');
		
//$("#informe").html("<img src='imagenes/ajax-loader.gif' style='width: 30px;'/>");
	

	var funcionAjax=$.ajax({
		url:"http://localhost:8080/Programacion-3-2017/PracticaParcial/validarusuario",
		type:"post",
		data:{
			recordarme:recordar,
			usuario:varUsuario,
			clave:varClave
		}
	});


	funcionAjax.done(function(retorno){
			
			if(retorno=="ingreso"){	
				MostarLogin();

				$("#BotonLogin").html("Ir a salir<br>-Sesión-");
				$("#BotonLogin").addClass("btn btn-danger");				
				$("#usuario").val("Conectado");
				//$("#informe").html("Bienvenido.. los botones de Alta y Grilla se encuentran operativos");
					}else
						{
							alert("Usuario o clave incorrecta");
							$("#informe").html("usuario o clave incorrecta");	
							$("#formLogin").addClass("animated bounceInLeft");
						}
	});
	funcionAjax.fail(function(retorno){
		$("#botonesABM").html(":(");
		$("#informe").html(retorno.responseText);	
	});
	
}

function deslogear()
{	
	var funcionAjax=$.ajax({
		url:"http://localhost:8080/Programacion-3-2017/PracticaParcial/desloguear",
		type:"post"		
	});
	funcionAjax.done(function(retorno){
			//MostarBotones();
			MostarLogin();
			$("#usuario").val("Sin usuario.");
			$("#BotonLogin").html("Login<br>-Sesión-");
			$("#BotonLogin").removeClass("btn-danger");
			$("#BotonLogin").addClass("btn-primary");
			
	});
}