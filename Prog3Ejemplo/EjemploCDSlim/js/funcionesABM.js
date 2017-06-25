


function BorrarCD(idParametro)
{
	//alert("Estoy en Borrar cd y quiero borrar el cd "+idParametro);

		var funcionAjax=$.ajax({
		url:"http://localhost:8080/Prog3Ejemplo/PracticaParcial(Dami)/index.php/borrar",
		type:"delete",
		data:{
			//queHacer:"BorrarCD",
			id:idParametro	
		}
	});
	funcionAjax.done(function(retorno){
		MostrarGrilla();
		$("#informe").html("cantidad de eliminados "+ retorno);	
		
	});
	funcionAjax.fail(function(retorno){	
		$("#informe").html(retorno.responseText);	
	});	
}

function EditarCD(idParametro)
{
	//alert("entro al ajax de modificar CD");

	var funcionAjax=$.ajax({
		url:"http://localhost:8080/Prog3Ejemplo/PracticaParcial(Dami)/index.php/modificar",
		type:"post",
		data:{
			//queHacer:"TraerCD",
			id:idParametro	
		}
	});
	funcionAjax.done(function(retorno){
		
		$("#principal").html(retorno);
		
	});
	funcionAjax.fail(function(retorno){	
		$("#informe").html(retorno.responseText);	
	});	
	
	


}

function GuardarCD()
{

	//alert("estoy en ajax de guardarCD");
	
	
	var inputFileImage = document.getElementById("foto");
	var file = inputFileImage.files[0];
	var datosDelForm = new FormData("formcd");
	//console.info(file);

	
	var titulo=$("#titulo").val();
	var id=$("#idCD").val();
	var cantante=$("#cantante").val();
	var anio=$("#anio").val();

	datosDelForm.append("foto",file);
	datosDelForm.append("titulo",titulo);
	datosDelForm.append("id",id);
	datosDelForm.append("cantante",cantante);
	datosDelForm.append("anio",anio);		
		
		

	var funcionAjax=$.ajax({
		url:"http://localhost:8080/Prog3Ejemplo/PracticaParcial(Dami)/index.php/cd",
		type:"post",
		data:datosDelForm,
		cache: false,
    	contentType: false,
    	processData: false

	}).then(function(respuesta){
		alert("Agregado correctamente");
		
		//$("#informe").html("cantidad de agregados "+ respuesta);	
		
		$("#cantante").val("");
		$("#titulo").val("");
		$("#anio").val("");
		$("#foto").val("");
		//console.log("guardar cd");

	},function(error){

			$("#informe").html(error.responseText);
			console.info("error", error);

	});
	
}

function UpdateCD()
{

	//alert("estoy en ajax de updateCD");
	
	
	var inputFileImage = document.getElementById("foto");
	var file = inputFileImage.files[0];
	var datosDelForm = new FormData("formcd");
	//console.info(file);

	
	var titulo=$("#titulo").val();
	var id=$("#idCD").val();
	var cantante=$("#cantante").val();
	var anio=$("#anio").val();

	//alert(titulo);

	datosDelForm.append("foto",file);
	datosDelForm.append("titulo",titulo);
	datosDelForm.append("id",id);
	datosDelForm.append("cantante",cantante);
	datosDelForm.append("anio",anio);		
		
		

	var funcionAjax=$.ajax({
		url:"http://localhost:8080/Prog3Ejemplo/PracticaParcial(Dami)/index.php/update",
		type:"post",
		data:datosDelForm,
		cache: false,
    	contentType: false,
    	processData: false

	}).then(function(respuesta){
		alert("Modificado correctamente");
		
		//$("#informe").html("cantidad de agregados "+ respuesta);	
		
		$("#cantante").val("");
		$("#titulo").val("");
		$("#anio").val("");
		$("#foto").val("");
		//console.log("guardar cd");

	},function(error){

			$("#informe").html(error.responseText);
			console.info("error", error);

	});
	
}